<?php

namespace App\Http\Controllers\mean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class meancontroller extends Controller
{
    function index()
    {
        return view('dashboard.mean.index');
    }
}
