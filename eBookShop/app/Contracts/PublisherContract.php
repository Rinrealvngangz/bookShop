<?php
namespace App\Contracts;

interface PublisherContract{

    public function getAll();
    public function create($request);
    public function update($Request);
    public function delete($Request);
}
