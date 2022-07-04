<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class FrontHomeController extends Controller
{
    public function home()
    {
        $featuredItemCount = Product::where('is_featured','Yes')->where('status',1)->count();
        $productItems = Product::where('is_featured','Yes')->where('status',1)->get()->toArray();
        $productItemChuck = array_chunk($productItems,4);
        //echo '<pre></pre>'; print_r($productItemChuck); die;
        $newProducts = Product::orderBy('id','Desc')->where('status',1)->limit(6)->get()->toArray();
        $newProducts = json_decode(json_encode($newProducts),true);
        //echo '<pre></pre>'; print_r($newProducts); die;
        $index_page = 'index';
        return view('front.home.index')->with(compact('index_page','productItemChuck','newProducts','featuredItemCount'));
    }
}
