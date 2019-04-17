<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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

    /**
     * Создание нового пользователя
     */
    public function save() {
        // process the login
        if (Input::get('password') != Input::get('password-conform')) {
            return 'passwords mismatch';
        }
        if (empty(Input::get('login'))) {
            return 'login is not set';
        }

        $user = new User;
        $user->name       = Input::get('name');
        $user->login      = Input::get('login');
        $user->password   = bcrypt(Input::get('password'));
        $user->email      = Input::get('login').'@example.com';
        $user->save();

        // redirect
        //Session::flash('message', 'Successfully created user!');
        return Redirect::to('users');


    }
}
