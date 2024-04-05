<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = ['product_id','user_id','image', 'comment'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    
    public function products(){
        return $this->belongsTo(Product::class , 'product_id', 'id');
    }
}
