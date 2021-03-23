<?php namespace App\viewModels;

class OrderBookRequest{
    private $userId;
    private $discountId;

    public function setUserId($userId) {
        $this->userId = $userId;
      }

      public function getUserId() {
        return $this->userId;
      }

      public function setDiscountId($discountId) {
        $this->discountId = $discountId;
      }

      public function getDiscountId() {
        return $this->discountId;
      }

}
