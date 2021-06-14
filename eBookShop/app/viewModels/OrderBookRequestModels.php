<?php namespace App\viewModels;

class OrderBookRequestModels{
    private $userId;
    private $bookId;
    private $amount;
    private $status;
    public function setUserId($userId) {
        $this->userId = $userId;
      }

      public function getUserId() {
        return $this->userId;
      }

      public function setBookId($bookId) {
        $this->bookId = $bookId;
      }

      public function getBookId() {
        return $this->bookId;
      }
    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getAmount() {
        return $this->amount;
    }
    public function setStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

}
