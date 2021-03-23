<?php namespace App\Contracts;
use App\viewModels\OrderBookRequest;

interface OrderContract{
    public function getAll();
    public function show($id);
    public function create(OrderBookRequest $orderBookRequest);
}
