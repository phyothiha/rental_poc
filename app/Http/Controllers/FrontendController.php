<?php

namespace App\Http\Controllers;

class FrontendController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function rentalForm()
    {
        return view('frontend.rental-form');
    }
}
