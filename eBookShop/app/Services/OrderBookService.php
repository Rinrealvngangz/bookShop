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
}
