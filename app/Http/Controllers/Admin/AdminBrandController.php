<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Session;
class AdminBrandController extends Controller
{
    public function brand()
    {
        Session::put('page','brands');
        $brands = Brand::get();
        return view('admin.brands.brand')->with(compact('brands'));
    }

    public function updateBrandStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();

            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Brand::where('id',$data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }

    public function addEditBrand(Request $request,$id = null)
    {
        if($id == ''){
            $title = 'Add Brand';
            $brand = new Brand;
            $success = 'Brand has been added successfully!';
        }else{
            $title = 'Edit Brand';
            $brand = Brand::find($id);
            $success = 'Brand has been updated successfully!';
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u'
            ];
            $customMessage = [
                'name.required' => 'Name is required',
                'name.regax' => 'Valid name is required',
            ];
            $this->validate($request,$rules,$customMessage);
            $brand->name = $data['name'];
            $brand->status = 1;
            $brand->save(); 
            return redirect('admin/brands')->with('success',$success);
        }
        return view('admin.brands.add_edit_brand')->with(compact('title','brand'));
    }

    public function brandDelete($id)
    {
        $brand = Brand::where('id',$id)->delete();
        $success = 'Brand has been deleted successfully';
        return redirect()->back()->with('success',$success);
    }
    
}
