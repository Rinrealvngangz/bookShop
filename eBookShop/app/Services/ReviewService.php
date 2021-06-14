<?php


namespace App\Services;


use App\Contracts\ReviewContract;
use App\Events\ReviewNotification;
use App\Models\Rating;

class ReviewService implements ReviewContract
{

    public function postReview($request, $id)
    {
         $rating = Rating::create(['customerReview'=>$request->nameCustomer,'numberRating'=>$request->numberStar,
                       'descRating'=>$request->reviewDesc,'book_id'=>$id]);

        event(new ReviewNotification($rating,$rating->book->title));
                   return "Nhận xét của bạn sẽ được kiểm duyệt trước khi hiển thị.";
    }
}
