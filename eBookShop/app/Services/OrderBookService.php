<?php namespace App\Services;
use App\Models\Order;
use App\Contracts\OrderContract;
use App\viewModels\OrderBookRequest;
 class OrderBookService implements OrderContract{


    protected $order;
    public function __construct(Order $order )
    {
        $this->order = $order;
    }

    public function getAll(){
        return  $this->order::all();
    }

    public function show($id){

            return $this->order::findOrFail($id);
    }

    public function create(OrderBookRequest $order){
                return $this->order::create($order);
    }
     public function orderAccept($id){

         $order = $this->order::findOrFail($id);
         $order->active =1;
         return $order->save();
     }
     public function  getOrderByActive($active){
         return  $this->order->where('active', '=', $active)->get();
     }


}
