<?php


namespace App\viewModels;




use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class productViewModels
{
    private $listBook =array();
    private $listCategory =array();
    private $pathName;
    private $nameCategory;
    private $pathId;
    private  $books ;


    public function setNameCategory($nameCategory) {
        $this->nameCategory =$nameCategory;
    }


    public function getNameCategory()  {
        return $this->nameCategory;
    }

    public function setpathName($name) {
       $this->pathName =$name;
    }


    public function getpathName()  {
        return $this->pathName;
    }
    public function setBooks( $books) {
        $this->books =$books;
    }


    public function getBooks()  {
        return $this->books;
    }

    public function setpathId($id) {
        $this->pathId =$id;
    }


    public function getpathId()  {
        return $this->pathId;
    }
    public function setListBook($books) {
        array_push($this->listBook,$books);
    }


    public function getListBook() :array {
        return $this->listBook;
    }

    public function setListCategory( showCategoryModel $category) {
        array_push($this->listCategory,$category);
    }


    public function getListCategory() :array {
        return $this->listCategory;
    }
}
