<?php


namespace App\Contracts;


interface PermissionContract
{
    public function getAll();
    public function show($id);
    public function create($request);
    public function update($request,$id);
    public function delete($request,$id);
    public function edit($id);
}
