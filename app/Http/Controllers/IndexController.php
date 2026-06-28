<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function lp1() {
        return view('index.lp1');
    }

    public function lp2() {
        return view('index.lp2');
    }

    public function landing_page() {
        return view('index.lp1');
    }
}
