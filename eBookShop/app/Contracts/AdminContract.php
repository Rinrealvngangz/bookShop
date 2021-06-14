<?php


namespace App\Contracts;


interface AdminContract
{
    public function getAll();
    public function show($id);
    public function delete($id);
}
