<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable=[
        'user_id',
        'category_id',
        'name',
        'slug',
        'brand',
        'small_description',
        'description',
        'orignal_price',
        'selling_price',
        'quantity',
        'trending',
        'status',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];

    public function category(){
        return $this->belongsTo(Category::class , 'category_id','id');
    }
   
    public function productImages(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
    public function comments(){
        return $this->hasMany(Comment::class ,'product_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    
   
}
