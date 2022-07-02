<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\ProductsImages;
use App\Models\Section;
use App\Models\Category;
use App\Models\Brand;
use Session;
use Image;
class AdminProductController extends Controller
{
    public function product()
    {
        Session::put('page','products');
        $products = Product::with(['category' => function($query){
            $query->select('id','category_name');
        },'section' => function($query){
            $query->select('id','name');
        }])->get();
        // $products = json_decode(json_encode($products),true);
        // echo '<pre></pre>'; print_r($products); die;
        return view('admin.products.product')->with(compact('products'));
    }

    public function updateProductStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();

            if($data['status'] ==  'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id',$data['product_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'product_id'=>$data['product_id']]);
        }
    }

    public function updateAttributeStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();

            if($data['status'] ==  'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsAttribute::where('id',$data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'attribute_id'=>$data['attribute_id']]);
        }
    }
    public function updateImageStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();

            if($data['status'] ==  'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsImages::where('id',$data['image_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'image_id'=>$data['image_id']]);
        }
    }

    public function addEditProduct(Request $request,$id=null)
    {
        if($id == ''){
            $title = 'Add Product';
            $product = new Product;
            $message = 'Product has been added successfully!';
        }else{
            $title = 'Edit Product';
            $product = Product::find($id);
            //$product = json_decode(json_encode($product),true);
            //echo '<pre></pre>'; print_r($product);die;
            $message = 'Product has been updated successfully!';
        }

        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data);die;
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^\w+$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessage = [
                'category_id.required' => 'Category ID is required',
                'product_name.required' => 'Product name is required',
                'product_name.regax' => 'Valid Product name is required',
                'product_code.required' => 'Product code is required',
                'product_code.regax' => 'Valid Product code is required',
                'product_price.required' => 'Product price is required',
                'product_price.regax' => 'Valid Product code is required',
                'product_color.required' => 'Product color is required',
                'product_color.regax' => 'Valid Product color is required',
            ];
            $this->validate($request,$rules,$customMessage);

            if(empty($data['is_featured'])){
                $is_featured = 'No';
            }else{
                $is_featured = 'Yes';
            }
            if(empty($data['fabric'])){
                $data['fabric'] = '';
            }
            if(empty($data['sleeve'])){
                $data['sleeve'] = '';
            }
            if(empty($data['fit'])){
                $data['fit'] = '';
            }
            if(empty($data['occasion'])){
                $data['occasion'] = '';
            }
            if(empty($data['wash_care'])){
                $data['wash_care'] = '';
            }
            if(empty($data['pattern'])){
                $data['pattern'] = '';
            }
            if(empty($data['product_discount'])){
                $data['product_discount'] = 0;
            }
            if(empty($data['description'])){
                $data['description'] = '';
            }
            if(empty($data['meta_description'])){
                $data['meta_description'] = '';
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = '';
            }
            if(empty($data['meta_title'])){
                $data['meta_title'] = '';
            }
            if(empty($data['product_video'])){
                $data['product_video'] = '';
            }
            if(empty($data['product_image'])){
                $data['product_image'] = '';
            }
            //Upload image resize: small 250x250,medium 500x500,large 1000x1000
            if($request->hasFile('product_image')){
                $img_tmp = $request->file('product_image');
                 if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $imageName = rand(11111,9999999).'.'.$extension;
                    $largeImagePath = 'front/images/products/large/'.$imageName;
                    $mediumImagePath = 'front/images/products/medium/'.$imageName;
                    $smallImagePath = 'front/images/products/small/'.$imageName;
                    Image::make($img_tmp)->resize(1040,1200)->save($largeImagePath);
                    Image::make($img_tmp)->resize(520,600)->save($mediumImagePath);
                    Image::make($img_tmp)->resize(260,300)->save($smallImagePath);
                    $product->product_image = $imageName;
                }
            }

            //upload product video
            if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = rand(11111,99999).'.'.$extension;
                    $videoPath = 'front/videos/products/';
                    $video_tmp->move($videoPath,$videoName);
                    $product->product_video = $videoName;
                }
            }
                $categoryDetails = Category::find($data['category_id']);
                $product->section_id = $categoryDetails['section_id'];
                $product->category_id = $data['category_id'];
                $product->brand_id = $data['brand_id'];
                $product->product_name = $data['product_name'];
                $product->product_code = $data['product_code'];
                // $product->product_video = 'video';
                // $product->product_image = 'image';
                $product->product_color = $data['product_color'];
                $product->product_price = $data['product_price'];
                $product->product_discount = $data['product_discount'];
                $product->product_weight = $data['product_weight'];
                $product->description = $data['description'];
                $product->wash_care = $data['wash_care'];
                $product->fabric = $data['fabric'];
                $product->pattern = $data['pattern'];
                $product->sleeve = $data['sleeve'];
                $product->occasion = $data['occasion'];
                $product->fit = $data['fit'];
                $product->meta_title = $data['meta_title'];
                $product->meta_description = $data['meta_description'];
                $product->meta_keywords = $data['meta_keywords'];
                $product->is_featured = $is_featured;
                $product->status = 1;
                $product->save();
                session::flash('success',$message);
                return redirect('admin/products');
        }
        //get category 
        $categories = Section::with('category')->get()->toArray();
        //echo '<pre></pre>'; print_r($categories);die;

        //get brand
        $brands = Brand::where('status',1)->get();
        //filter arrays
        $fabricArray = array('Cotton','Polyester','Wool');
        $sleeveArray = array('Full Sleeve','Half Sleeve','Short Sleeve','Sleevess');
        $patternArray = array('Checked','Plain','Printed','Self','Solid');
        $fitArray = array('Regular','Slim');
        $occasionArray = array('Casual','Formal');
        return view('admin.products.add_edit_product')->with(compact('title','fabricArray','sleeveArray','patternArray','fitArray','occasionArray','categories','product','brands'));
    }

    public function productImageDelete($id)
    {
        $productImage = Product::select('product_image')->where('id',$id)->first();
        $small_image_path = 'front/images/products/small/';
        $medium_image_path = 'front/images/products/medium/';
        $large_image_path = 'front/images/products/large/';
        if(file_exists($small_image_path.$productImage->product_image)){
            unlink($small_image_path.$productImage->product_image);
        }
        if(file_exists($medium_image_path.$productImage->product_image)){
            unlink($medium_image_path.$productImage->product_image);
        }
        if(file_exists($large_image_path.$productImage->product_image)){
            unlink($large_image_path.$productImage->product_image);
        }
        Product::where('id',$id)->update(['product_image' => '']);
        $success = 'Product Image has been deleted successfully';
        return redirect()->back()->with('success',$success);
    }

    public function productVideoDelete($id)
    {
        $productVideo = Product::select('product_video')->where('id',$id)->first();
        $product_video_path = 'front/videos/products/';
        if(file_exists($product_video_path.$productVideo->product_video)){
            unlink($product_video_path.$productVideo->product_video);
        }
        Product::where('id',$id)->update(['product_video' => '']);
        $success = 'Product Video has been deleted successfully';
        return redirect()->back()->with('success',$success);
    }

    public function addEditProductAttribute(Request $request,$id)
    {
        $product = Product::select('id','product_name','product_code','product_color','product_price','product_image')->with('attributes')->find($id);
        $title = 'Add Edit Product Attribute';
        //$product = json_decode(json_encode($product),true);
        //echo '<pre></pre>';print_r($product);die;
        if($request->isMethod('post')){
            $data = $request->all();
            // $data = json_decode(json_encode($data),true);
            // echo '<pre></pre>';print_r($data);die;
            foreach($data['sku'] as $key => $value){
                
                if(!empty($value)){
                    //sku dublicate check
                    $skuCount = ProductsAttribute::where('sku',$value)->count();
                    if($skuCount>0){
                        return redirect()->back()->with('error_message','SKU already exsist. Please add another!');
                    }

                    //size dublicate check
                    $sizeCount = ProductsAttribute::where(['product_id' => $id,'size'=>$data['size'][$key]])->count();
                    if($sizeCount > 0){
                        return redirect()->back()->with('error_message','Size already exsist. Please add another!');
                    }
                    $productAttribute = new ProductsAttribute;
                    $productAttribute->product_id = $id;
                    $productAttribute->sku = $value;
                    $productAttribute->price = $data['price'][$key];
                    $productAttribute->size = $data['price'][$key];
                    $productAttribute->stock = $data['price'][$key];
                    $productAttribute->status = 1;
                    $productAttribute->save();
                }
            }
            return redirect()->back()->with('success','Product Attribute has been added successfully!');
        }
        return view('admin.products.add_edit_attribute')->with(compact('product','title'));
    }

    public function updateAttribute(Request $request,$id)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // $data = json_decode(json_encode($data),true);
            // echo '<pre></pre>'; print_r($data);die;
            foreach($data['attributeId'] as $key => $attribute){
                if(!empty($attribute)){
                    ProductsAttribute::where(['id'=>$data['attributeId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('success','Product Attribute has been updated successfully!');
        }
    }

    public function attributeDelete($id)
    {
        ProductsAttribute::where('id',$id)->delete();
        $message = 'Attribute has been deleted successfully!';
        session::flash('success',$message);
        return redirect()->back()->with('success',$message);
    }

    public function addEditProductImages(Request $request,$id)
    {
        $products = Product::select('id','product_name','product_code','product_color','product_price','product_image')->with('images')->find($id);
        // $products = json_decode(json_encode($products),true);
        // echo '<pre></pre>'; print_r($products);die;
        $title = 'Add Multiple Product Images';
        if($request->isMethod('post')){
            $data = $request->all();
            // $data = json_decode(json_encode($data),true);
            // echo '<pre></pre>'; print_r($data);die;
            if($request->hasFile('images')){
                $images = $request->file('images');
                //echo '<pre></pre>'; print_r($images); die;
                foreach ($images as $key => $image) {
                    $img_tmp = Image::make($image);
                    $img_name = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $imageName = $img_name.rand(11111,9999999).'.'.$extension;
                    $largeImagePath = 'front/images/products/large/'.$imageName;
                    $mediumImagePath = 'front/images/products/medium/'.$imageName;
                    $smallImagePath = 'front/images/products/small/'.$imageName;
                    Image::make($img_tmp)->resize(1040,1200)->save($largeImagePath);
                    Image::make($img_tmp)->resize(520,600)->save($mediumImagePath);
                    Image::make($img_tmp)->resize(260,300)->save($smallImagePath);
                    $image = new ProductsImages;
                    $image->image = $imageName;
                    $image->product_id = $id;
                    $image->status = 1;
                    $image->save();
                }
            }
            return redirect()->back()->with('success','Product Images has been added successfully!');
        }
        return view('admin.products.add_edit_images')->with(compact('products','title'));
    }


    public function imageDelete($id)
    {
        $productImage = ProductsImages::select('image')->where('id',$id)->first();
        $small_image_path = 'front/images/products/small/';
        $medium_image_path = 'front/images/products/medium/';
        $large_image_path = 'front/images/products/large/';
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }
        ProductsImages::where('id',$id)->delete();
        $success = 'Product Images has been deleted successfully';
        return redirect()->back()->with('success',$success);
    }
}
