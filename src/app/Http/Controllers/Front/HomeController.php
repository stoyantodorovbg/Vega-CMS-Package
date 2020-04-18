<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Show the application dashboards.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home');
    }
}
