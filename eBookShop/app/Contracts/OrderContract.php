<?php namespace App\Contracts;
use App\viewModels\OrderBookRequestModels;

interface OrderContract{
    public function getAll();
    public function show($id,$code);
    public function update($request,$id);
    public function create($request,$id);
   public function orderShow($id,$customer);
   public function destroy($id);
    public function updateSalesOrderDetail( $request , $id,  $customer);
    public function createPayment($request);
    public function vnpayReturn($request);
public function deleteSalesOrderDetail($id);
}
