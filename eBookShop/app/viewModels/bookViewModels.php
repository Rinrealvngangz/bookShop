<?php


namespace App\viewModels;


class bookViewModels
{
    private $bestRating = array();
    private $reviewNumberStar;
    private $originalPrice;
    private $percentDiscount;
    private $categorySlug;
    private $category;
    private $idcategory;
    private $author;
    private $title;
    private $amount;
    private $price;
    private $images;
    private $id;
    private $titleSlug;



    public function setReviewBest($bestRating) {
        $this->bestRating = $bestRating ;

    }
    public function getReviewBest():array {
        return $this->bestRating;
    }

    public function setReviewNumberStar($numberStar) {
        $this->reviewNumberStar =$numberStar;
    }
    public function getReviewNumberStar() {
        return $this->reviewNumberStar;
    }


    public function setPercentDiscount($percentDiscount)
    {
        $this->percentDiscount = $percentDiscount;
    }
    public function getPercentDiscount()
    {
        return $this->percentDiscount;
    }

    public function setOriginalPrice($originalPrice)
    {
        $this->originalPrice = $originalPrice;
    }
    public function getOriginalPrice()
    {
        return $this->originalPrice;
    }

    public function setCategorySlug($category) {
        $this->categorySlug =$category;
    }


    public function getCategorySlug()  {
        return $this->categorySlug;
    }

    public function setIdCategory($idcategory) {
        $this->idcategory =$idcategory;
    }


    public function getIdCategory()  {
        return $this->idcategory;
    }

    public function setCategory($category) {
        $this->category =$category;
    }


    public function getCategory()  {
        return $this->category;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }
    public function getAuthor()
    {
        return $this->author;
    }

    public function setTitleSlug($titleSlug)
    {
        $this->titleSlug = $titleSlug;
    }
    public function getTitleSlug()
    {
        return $this->titleSlug;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setImages($images) {
        $this->images = $images;
    }

    public function getImages() {
        return $this->images;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getAmount() {
        return $this->amount;
    }
    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

}
