<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'state'
    ];

    // public function books(){
    //      return $this->belongsToMany('App\Models\Book');
    // }
}