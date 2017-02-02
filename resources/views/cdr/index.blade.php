@extends('layouts.app')

@section('title','История звонков')

@section('page_title','История звонков')

@section('page_description','История выходящих вызовов')

@push('select_menu')
    $('#li_cdr').addClass('current-page');
@endpush

@section('content')

    <div class="row">
        <!-- Фильтр -->
        @include('cdr.filter')
        <!-- Детальный список звонков -->
        @includeIf('cdr.resultsTable')
    </div>

    @if( count($calls)>0 )
    <div class="row">
        <!-- Выбираем круговой график в зависимости от данных -->
        @if( count($statsByDst)>1 )
            <!-- Количество звонков по номерам -->
            @includeIf('cdr.pieCallsPerNumber')
        @else
            <!-- Успешность дозвона по номеру -->
            @includeIf('cdr.pieSuccessForNumber')
        @endif
        <!-- Выбираем столбчатую диаграмму в зависимости от данных -->
        @if( count($callsByDate)>1 )
            <!-- Количество звонков по дням -->
            @includeIf('cdr.barCallsPerDay')
        @else
            <!-- Количество звонков по часам -->
            @includeIf('cdr.barCallsPerHour')
        @endif
    </div>
    @endif

@endsection

