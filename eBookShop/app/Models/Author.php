<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
  protected $appends =['full_name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'lastName',
    ];

    public  function books(){
             return $this->hasMany('App\Models\Book','author_id','id');
    }

    public function getFullNameAttribute(){
      return  "{$this->lastName} {$this->firstName}";
    }

}
