<?php

namespace App\Http\Controllers;

use App\Contracts\HomeContract;
use App\Contracts\OrderContract;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateSalesOrderRequest;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private  $orderBook;
    private  $homeContract;
    public function __construct(OrderContract $orderBook ,HomeContract $homeContract)
    {
        $this->orderBook =$orderBook;
        $this->homeContract =$homeContract;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products =  $this->homeContract->getAll();
        return view('app.cart',compact('products'));
    }

    public function checkout(){
        $products =  $this->homeContract->getAll();
        return view('app.checkout',compact('products'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function order(CreateOrderRequest $request,$id){

        if($request->payment_online === "2"){
            $this->validate($request, [
                'order_desc' => 'required',
                'bank_code' =>'required|not_in:0'
            ]);
            session(['info_customer'=>$request->all()]);
          return  $this->orderBook->createPayment($request);
        }else{
            $result = $this->orderBook->create($request,$id);
            $products =  $this->homeContract->getAll();
            session()->flash('success-order',$result);
            return redirect()->route('home',compact('result','products'));
        }


    }
    /**
     * Display the specified resource.
     * @param  int  $customer
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function salesOrder($id){
        $products =  $this->homeContract->getAll();
          $user = User::findOrFail($id);
       $items = $user->orders->where('status','!=','Cancel');
        return view('app.salesOrderHistory',compact('items','products'));
    }
    /**
     * Display the specified resource.
     * @param  int  $customer
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function salesOrderDetail($id, int $customer){
        $products =  $this->homeContract->getAll();
        $item =   $this->orderBook->orderShow($id,$customer);

      return view('app.salesOrderDetail',compact('item','products'));
    }
    /**
     * Display the specified resource.
     * @param \Illuminate\Http\Request $request
     * @param  int  $customer
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateSalesOrderDetail(UpdateSalesOrderRequest $request , $id, int $customer){
        $result = $this->orderBook->updateSalesOrderDetail($request,$id,$customer);
              session()->flash('update-success',$result);
        return redirect()->route('cart.salesOrderDetail',["id"=>$id,"idCustomer"=>$customer]);
    }
    /**
     * Display the specified resource.
     * @param \Illuminate\Http\Request $request
     * @param  int  $customer
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteSalesOrderDetail(Request $request , $id, int $customer){

        $result = $this->orderBook->deleteSalesOrderDetail($id);
        session()->flash('cancel-order',$result);
        return redirect()->route('cart.salesOrder',["id"=>$customer]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function wishList(){
        $products =  $this->homeContract->getAll();
        return view('app.wishlist',compact('products'));
    }
    /**
     * Display the specified resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function vnpayReturn(Request $request){
        $products =  $this->homeContract->getAll();
           $result = $this->orderBook->vnpayReturn($request);
           if($result === false ){
               return view('app.vnPaymentFail',compact('products'));
           }
            return view('app.vnPayReturn',compact('result','products'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findOrder(Request $request,$id)
    {

        $products =  $this->homeContract->getAll();
        $item = $this->orderBook->show($id,$request->idOrder);
        if($item === "Không có đơn hàng cần tìm"){
            session()->flash('no-resultOrder',$item);
            return redirect()->route('home');
        }
        return view('app.salesOrderDetail',compact('item','products'));
    }

}
