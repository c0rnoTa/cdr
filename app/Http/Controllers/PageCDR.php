<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PageCDR extends Controller
{
    // Структура звонка
    private static $call = ['callDestination','callSource','callDate'];
    
    // Просто отображает все данные
    public function index() {

        $dst = DB::select('SELECT DISTINCT `dst` FROM `cdr`');
        $calls = DB::select('SELECT * FROM `cdr`');

        return view('cdr.index', ['calls' => $calls , 'dst' => $dst ] );
    }
    
    // Обрабатывает POST запрос поиска
    public function search() {
        
        // Записываем полученные параметры в структуру искомого звонка
        foreach (self::$call as $value) {
            if ( isset($_POST[ $value ]) ) {
                $search[ $value ] = $_POST[ $value ];
            } else {
                $search[ $value ] = null;
            }
        }
        
        $where='';
        
        // Добавляем дату звонка к поиску
        if ( $search['callDate'] ) {
            $date = \DateTime::createFromFormat('m/d/Y', $search['callDate']);
            $where .= " AND `calldate` BETWEEN '" . $date->format('Y-m-d 00:00:00') . "' AND '" . $date->format('Y-m-d 23:59:59') . "'";
        }
        
        $dst = DB::select('SELECT DISTINCT `dst` FROM `cdr`');
        $calls = DB::select('SELECT * FROM `cdr` WHERE 1 ' . $where);

        return view('cdr.index', ['calls' => $calls , 'dst' => $dst ] );
    }
}
