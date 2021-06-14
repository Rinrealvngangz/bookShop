<?php
namespace App\Contracts;

interface BookContract
{
    public function getAll();
    public function show($id);
    public function create();
    public function store($request);
    public function update($request,$id);
    public function delete($id);
    public function edit($id);
    public  function deleteImage($request ,$id);
    public  function discountBook($id);
    public function updateDiscountBook($request,$id);
}
