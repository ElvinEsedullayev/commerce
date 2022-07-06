<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    public static function banners()
    {
        $banners = Banner::where('status',1)->get()->toArray();
        //dd($banners);
        return $banners;
    }
}