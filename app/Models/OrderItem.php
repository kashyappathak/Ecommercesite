<?php

namespace App\Models;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = ['user_id','order_id','product_id','name','quantity','selling_price','total','status','shipped_date'];

    public function productImages(){
        return $this->belongsTo(ProductImage::class,'product_id','id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
