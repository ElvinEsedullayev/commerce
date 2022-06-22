<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Hash;
use Session;
use Image;
class AdminHomeController extends Controller
{
    public function index()
    {  
        Session::put('page','home');
        return view('admin.index');
    }

    public function setting()
    {
        Session::put('page','settings');
        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('admin.settings.admin_setting')->with(compact('adminDetails'));
    }

    public function checkPassword(Request $request)//check current_password with ajax 
    {   
        $data = $request->all();
        //echo '<pre></pre>'; print_r($data); die;
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function updatePassword(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
                //update password
                if($data['new_password'] ==  $data['confirm_password']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    Session::flash('success','Password has been updated successfully');
                    //return redirect()->back();
                }else{
                    Session::flash('error_message','New password and confirm password does not match');
                    return redirect()->back();
                }
            }else{
                Session::flash('error_message','Your Current Password is incorrect!');
                return redirect()->back();
            }
            return redirect()->back();
        }
    }

    public function updateAdminDetails(Request $request)
    {
        Session::put('page','update-admin-details');
        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;

            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
                'admin_image' => 'required|mimes:jpeg,png,jpg,gif'
            ];
            $customMessage = [
                'admin_name.required' => 'Name is required',
                'admin_name.regex' => 'Valid name is required',
                'admin_mobile.required' => 'Mobile is required',
                'admin_mobile.numeric' => 'Valid mobile is required',
                'admin_image.image' => 'Valid Image is required',
            ];
            $this->validate($request,$rules,$customMessage);

            //upload image
                if($request->hasFile('admin_image')){
                $img_tmp = $request->file('admin_image');
                if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $imageName = rand(11111,9999999).'.'.$extension;
                    $imagePath = 'admin/images/admin_image/'.$imageName;
                    Image::make($img_tmp)->save($imagePath);
                }
            }else if(!empty($data['current_admin_image'])){ //bu hecne yazmadan submit duymesine vuranda xeta olmamasi ucun idi
                $imageName = $data['current_admin_image'];
            }else{
                $imageName = '';
            }
            //upload image
            Admin::where('email',Auth::guard('admin')->user()->email)->update(['name' => $data['admin_name'],'mobile' => $data['admin_mobile'],'image' => $imageName]);
            Session::flash('success','Admin Details has been updated successfully');
            return redirect()->back();
        }
        return view('admin.settings.admin_details');
    }
}
