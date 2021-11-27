@extends('layouts.main')

@section('title')
    Админка. Отчёты
@endsection

@section('admin')
    <div class="container">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ route('admin.total') }}">Итого</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('admin.statistic') }}">Статистика</a>
            </li>
        </ul>
    </div>
@endsection
