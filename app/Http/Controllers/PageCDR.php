<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PageCDR extends Controller
{
    public function index() {

        $dst = DB::select('SELECT DISTINCT `dst` FROM `cdr`');
        $calls = DB::select('SELECT * FROM `cdr`');

        //return $cdr;
        return view('cdr.index', ['calls' => $calls , 'dst' => $dst ] );
    }
}
