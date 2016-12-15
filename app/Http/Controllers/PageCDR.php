<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PageCDR extends Controller
{
    // Структура звонка
    private static $call = ['callDestination','callSource','callDate'];
    
    // Функция отображает данные о звонках
    public function index() {

        // Получаем список всех городских номеров
        $dst = DB::select('SELECT DISTINCT `dst` FROM `cdr`');

        // Если были получены данные из формы поиска
        // записываем их в структуру искомого звонка
        $requestcall = array();
        foreach (self::$call as $value) {
            if ( Input::has($value) ) {
                $requestcall[ $value ] = Input::get($value);
            } else {
                $requestcall[ $value ] = null;
            }
        }

        // Ищем звонки
        $calls = $this->search( $requestcall );

        //return compact('calls','dst','requestcall');

        return view('cdr.index', compact('calls','dst','requestcall') );
    }
    
    // Функция ищет звонки в базе
    public function search( $search ) {

        // Разбираем критерии выборки данных
        $where = array();
        $bindings = array();

        // Добавляем дату звонка к поиску
        if ( $search['callDate'] ) {
            $date = \DateTime::createFromFormat('m/d/Y', $search['callDate']);
            $where[] = '(`calldate` BETWEEN ? AND ?)';
            $bindings[] = $date->format('Y-m-d 00:00:00');
            $bindings[] = $date->format('Y-m-d 23:59:59');
        } else {
            $date = new \DateTime('NOW');
            $where[] = '(`calldate` BETWEEN ? AND ?)';
            $bindings[] = $date->format('Y-m-01 00:00:00');
            $bindings[] = $date->format('Y-m-t 23:59:59');
        }

        // Добавляем городской номер к поиску
        if ( $search['callDestination'] ) {
            $where[] = '(`dst` LIKE ? )';
            $bindings[] = $search['callDestination'];
        }

        // Добавляем номер клиента к поиску
        if ( $search['callSource'] ) {
            $where[] = '(`src` LIKE ? )';
            $bindings[] = '%'.$search['callSource'];
        }

        // Собираем SQL запрос и критерии выборки данных
        $query = 'SELECT * FROM `cdr`';
        if ( count($where) > 0 ) {
            $query .= 'WHERE ';
            if ( count($where) == 1) {
                $query .= $where[0];
            } else {
                $query .= implode('AND ', $where);
            }
        }

        // Возвращаем данные
        return DB::select($query, $bindings);
    }
}
