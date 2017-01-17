@extends('generic.layout')

@section('title','Список звонков')

@section('page_title','Список звонков')

@section('page_description','История вызовов по телефонным номерам')

@section('content')

    <div class="row">
        <!-- Фильтр -->
        @include('cdr.filter')
        <!-- Детальный список звонков -->
        @includeIf('cdr.resultstable')
    </div>

    @if( count($calls)>0 )
    <div class="row">
        <!-- Выбираем круговой график в зависимости от данных -->
        @if( count($statsByDst)>1 )
            <!-- Количество звонков по номерам -->
            @includeIf('cdr.piegraph')
        @else
            <!-- Успешность дозвона по номеру -->
            @includeIf('cdr.piegraph2')
        @endif
        <!-- Выбираем столбчатую диаграмму в зависимости от данных -->
        @if( count($callsByDate)>1 )
            <!-- Количество звонков по дням -->
            @includeIf('cdr.bargraph')
        @else
            <!-- Количество звонков по часам -->
            @includeIf('cdr.bargraph2')
        @endif
    </div>
    @endif

@endsection

