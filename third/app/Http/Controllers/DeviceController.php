<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class DeviceController extends Controller
{
    function index()
    {
        $data = 20;  // Correct assignment here
        return Blade::render('<h1>{{ $total }} hello Amarth</h1>', ['total' => $data]);
    }
}
