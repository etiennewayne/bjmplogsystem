<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyDashboardController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        return view('client.my-dashboard');
    }
}
