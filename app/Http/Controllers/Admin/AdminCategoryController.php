<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use Session;
use Image;
class AdminCategoryController extends Controller
{
    public function category()
    {
        Session::put('page','categories');
        $categories = Category::with(['section','parentcategory'])->get();
        //$categories = json_decode(json_encode($categories),true);
        //echo '<pre></pre>'; print_r($categories); die;
        return view('admin.categories.category')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            if($data['status']== 'Active'){
                $status = 0;
            }else{
                $status =1;
            }
            Category::where('id',$data['category_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'category_id'=>$data['category_id']]);
        }
    }

    public function addEditCategory(Request $request,$id=null)
    {
        if($id == ''){
            $title = 'Add Category';
            $category = new Category;
            // $getCategory = array();
            $getSubategory = array();
            $message = 'Category has been added successfully';
        }else{
            $title = 'Edit Category';
            // $getCategory = Category::where('id',$id)->first();
            $category = Category::find($id);
            $getSubategory = Category::with('subcategories')->where(['parent_id' => 0, 'section_id' => $category['section_id']])->get();
            //$getCategory = json_decode(json_encode($getSubategory),true);
            //echo '<pre></pre>'; print_r($getSubategory); die;
            $message = 'Category has been updated successfully';
        }

        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',
            ];
            $customMessage = [
                'category_name.required' => 'Category Name is required',
                'category_name.regax' => 'Valid Category name is required',
                'section_id.required' => 'Section ID is required',
                'url.required' => 'Category URL is required',
            ];
            $this->validate($request,$rules,$customMessage);
            if($request->hasFile('category_image')){
                $img_tmp = $request->file('category_image');
                if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $imageName = rand(11111,9999999).'.'.$extension;
                    $imagePath = 'front/images/categories/'.$imageName;
                    Image::make($img_tmp)->save($imagePath);
                    $category->category_image = $imageName;
                }
            
            }else{
                $category->category_image = '';//add edende sekil yoxcusa xeta vermesin
            }

            if(empty($data['discount'])){
                $data['discount'] = 0;
            }
            if(empty($data['description'])){
                $data['description'] = '';
            }
            if(empty($data['meta_title'])){
                $data['meta_title'] = '';
            }
            if(empty($data['meta_description'])){
                $data['meta_description'] = '';
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = '';
            }
            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->discount = $data['discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
            session::flash('success',$message);
            return redirect('admin/categories');
        }
        $sections = Section::get();
        return view('admin.categories.add_edit_category')->with(compact('title','sections','category','getSubategory'));
    }

    public function appendCategory(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data);die;
            $categories = Category::with('subcategories')->where(['parent_id' => 0,'section_id' => $data['section_id']])->get();
            //$categories = json_decode(json_encode($categories),true);
            //echo '<pre></pre>'; print_r($categories);die;
            return view('admin.categories.append_category_level')->with(compact('categories'));
        }
    }

    public function categoryImageDelete($id)
    {
        $category = Category::select('category_image')->where('id',$id)->first();
        //get category image path
        $imagePath = 'front/images/categories/';
        if(file_exists($imagePath.$category->category_image)){
            unlink($imagePath.$category->category_image);
        }
        Category::where('id',$id)->update(['category_image' => '']);
        $message = 'Category image has been deleted successfully!';
        return redirect()->back()->with('success',$message);
    }

    public function deleteCategory($id)
    {
        $category = Category::where('id',$id)->delete();
        $message = 'Category has been deleted successfully!';
        session::flash('success',$message);
        return redirect()->back()->with('success',$message);
    }
}
