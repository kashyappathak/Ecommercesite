<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name' , 'email' , 'mobile' ,'country_id' ,  'address' , 'apartment' , 'state' , 'city', ' zip' ];


     public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
