<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class FrontHomeController extends Controller
{
    public function home()
    {
        $productItemCount = Product::where('is_featured','Yes')->count();
        $productItems = Product::where('is_featured','Yes')->get()->toArray();
        $productItemChuck = array_chunk($productItems,4);
        //echo '<pre></pre>'; print_r($productItemChuck); die;
        $index_page = 'index';
        return view('front.home.index')->with(compact('index_page','productItemChuck'));
    }
}
