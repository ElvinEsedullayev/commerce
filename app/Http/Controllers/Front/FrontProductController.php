<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use Illuminate\Support\Facades\Route;
//use Illuminate\Pagination\Paginator;
//use App\CustomClasses\ColectionPaginate;
class FrontProductController extends Controller
{
    public function listing(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data);die;
            $url = $data['url'];
            $categoryCount = Category::where(['url' => $url,'status' => 1])->count();
            if($categoryCount > 0){
                //echo 'category exists';
                $categoryDetails = Category::catDetails($url);
                //echo '<pre></pre>'; print_r($categoryDetails); die;
                $categoryProduct = Product::with('brand')->whereIn('category_id',$categoryDetails['catId'])->where('status',1);
                //echo '<pre></pre>'; print_r($categoryDetails);
                //echo '<pre></pre>'; print_r($categoryProduct); die;
                //dd($categoryProduct);

                //if fabric filter selected
                if(isset($data['fabric']) && !empty($data['fabric'])){
                    $categoryProduct = Product::whereIn('products.fabric',$data['fabric']);
                }
                //if sleeve filter selected
                if(isset($data['sleeve']) && !empty($data['sleeve'])){
                    $categoryProduct = Product::whereIn('products.sleeve',$data['sleeve']);
                }
                //if pattern filter selected
                if(isset($data['pattern']) && !empty($data['pattern'])){
                    $categoryProduct = Product::whereIn('products.pattern',$data['pattern']);
                }
                //if fit filter selected
                if(isset($data['fit']) && !empty($data['fit'])){
                    $categoryProduct = Product::whereIn('products.fit',$data['fit']);
                }
                //if occasion filter selected
                if(isset($data['occasion']) && !empty($data['occasion'])){
                    $categoryProduct = Product::whereIn('products.occasion',$data['occasion']);
                }

                //if  sort option selected by user
                if(isset($data['sort']) && !empty($data['sort'])){
                    if($data['sort'] == 'latest_products'){
                    //echo $data['sort']; die;
                    $categoryProduct->orderBy('id','desc');
                    //$d->values()->all();
                    //dd($categoryProduct->orderBy(['id', 'DESC']));
                    }else if($data['sort'] == 'product_name_a_z'){
                        $categoryProduct->orderBy('product_name','ASC');
                    }else if($data['sort'] == 'product_name_z_a'){
                        $categoryProduct->orderBy('product_name','DESC');
                    }else if($data['sort'] == 'lowest_price'){
                        $categoryProduct->orderBy('product_price','ASC');
                    }else if($data['sort'] == 'highest_price'){
                        $categoryProduct->orderBy('product_price','DESC');
                    }
                }else{
                    $categoryProduct->orderBy('id','DESC');
                } 
                $categoryProduct = $categoryProduct->paginate(30);
                return view('front.products.ajax_product_listing')->with(compact('categoryDetails','categoryProduct','url'));
            }else{
                abort(404);
            }
        }else{
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['url' => $url,'status' => 1])->count();
            if($categoryCount > 0){
                //echo 'category exists';
                $categoryDetails = Category::catDetails($url);
                //echo '<pre></pre>'; print_r($categoryDetails); die;
                $categoryProduct = Product::with('brand')->whereIn('category_id',$categoryDetails['catId'])->where('status',1);
                //echo '<pre></pre>'; print_r($categoryDetails);
                //echo '<pre></pre>'; print_r($categoryProduct); die;
                //dd($categoryProduct);                
                $categoryProduct = $categoryProduct->paginate(30);
                //product filters
                $productFilters = Product::productFilters();
                $fabricArray = $productFilters['fabricArray'];
                $sleeveArray = $productFilters['sleeveArray'];
                $patternArray = $productFilters['patternArray'];
                $fitArray = $productFilters['fitArray'];
                $occasionArray = $productFilters['occasionArray'];
                $index_page = 'listing';
                return view('front.products.listing')->with(compact('categoryDetails','categoryProduct','url','fabricArray','sleeveArray','patternArray','fitArray','occasionArray','index_page'));
            }else{
                abort(404);
            }
        }
        
    }

    public function detail($id)
    {
        $productDetail = Product::with('category','brand','attributes','images')->find($id)->toArray();
        //dd($productDetail);
        $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');
        return view('front.products.detail')->with(compact('productDetail','total_stock'));
    }
}
