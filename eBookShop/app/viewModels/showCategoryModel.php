<?php


namespace App\viewModels;


class showCategoryModel
{
    private $id;
    private $titleSlug;
    private $name;
    private $parent_id;
    private $childs = array();


    public function setTitleSlug($titleSlug)
    {
        $this->titleSlug = $titleSlug;
    }
    public function getTitleSlug()
    {
        return $this->titleSlug;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getParent_id()
    {
        return $this->parent_id;
    }
    public function setParent_id($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    public function getChilds()
    {
        return $this->childs;
    }
    public function setChilds($childs)
    {
        array_push($this->childs,$childs);
    }

}
