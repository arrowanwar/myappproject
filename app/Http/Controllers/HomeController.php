<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function HomePage(){
        return Inertia::render('HomePage');
}
}
