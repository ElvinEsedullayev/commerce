<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
class Cart extends Model
{
    use HasFactory; 
    public static function userCartItem()
    {
        if(Auth::check()){
            $userCartItem = Cart::with(['product' => function($query){
                $query->select('id','product_name','product_color','product_image','product_price','product_code');
            }])->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
        }else{
            $userCartItem = Cart::with(['product' => function($query){
                $query->select('id','product_name','product_color','product_image','product_price','product_code');
            }])->where('session_id',Session::get('session_id'))->orderBy('id','Desc')->get()->toArray();
        }
        return $userCartItem;
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }

    public static function getAttributePrice($product_id,$size)
    {
        $getAttributePrice = ProductsAttribute::select('price')->where(['product_id' => $product_id, 'size' => $size])->first()->toArray();
        return $getAttributePrice['price'];
    }
}
