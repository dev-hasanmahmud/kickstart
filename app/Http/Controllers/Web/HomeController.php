<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('web.home');
    }

    public function aboutUs()
    {
        return view('web.home');
    }

    public function contactUs()
    {
        return view('web.home');
    }

    public function siteMap()
    {
        return view('web.home');
    }

    public function termsConditions()
    {
        return view('web.terms-and-conditions');
    }

    public function privacyPolicy()
    {
        return view('web.privacy-policy');
    }

    public function cookiesPolicy()
    {
        return view('web.cookies-policy');
    }
}
