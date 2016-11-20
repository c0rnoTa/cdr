<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageCDR extends Controller
{
    public function index() {
        return view('cdr.index');
    }
}
