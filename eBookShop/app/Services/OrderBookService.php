<?php namespace App\Services;
use App\Events\CanelOrderNotification;
use App\Events\OrderNotification;
use App\Models\Order;
use App\Contracts\OrderContract;
use App\Models\payments;
use App\Models\User;
use App\viewModels\bookViewModels;
use App\viewModels\OrderBookRequestModels;
use App\viewModels\showOrderModels;
use http\Env\Request;

class OrderBookService implements OrderContract{


    public function getAll(){
        $orders = Order::orderBy('created_at', 'desc')->get();
        return $orders;
    }

    public function show($id,$code){
       $order = Order::where('id','=',$code)->get();
       global $result;
      if(count($order)){
          $result =  $this->orderShow($order[0]->id,$id);
      }else{
          $result ="Không có đơn hàng cần tìm";
      }
             return $result ;
    }
   public function setOrderCreate($user,$input,$id,$payment){

       if(!count($user->getRoleNames())){
           $user->address = $input['address'];
           $user->phoneNumber = $input['phoneNumber'];
           $user->save();
       }
       global $order;
       if($payment !== null) {
           $order = Order::create(['user_id' => $id, 'city' => $input['city'], 'country' => $input['national'], 'district' => $input['district'],
               'note' => $input['message'], 'totalPrice' => $input['totalPrice'],
               'totalPriceFee' => $input['totalPriceOrder'],
               'nameReceive' => $input['nameReceive'], 'quantity' => $input['quantity'],'address'=>$input['address'] ,'payment_id' => $payment->id]);
       }else{

           $order = Order::create(['user_id' => $id, 'city' => $input['city'], 'country' => $input['national'], 'district' => $input['district'],
               'note' => $input['message'], 'totalPrice' => $input['totalPrice'],
               'totalPriceFee' => $input['totalPriceOrder'],
               'nameReceive' => $input['nameReceive'], 'quantity' => $input['quantity'],'address'=>$input['address']]);
       }
       foreach ($input['book']as $item){
           $idBook = explode(',',$item)[0];
           $no = explode(',',$item)[1];
           $order->books()->attach($idBook,array('amount'=>$no));
       }

       event(new OrderNotification($user,$order));
   }

    public function create($request,$id){
          $input = $request->all();
         $user = User::findOrFail($id);
           $this->setOrderCreate($user,$input,$id,null);
           return "Đặt hàng thành công!";

    }

     public function orderShow($id, $customer)
     {
            $orderView =new showOrderModels();
           $order =  Order::findOrFail($id);
           $booksOrder =$order->books;
           $user = User::findOrFail($customer);
           foreach ($booksOrder as $item){
               $totalPrice =0;
                     $bookModel = new bookViewModels();
               $price =$item->price;
               $bookModel->setId($item->id);
               $bookModel->setTitle($item->title);
               $bookModel->setImages($item->imagebooks[0]->file);
               $bookModel->setPrice($price);
               $bookModel->setAmount($item->pivot->amount);
               $totalPrice += ($bookModel->getPrice() * $bookModel->getAmount());
                $orderView->setListBookViewModel($bookModel);
                $orderView->setTotalPrice(number_format($totalPrice, 3));
           }
           $orderView->setId($id);
           if($order->payment !== null){
               $orderView->setPayment("Thanh toán online");
               $orderView->setPaymentNote($order->payment->note);
           }else{
               $orderView->setPayment(null);
           }
         $orderView->setNote($order->note);
         $orderView->setUserId($user->id);
           $orderView->setName($order->nameReceive);
          $orderView->setFullName($user->full_name);
          $orderView->setAddress($order->address);
          $orderView->setEmail($user->email);
         $orderView->setPhoneNumber($user->phoneNumber);
          $orderView->setCity($order->city);
          $orderView->setCountry($order->country);
          $orderView->setStatus($order->status);
         $orderView->setDistrict($order->district);
         $orderView->setTotalPriceFee($order->totalPriceFee);
         return $orderView;
     }

    public function update($request, $id)
    {
       $order = Order::findOrFail($id);
       if($request['status'] !==null){
           $order->status =$request['status'];
           $order->save();
       }else{
           return "No changed";
       }
       return "Update date success";

    }
    public function destroy($id)
    {
       $order =  Order::findOrFail($id);
      global $message ;
       if($order->status === "Cancel"){
           $booksOrder =$order->books;
           foreach ($booksOrder as $item){
               $order->books()->detach($item->id);
           }
               $order->delete();
               $message ="Delete success!";
       }else{
           $message ="Cannot delete!";
           return $message;
       }
       return $message;

    }

    public function updateSalesOrderDetail($request, $id, $customer)
    {
        $input = $request->all();
        $user =  User::findOrFail($customer);
        if(!count($user->getRoleNames())){
            $user->address = $input['address'];
            $user->phoneNumber = $input['phoneNumber'];
            $user->save();
        }
        $order =  Order::findOrFail($id);
        $order->city =$input['city'];
        $order->nameReceive =$input['nameReceive'];
        $order->district =$input['district'];
        $order->country =$input['national'];
        $order->save();
        return "Cập nhật đơn hàng thành công!";

    }

    public function deleteSalesOrderDetail($id){
         $order =  Order::findOrFail($id);
         $order->status= "Cancel";
         $order->save();
        event(new CanelOrderNotification($order,$order->user->full_name,$order->user->id));
        return "Hủy đơn hàng thành công!";
    }
       public function quickRandom($length = 16)
        {
    $pool = 'abcdefghiklmnopqrstvxyzABCDEFGHIKLMNOPQRSTVXYZ0123456789';
 $str='';
 $size = strlen($pool);
   for($i =0;$i<$length;$i++){
           $str .= $pool[rand(0,$size-1)];

   }

    return $str;
        }
    function createPayment($request){

        $vnp_TxnRef = $this->quickRandom(16); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = "billpayment";
        $vnp_Amount =str_replace(',', '',$request->totalPriceOrder) * 100;
        $vnp_Locale ="vn";
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" =>env('VNP_TMN_CODE'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => route('vnpay.return'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );
      //  dd($inputData);

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (env('VNP_HASH_SECRET')) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', env('VNP_HASH_SECRET') . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
       // dd($vnp_Url);
        return redirect($vnp_Url);
    }
    public function vnpayReturn($request){

         if($request->session()->has('info_customer') && $request->vnp_ResponseCode == "00"){
             $id = $request->session()->get('info_customer')['userId'];
             $user = User::findOrFail($id);
             $input =$request->session()->get('info_customer');
              $payment =  payments::create(['thanh_vien'=>$user->full_name,'money'=>$request->vnp_Amount,'note'=>$request->vnp_OrderInfo,
                    'vnp_response_code'=>$request->vnp_ResponseCode,'code_vnpay'=>$request->vnp_TransactionNo,
                    'code_bank'=>$request->vnp_BankCode,'time'=>date('Y-m-d H:i',strtotime($request->vnp_PayDate))]);
             $this->setOrderCreate($user,$input,$id,$payment);
         }else{
             return false;
         }
        return $payment;
    }
}
