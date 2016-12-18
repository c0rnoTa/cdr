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

        // Собираем данные из БД
        $calls = $this->getAllCalls($requestcall);
        $callsByDst = $this->getCallsByDst($requestcall);

        //$colornames = ['blue','green','purple','aero','red','dark'];

        return view('cdr.index', compact('dst','requestcall','calls','callsByDst') );
    }
    
    /** Функция собирает условия выборки SQL запроса
     * @param array $call Структура искомого звонка
     * @return array('clause','bindings')
     */
    private function buildQuery($call) {

        // Разбираем критерии выборки данных
        $where = array();
        $bindings = array();

        // Добавляем дату звонка к поиску
        if ( $call['callDate'] ) {
            $date = \DateTime::createFromFormat('m/d/Y', $call['callDate']);
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
        if ( $call['callDestination'] ) {
            $where[] = '(`dst` LIKE ? )';
            $bindings[] = $call['callDestination'];
        }

        // Добавляем номер клиента к поиску
        if ( $call['callSource'] ) {
            $where[] = '(`src` LIKE ? )';
            $bindings[] = '%'.$call['callSource'];
        }

        // Собираем массив WHERE CLAUSE в строку, которую будем добавлять в SQL запрос
        if ( count($where) > 0 ) {
            if ( count($where) == 1) {
                $where = ' WHERE ' . $where[0];
            } else {
                $where = ' WHERE ' . implode('AND ', $where);
            }
        }

        return array('clause' => $where, 'bindings' => $bindings);
    }

    /** Функция возвращает детальный список звонков
     * @param array $call Массив с параметрами искомого звонка
     * @return array Массив найденных звонков
     */
    public function getAllCalls( $call = null ) {

        // Получаем условия выборки исходя из запроса
        $where = $this->buildQuery($call);

        // Собираем SQL запрос с учетом критериев выборки данных из таблицы
        $query = 'SELECT * FROM `cdr` ' . $where['clause'];

        // Делаем запрос и возвращаем данные
        return DB::select($query, $where['bindings']);
    }

    /** Функция возвращает количество вызовов по каждому dst
     * @param array $call Массив с параметрами звонка запроса
     * @return array Колличество вызовов по каждому номеру
     */
    public function getCallsByDst($call = null) {

        // Получаем условия выборки исходя из запроса
        $where = $this->buildQuery($call);

        // Собираем SQL запрос с учетом критериев выборки данных из таблицы
        $query = 'SELECT `dst`, count(*) as `amount` FROM `cdr` ' . $where['clause'] . ' GROUP BY `dst` ORDER BY `amount` DESC LIMIT 6';

        // Делаем запрос и возвращаем данные
        $dststats = DB::select($query, $where['bindings']);

        return $dststats;
    }
}
