<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        return view('mytemplate.home');
    }

      public function about()
    {
        return view('mytemplate.about');
    }

      public function contact()
    {
        return view('mytemplate.contact');
    }
}
