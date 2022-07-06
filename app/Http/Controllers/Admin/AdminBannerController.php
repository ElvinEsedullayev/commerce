<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Session;
use Image;
class AdminBannerController extends Controller
{
    public function banner()
    {
        Session::put('page','banners');
        $banners = Banner::get()->toArray();
        return view('admin.banners.banner')->with(compact('banners'));
    }

    public function updateBannerStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Banner::where('id',$data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }

    public function deleteBanner($id)
    {
        $banner = Banner::where('id',$id)->first();
        $image_path = 'front/images/banner/';
        if(file_exists($image_path.$banner->banner_image)){
            unlink($image_path.$banner->banner_image);
        }
        $banner = Banner::where('id',$id)->delete();
        $success = 'Banner has been deleted successfully!';
        return redirect()->back()->with('success',$success);
    }

    public function addEditBanner(Request $request, $id=null)
    {
        if($id == ''){
            $title = 'Add Banner';
            $banner = new Banner;
            $success = 'Banner has been added successfully';
        }else{
            $title = 'Updated Banner';
            $banner = Banner::find($id);
            $success = 'Banner has been updated successfully!';
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $rules = [
                'title' => 'required|regex:/^[\pL\s\-]+$/u',
                'alt' => 'required|regex:/^[\pL\s\-]+$/u',
                'link' => 'required',
            ];
            $customMessage = [
                'title.required' => 'Title is required',
                'alt.required' => 'Alt is required',
                'link.required' => 'Link  is required',
            ];
            $this->validate($request,$rules,$customMessage);
            if($request->hasFile('banner_image')){
                $img_tmp = $request->file('banner_image');
                if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $imageName = rand(11111,9999999).'.'.$extension;
                    $imagePath = 'front/images/banners/'.$imageName;
                    Image::make($img_tmp)->resize(1170,480)->save($imagePath);
                    $banner->banner_image = $imageName;
                }
            }
            if(empty($data['link'])){
                $data['link'] = '';
            }
            $banner->title = $data['title'];
            $banner->alt = $data['alt'];
            $banner->link = $data['link'];
            $banner->status = 1;
            $banner->save();
            return redirect('admin/banners')->with('success',$success);
        }
        return view('admin.banners.add_edit_banner')->with(compact('title','banner'));
    }
}
