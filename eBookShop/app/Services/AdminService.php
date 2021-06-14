<?php


namespace App\Services;


use App\Contracts\AdminContract;
use App\Models\Order;
use App\Models\User;
use App\viewModels\bookViewModels;
use App\viewModels\overviewOrderModels;
use App\viewModels\showOrderModels;

class AdminService implements AdminContract
{

    public function getAll()
    {
       $accepted =  Order::where('status','=','Accepted')->get();
       $waitingDelivery =  Order::where('status','=','Waiting delivery')->get();
        $successfully =  Order::where('status','=','Successfully delivered')->get();
        $cancel =  Order::where('status','=','Cancel')->get();
        $waitingAccepted =  Order::where('status','=','Waiting accepted')->get();
        $orders = Order::orderBy('created_at', 'desc')->take(10)->get();
        $overviewOrderModel = new overviewOrderModels();
        $overviewOrderModel->setAmountAccepted($accepted->count());
        $overviewOrderModel->setAmountWaitingDelivery($waitingDelivery->count());
        $overviewOrderModel->setAmountSuccess($successfully->count());
        $overviewOrderModel->setAmountWaitingAccepted($waitingAccepted->count());
        $overviewOrderModel->setAmountCancel($cancel->count());
        foreach ($orders as $item){
             $showOrderModels = new showOrderModels();
            $showOrderModels->setId($item->id);
            $showOrderModels->setCreate_at($item->created_at);
            $showOrderModels->setStatus($item->status);
            $showOrderModels->setUserId($item->user->id);
            $showOrderModels->setFullName($item->user->full_name);
            $showOrderModels->setCity($item->city);
            $totalPrice =0;
             foreach ($item->books as $orderBook ){
                 $bookModel = new bookViewModels();
                 $bookModel->setPrice($orderBook->price);
                 $bookModel->setAmount($orderBook->pivot->amount);
                 $totalPrice += ($bookModel->getPrice() * $bookModel->getAmount());
                 $showOrderModels->setTotalPrice(number_format($totalPrice, 3));
             }
            $overviewOrderModel->setListRecentOrders($showOrderModels);
        }


        return $overviewOrderModel;
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
