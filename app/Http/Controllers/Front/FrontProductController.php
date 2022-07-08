<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class FrontProductController extends Controller
{
    public function listing($url)
    {
        $categoryCount = Category::where(['url' => $url,'status' => 1])->count();
        if($categoryCount > 0){
            //echo 'category exists';
            $categoryDetails = Category::catDetails($url);
            //echo '<pre></pre>'; print_r($categoryDetails); die;
            $categoryProduct = Product::with('brand')->whereIn('category_id',$categoryDetails['catId'])->where('status',1)->get()->toArray();
            //echo '<pre></pre>'; print_r($categoryDetails);
            //echo '<pre></pre>'; print_r($categoryProduct); die;
            return view('front.products.listing')->with(compact('categoryDetails','categoryProduct'));
        }else{
            abort(404);
        }
    }
}
