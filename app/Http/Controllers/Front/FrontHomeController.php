<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    public function home()
    {
        $index_page = 'index';
        return view('front.home.index');
    }
}
