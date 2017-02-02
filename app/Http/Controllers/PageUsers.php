<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PageUsers extends Controller
{
    /**
     * Проверяем авторизацию пользователя
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Отображение списка пользователей
     * @return mixed
     */
    public function index() {

        $users = DB::select('SELECT * FROM `users`');
        return view('users.index',compact('users'));
    }
}
