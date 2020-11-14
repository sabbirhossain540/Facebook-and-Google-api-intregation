<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleCalenderController extends Controller
{
    public function index(){
        return view('pages.calender');
    }
}
