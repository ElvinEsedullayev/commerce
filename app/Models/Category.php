<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function subcategories()
    {
        return $this->hasMany('App\Models\Category','parent_id')->where('status',1);
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section','section_id')->select('id','name');
    }

    public function parentcategory()
    {
        return $this->belongsTo('App\Models\Category','parent_id')->select('id','category_name');
    }

    public static function catDetails($url)
    {
        $catDetails = Category::select('id','parent_id','category_name','url','description')->with('subcategories',function($query){
            $query->select('id','parent_id','category_name','url','description')->where('status',1);
        })->where('url',$url)->first()->toArray();
        //dd($categoyDetails);
        if($catDetails['parent_id'] == 0){
            //only show main category and breadcrumb
            $breadcrumbs = '<a href="'.url($catDetails['url']).'">'.$catDetails['category_name'].'</a>';
        }else{
            //show main and subcategory breadcrumb
            $parentCategory = Category::select('category_name','url')->where('id',$catDetails['parent_id'])->first()->toArray();
            $breadcrumbs = '<a href="'.url($parentCategory['url']).'">'.$parentCategory['category_name'].'</a><span class="divider">/</span>&nbsp;&nbsp;<a href="'.url($catDetails['url']).'">'.$catDetails['category_name'].'</a>';
        }
        $catId = array();
        $catId[] = $catDetails['id'];
        foreach ($catDetails['subcategories'] as $key => $subcategory) {
            $catId[] = $subcategory['id'];
        }
        //dd($catId);
        return array('catId' => $catId, 'categoryDetails' => $catDetails,'breadcrumbs' => $breadcrumbs);//controllerde echo ile baxiriq
    }
}
