<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    //use HasFactory;
    protected $fillable=[
        'thanh_vien',
        'money',
        'note',
        'vnp_response_code',
        'code_vnpay',
        'code_bank',
        'time',
    ];
    public function order(){
        return $this->hasOne('App\Models\Order','payment_id', 'id');
    }

}
