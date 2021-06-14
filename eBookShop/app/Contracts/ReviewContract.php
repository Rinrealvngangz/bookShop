<?php


namespace App\Contracts;


interface ReviewContract
{
    public function postReview($request, $id);

}
