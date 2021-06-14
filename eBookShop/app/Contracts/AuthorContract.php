<?php
namespace App\Contracts;

interface AuthorContract{

    public function getAll();
    public function create($request);
    public function update($Request);
    public function delete($Request);
    public function showBook($id);
}
