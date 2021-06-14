<?php
namespace App\Contracts;

interface RoleContract{
    public function getAll();
    public function show($id);
    public function create($request);
    public function update($request,$id);
    public function delete($id);
    public function edit($id);

}
