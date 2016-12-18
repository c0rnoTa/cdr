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

    @if( count($callsByDst)>0 )
    <div class="row">
        <!-- Количество звонков по номерам -->
        @includeIf('cdr.piegraph')
        <!-- Количество звонков по дням -->
        @includeIf('cdr.bargraph')
    </div>
    @endif

@endsection

