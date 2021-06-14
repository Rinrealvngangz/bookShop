<?php


namespace App\viewModels;


use App\Models\Order;

class overviewOrderModels
{
    private $amountAccepted;
    private $amountWaitingAccepted;
    private $amountCancel;
    private $amountWaitingDelivery;
    private $amountSuccess;
    private $listRecentOrders =array();

    public function setAmountAccepted($amountAccepted) {
        $this->amountAccepted = $amountAccepted;
    }

    public function getAmountAccepted() {
        return $this->amountAccepted;
    }

    public function setAmountWaitingAccepted($amountWaitingAccepted) {
        $this->amountWaitingAccepted = $amountWaitingAccepted;
    }

    public function getAmountWaitingAccepted() {
        return $this->amountWaitingAccepted;
    }

    public function setAmountCancel($amountCancel) {
        $this->amountCancel = $amountCancel;
    }

    public function getAmountCancel() {
        return $this->amountCancel;
    }

    public function setAmountWaitingDelivery($amountWaitingDelivery) {
        $this->amountWaitingDelivery = $amountWaitingDelivery;
    }

    public function getAmountWaitingDelivery() {
        return $this->amountWaitingDelivery;
    }

    public function setAmountSuccess($amountSuccess) {
        $this->amountSuccess = $amountSuccess;
    }

    public function getAmountSuccess() {
        return $this->amountSuccess;
    }

    public function setListRecentOrders(showOrderModels $orders) {
      array_push($this->listRecentOrders, $orders);
    }

    public function getListRecentOrders() :array {
        return $this->listRecentOrders;
    }

}
