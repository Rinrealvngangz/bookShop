<?php namespace App\Contracts;

interface UserContract{
    public function getAll();
    public function show($id);
    public function create($request);
    public function update($request,$id);
    public function delete($id);
    public function addRole($request ,$id);
    public function editRole($id);
    public function edit($id);
}
