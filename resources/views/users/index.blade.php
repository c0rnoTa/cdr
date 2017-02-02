@extends('layouts.app')

@section('title','Пользователи')

@section('page_title','Пользователи')

@section('page_description','Административного интерфейса')

@push('select_menu')
$('#li_users').addClass('current-page');
@endpush

@section('content')

    <div class="row">
        <!-- Список пользователей -->
        @include('users.list')
        <!-- Информация о пользователе -->
        @includeif('users.settings')
    </div>

@endsection

