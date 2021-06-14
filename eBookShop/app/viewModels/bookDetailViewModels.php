<?php


namespace App\viewModels;


class bookDetailViewModels
{
    private $size;
    private $bestRating = array();
    private $reviewNumberStar = array();
    private $reviewer = array();
    private $categorySlug;
    private $category;
    private $idcategory;
    private $originalPrice;
    private $percentDiscount;
    private $author;
    private $title;
    private $amount;
    private $price;
    private $listImages = array();
    private $id;
    private $titleSlug;
    private $publihser;
    private $weight;
    private $formality;
    private $number_of_pages;
    private $original_Price;
    private $describe;
    private $listBooKAll = array();
    private $listBooKRecent = array();

    public function setReviewer($reviewer) {
        array_push($this->reviewer,$reviewer);


    }
    public function getReviewer():array {
        return $this->reviewer;
    }

    public function setReviewBest($bestRating) {
        $this->bestRating = $bestRating ;

    }
    public function getReviewBest():array {
        return $this->bestRating;
    }

    public function setReviewNumberStar($numberStar) {
       $this->reviewNumberStar =$numberStar;
    }
    public function getReviewNumberStar():array {
        return $this->reviewNumberStar;
    }

    public function setSize($size) {
        $this->size =$size;
    }


    public function getSize()  {
        return $this->size;
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


    public function setListBookAll($book) {
        array_push($this->listBooKAll,$book);
    }
    public function getListBookAll():array {
        return $this->listBooKAll;
    }

    public function setListBookRecent($book) {
        array_push($this->listBooKRecent,$book);
    }
    public function getListBookRecent():array {
        return $this->listBooKRecent;
    }


    public function setDescribe($describe)
    {
        $this->describe = $describe;
    }
    public function getDescribe()
    {
        return $this->describe;
    }

    public function setOriginal_Price($original_Price)
    {
        $this->original_Price = $original_Price;
    }
    public function getOriginal_Price()
    {
        return $this->original_Price;
    }

    public function setNumber_of_pages($number_of_pages)
    {
        $this->number_of_pages = $number_of_pages;
    }
    public function getNumber_of_pages()
    {
        return $this->number_of_pages;
    }

    public function setFormality($formality)
    {
        $this->formality = $formality;
    }
    public function getFormality()
    {
        return $this->formality;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
    public function getWeight()
    {
        return $this->weight;
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

    public function setlistImages($images) {
        array_push($this->listImages,$images);
    }

    public function getListImages():array {
        return $this->listImages;
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


    public function setPublisher($publihser) {
        $this->publihser = $publihser;
    }

    public function getPublisher() {
        return $this->publihser;
    }
}
