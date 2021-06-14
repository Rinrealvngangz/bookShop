<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageBook extends Model
{
    use HasFactory;
    protected $uploads = '/imagesBook/';
    protected $fillable=[
        'file',
        'book_id'
    ];
    public function book(){
        return $this->belongsTo('App\Models\Book');
    }

    public function getFileAttribute($value)
    {
        return $this->uploads . $value;
    }
}
