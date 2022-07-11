<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
//use Illuminate\Pagination\Paginator;
//use App\CustomClasses\ColectionPaginate;
class FrontProductController extends Controller
{
    public function listing($url)
    {
        $categoryCount = Category::where(['url' => $url,'status' => 1])->count();
        if($categoryCount > 0){
            //echo 'category exists';
            $categoryDetails = Category::catDetails($url);
            //echo '<pre></pre>'; print_r($categoryDetails); die;
            $categoryProduct = Product::with('brand')->whereIn('category_id',$categoryDetails['catId'])->where('status',1);
            //echo '<pre></pre>'; print_r($categoryDetails);
            //echo '<pre></pre>'; print_r($categoryProduct); die;
            //dd($categoryProduct);

            //if  sort option selected by user
            if(isset($_GET['sort']) && !empty($_GET['sort'])){
                if($_GET['sort'] == 'latest_products'){
                   //echo $_GET['sort']; die;
                   $categoryProduct->orderBy('id','desc');
                  //$d->values()->all();
                   //dd($categoryProduct->orderBy(['id', 'DESC']));
                }else if($_GET['sort'] == 'product_name_a_z'){
                     $categoryProduct->orderBy('product_name','ASC');
                }else if($_GET['sort'] == 'product_name_z_a'){
                     $categoryProduct->orderBy('product_name','DESC');
                }else if($_GET['sort'] == 'lowest_price'){
                     $categoryProduct->orderBy('product_price','ASC');
                }else if($_GET['sort'] == 'highest_price'){
                     $categoryProduct->orderBy('product_price','DESC');
                }
            }else{
                 $categoryProduct->orderBy('id','DESC');
            } 
            $categoryProduct = $categoryProduct->paginate(3);
            return view('front.products.listing')->with(compact('categoryDetails','categoryProduct'));
        }else{
            abort(404);
        }
    }
}
