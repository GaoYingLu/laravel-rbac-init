<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Goods;
use App\Tools\ToolTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

}
