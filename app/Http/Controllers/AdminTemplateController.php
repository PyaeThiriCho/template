<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTemplateController extends Controller
{
    public function index()
    {
        return view('template.index');
    }

     public function layoutstat()
    {
        return view('template.layoutstat');
    }

    public function layoutsidenav()
    {
        return view('template.layoutsidenav');
    }

    public function login()
    {
        return view('template.login');
    }

    public function register()
    {
        return view('template.register');
    }

    public function password()
    {
        return view('template.password');
    }

     public function error()
    {
        return view('template.error');
    }

     public function chart()
    {
        return view('template.chart');
    }

     public function table()
    {
        return view('template.table');
    }
}
