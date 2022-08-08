<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductsAttribute;
use Session;
use Auth;
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
        $productDetail = Product::with(['category','brand','attributes' => function($query){
            $query->where('status',1);
        },'images'])->find($id)->toArray();
        //dd($productDetail);
        $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');
        $relatedProducts = Product::where('category_id',$productDetail['category']['id'])->where('id','!=',$id)->limit(3)->inRandomOrder()->get()->toArray();
        //dd($relatedProducts);
        return view('front.products.detail')->with(compact('productDetail','total_stock','relatedProducts'));
    }

    public function productPrice(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data);die;
            //$productAttrPrice = ProductsAttribute::where(['product_id' => $data['product_id'],'size' => $data['size']])->first();
            $getDiscountAttrPrice = Product::getDiscountAttrPrice($data['product_id'],$data['size']);
            //return $productAttrPrice->price;
            return $getDiscountAttrPrice;
        }
    }

    public function addToCart(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;

            //check product stock is available or not
            $getProductStock = ProductsAttribute::where(['product_id' =>$data['product_id'],'size' => $data['size']])->first()->toArray();
            //echo $getProductStock['stock']; die;
            if($getProductStock['stock'] < $data['quantity']){//cart icinde secilen mehsul yoxdusa ,sifira beraber
                $message = 'Required quantity is not avaliable';
                session::flash('error_message',$message);
                return redirect()->back();
            }

            //generate session id if not exists
            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }

            if(Auth::check()){
                //user is logged
                $countProduct = Cart::where(['product_id' =>$data['product_id'],'size' => $data['size'],'user_id' => Auth::user()->id])->count();
            }else{
                //user is not logged
                $countProduct = Cart::where(['product_id' =>$data['product_id'],'size' => $data['size'],'session_id' => Session::get('session_id')])->count();
            }

            //check product if already exists in cart
            //$Cart = ProductsAttribute::where(['product_id' =>$data['product_id'],'size' => $data['size']])->count();
            if($countProduct > 0){
                $message = 'Product already exists in cart';
                session::flash('error_message',$message);
                return redirect()->back();
            }

            //add to cart 
            $cart = new Cart;
            if($cart['user_id'] == ''){
                $cart->user_id =0;
            }
            $cart->session_id = $session_id;
            $cart->product_id = $data['product_id'];
            $cart->quantity = $data['quantity'];
            $cart->size = $data['size'];
            $cart->save();
            $message = 'Product has been added in cart successfully';
            session::flash('success',$message);
            return redirect('cart');
        }
    }

    public function cart()
    {
        $userCartItems = Cart::userCartItem();
        //echo '<pre>'; print_r($userCartItems); die;
        return view('front.cart.cart')->with(compact('userCartItems'));
    }

    public function cartItemUpdateQty(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo '<pre>'; print_r($data); die;
            Cart::where('id',$data['cartid'])->update(['quantity' => $data['qty']]);
            $userCartItems = Cart::userCartItem();
            return response()->json(['view' => (String)View::make('front.cart.cart_item')->with(compact('userCartItems'))]);
        }
    }
}
