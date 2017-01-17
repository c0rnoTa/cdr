<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PageCDR extends Controller
{
    // Структура звонка
    private static $call = ['callDestination','callSource','callDate'];
    
    /** Приём запроса и отображение данных */
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
        $statsByDst = $this->getStatsByDst($requestcall);
        $statsByDisposition = null;
        if( count($statsByDst)==1 ) {
            $statsByDisposition = $this->getStatsByDisposition($requestcall);
            $statsByDst = null;
        }
        $callsByDate = $this->getCallsByDate($requestcall);
        $callsByHour = null;
        if( count($callsByDate)==1 ) {
            $callsByHour = $this->getCallsByHour($requestcall);
            $callsByDate = null;
        }

        return view('cdr.index', compact('dst','requestcall','calls','statsByDst','statsByDisposition','callsByDate','callsByHour') );
    }
    
    /** Учет условий выборки и сбор SQL запроса
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
            $date = new \DateTime('NOW', new \DateTimeZone(ini_get('date.timezone')));
            $where[] = '(`calldate` BETWEEN ? AND ? )';
            $bindB = $date->format('Y-m-d 23:59:59');
            $date->modify('-31 day');
            $bindings[] = $date->format('Y-m-d 00:00:00');
            $bindings[] = $bindB;
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

        return ['clause' => $where, 'bindings' => $bindings];
    }

    /** Детальный список звонков
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

    /** Количество вызовов по каждому городскому номеру
     * @param array $call Массив с параметрами звонка запроса
     * @return array Колличество вызовов по каждому номеру
     */
    public function getStatsByDst($call = null) {

        // Получаем условия выборки исходя из запроса
        $where = $this->buildQuery($call);

        // Собираем SQL запрос с учетом критериев выборки данных из таблицы
        $query = 'SELECT `dst`, count(*) as `amount` FROM `cdr` ' . $where['clause'] . ' GROUP BY `dst` ORDER BY `amount` DESC LIMIT 6';

        // Делаем запрос и возвращаем данные
        return DB::select($query, $where['bindings']);
    }

    /** Количество успешных и не успешных вызовов по номеру
     * @param array $call Массив с параметрами звонка запроса
     * @return array Количество вызовов в каждом статусе
     */
    public function getStatsByDisposition($call = null) {

        $where = $this->buildQuery($call);

        $query = 'SELECT `disposition`, count(*) as amount FROM `cdr` ' . $where['clause'] . ' GROUP BY `disposition`';

        return DB::select($query, $where['bindings']);
    }

    /** Количество поступивших и отвеченных звонков по дням
     * @param array $call Массив с параметрами звонка запроса
     * @return array Массив со статистикой по дням и массив с данными из БД
     * */
    public function getCallsByDate($call = null) {

        // Получаем условия выборки исходя из запроса
        $where = $this->buildQuery($call);

        // Получаем данные из БД
        $query = 'SELECT DATE(`calldate`) as callday, `disposition`, count(*) as amount FROM `cdr` ' . $where['clause'] . ' GROUP BY `callday`, `disposition`';
        $callsByDate = DB::select($query, $where['bindings']);

        // Инициализируем возвращаемый массив
        $statsByDate = [];

        // Разбираем статусы из БД по успешным и не успешным звонкам и сохраняем разбивку по дням
        foreach ($callsByDate as $value) {
            $day = $value->callday;
            if ( !array_key_exists($day, $statsByDate) ) {
                $statsByDate[ $day ] = ['answered' => 0, 'other' => 0];
            }
            if ($value->disposition == 'ANSWERED') {
                $statsByDate[ $day ]['answered'] += $value->amount;
            } else {
                $statsByDate[ $day ]['other'] += $value->amount;
            }
        }

        if ( count($statsByDate)>1 ) {
            // Перебираем дни и формируем окончательный массив в порядке добавления дня
            $currentDate = new \DateTime('NOW', new \DateTimeZone(ini_get('date.timezone')));
            $currentDate->modify('-31 day');
            $arrayCalls=[];
            for( $i=0; $i<=31; $i++ ) {
                $currentDay = $currentDate->format('Y-m-d');
                if (array_key_exists($currentDay, $statsByDate) ) {
                    $arrayCalls[$i] = [
                        'day' => $currentDay,
                        'answered' => $statsByDate[ $currentDay ]['answered'],
                        'other' => $statsByDate[ $currentDay ]['other'],
                    ];
                } else {
                    $arrayCalls[$i] = [
                        'day' => $currentDay,
                        'answered' => 0,
                        'other' => 0,
                    ];
                }
                $currentDate->modify('+1 day');
            }
        } else {
            $arrayCalls = $statsByDate;
        }

        return $arrayCalls;
    }

    /** Количество поступивших и отвеченных звонков по часам
     * @param array $call Массив с параметрами звонка запроса
     * @return array $statsByDate Массив со статистикой по часам
     * */
    public function getCallsByHour($call = null) {

        // Получаем условия выборки исходя из запроса
        $where = $this->buildQuery($call);

        // Получаем данные из БД
        $query = 'SELECT HOUR(`calldate`) as callhour, `disposition`, count(*) as amount FROM `cdr` ' . $where['clause'] . ' GROUP BY `callhour`, `disposition`';
        $callsByHour = DB::select($query, $where['bindings']);

        // Инициализируем возвращаемый массив
        $statsByHour = [];

        // Разбираем статусы из БД по успешным и не успешным звонкам и сохраняем разбивку по часам
        foreach ($callsByHour as $value) {
            $hour = $value->callhour;
            if ( !array_key_exists($hour, $statsByHour) ) {
                $statsByHour[ $hour ] = ['answered' => 0, 'other' => 0];
            }
            if ($value->disposition == 'ANSWERED') {
                $statsByHour[ $hour ]['answered'] += $value->amount;
            } else {
                $statsByHour[ $hour ]['other'] += $value->amount;
            }
        }

        // Перебираем часы, формируя окончательный массив в порядке возрастания часа
        for ($i=0; $i<24; $i++) {
            if (!array_key_exists($i, $statsByHour) ) {
                $statsByHour[ $i ] = ['answered' => 0, 'other' => 0];
            }
        }

        return $statsByHour;
    }

}
