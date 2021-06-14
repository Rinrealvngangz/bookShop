<?php


namespace App\viewModels;


class showOrderModels
{
    private $id;
    private $payment;
    private $payment_note;
    private $note;
    private $userId;
    private $name;
    private $fullName;
    private $email;
    private $city;
    private $phoneNumber;
    private $address;
    private $country;
    private $district;
    private $totalPrice;
    private $totalPriceFee;
    private $status;
    private $create_at;
    private $listBookViewModel =array();

    public function setPayment($payment) {
        $this->payment = $payment;
    }

    public function getPayment() {
        return $this->payment;
    }

    public function setPaymentNote($payment_note) {
        $this->payment_note = $payment_note;
    }

    public function getPaymentNote() {
        return $this->payment_note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function getNote() {
        return $this->note;
    }


    public function setCreate_at($create_at) {
        $this->create_at = $create_at;
    }

    public function getCreate_at() {
        return $this->create_at;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
    public function setDistrict($district) {
        $this->district = $district;
    }

    public function getDistrict() {
        return $this->district;
    }
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getCity() {
        return $this->city;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getAddress() {
        return $this->address;
    }


    public function setCountry($country) {
        $this->country = $country;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setTotalPrice($totalPrice) {
        $this->totalPrice = $totalPrice;
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }

    public function setTotalPriceFee($totalPriceFee) {
        $this->totalPriceFee = $totalPriceFee;
    }

    public function getTotalPriceFee() {
        return $this->totalPriceFee;
    }

    public function setListBookViewModel(bookViewModels $bookViewModel) {
        array_push($this->listBookViewModel,$bookViewModel);
    }


    public function getListBookViewModel() {
        return $this->listBookViewModel;
    }

}
