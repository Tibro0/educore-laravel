<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.pages.home.index');
    }

    public function frontendRegisterListStyle(Request $request)
    {
        Session::put('frontend_register_list_style', $request->style);
    }
}
