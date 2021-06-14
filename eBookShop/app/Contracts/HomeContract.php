<?php

namespace App\Contracts;


interface HomeContract
{
    public function getAll();
    public function productBestSell();
    public function getPoductByType($type);
    public function productKinhTe();
   public  function  getProductSale();
   public function getProductChildren();
   public function getProductManga();
    public function getProductSeriesManga();
    public function findProduct($request);
    public function getByCategory($name,$id,$key);
    public function getByProductByCategory($name,$id);
    public function sortPriceById($name,$id,$key);
    public function sortNameById($name,$id,$key);
    public function showRecordWithSort($name,$id,$record ,$key);
   public function sortFormalityById($name,$id,$key);
   public function getProductDetail(string $title, $id);
}
