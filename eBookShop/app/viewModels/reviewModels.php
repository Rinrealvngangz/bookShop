<?php


namespace App\viewModels;


class reviewModels
{
    private $nameReviewer;
    private $numberStar;
    private $reviewDesc;
    private $create_at;

    public function setNameReviewer($nameReviewer) {
        $this->nameReviewer =$nameReviewer;
    }


    public function getNameReviewer()  {
        return $this->nameReviewer;
    }

    public function setNumberStar($numberStar) {
        $this->numberStar =$numberStar;
    }


    public function getNumberStar()  {
        return $this->numberStar;
    }

    public function setReviewDesc($reviewDesc) {
        $this->reviewDesc =$reviewDesc;
    }


    public function getReviewDesc()  {
        return $this->reviewDesc;
    }

    public function setCreate_atReview($create_at) {
        $this->create_at =$create_at;
    }


    public function getCreate_atReview()  {
        return $this->create_at;
    }
}
