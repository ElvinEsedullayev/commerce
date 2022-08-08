<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section','section_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id');
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\ProductsAttribute');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductsImages');
    }

    public static function productFilters()
    {
        $productFilters['fabricArray'] = array('Cotton','Polyester','Wool');
        $productFilters['sleeveArray'] = array('Full Sleeve','Half Sleeve','Short Sleeve','Sleevess');
        $productFilters['patternArray'] = array('Checked','Plain','Printed','Self','Solid');
        $productFilters['fitArray'] = array('Regular','Slim');
        $productFilters['occasionArray'] = array('Casual','Formal');
        return $productFilters;
    }

    public static function getDiscountedProduct($product_id)
    {
        $proDetail = Product::select('category_id','product_discount','product_price')->where('id',$product_id)->first()->toArray();
        $catDetail = Category::select('discount')->where('id',$proDetail['category_id'])->first()->toArray();
        if($proDetail['product_discount'] > 0){
            $discountPrice = $proDetail['product_price'] - ($proDetail['product_price'] * $proDetail['product_discount'] / 100);
        }else if($catDetail['discount'] > 0){
            $discountPrice = $proDetail['product_price'] - ($proDetail['product_price'] * $catDetail['discount'] / 100);
        }else{
            $discountPrice = 0;
        }
        return $discountPrice;
    }

    public static function getDiscountAttrPrice($product_id,$size)
    {
        $attrProDetail = ProductsAttribute::where(['product_id' => $product_id, 'size' => $size])->first()->toArray();
        $proDetail = Product::select('category_id','product_discount')->where('id',$product_id)->first()->toArray();
        $catDetail = Category::select('discount')->where('id',$proDetail['category_id'])->first()->toArray();

        if($proDetail['product_discount'] > 0){
            $discountPrice = $attrProDetail['price'] - ($attrProDetail['price'] * $proDetail['product_discount'] / 100);
            $discount = $attrProDetail['price'] - $discountPrice;
        }else if($catDetail['discount'] > 0){
            $discountPrice = $attrProDetail['price'] - ($attrProDetail['price'] * $catDetail['discount'] / 100);
            $discount = $attrProDetail['price'] - $discountPrice;
        }else{
            $discountPrice = $attrProDetail['price'];
            $discount = 0;
        }
        //return $discountPrice;
        return array('price' => $attrProDetail['price'], 'discount_price' => $discountPrice,'discount' => $discount);
    }
    
}
