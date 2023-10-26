<?php

namespace App\Http\Controllers\Dashbord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    function index()
    {
        $array = [1,2,3,4,'felipe'];
        $name = 'Felipe';
        return view("dashboard.test.index",compact('array','name'));
    }
}
