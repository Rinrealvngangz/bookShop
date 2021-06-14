<?php
namespace App\Contracts;

interface CategoryContract
{
    public function getAll($Categories,$parent_id);
    public function childview($Category);
    public function show($id);
    public function create();
    public function update($request,$id);
    public function delete($request,$id);
    public function store($request);
}
