@extends('layouts.main')

@section('title')
    Админка
@endsection

@section('admin')
    <div class="container">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ route('admin.reports') }}">Отчёты</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('admin.feedback') }}">Обращения</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('admin.posts.index') }}">Админка статей</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('admin.news.index') }}">Админка новостей</a>
            </li>
        </ul>
    </div>
@endsection
