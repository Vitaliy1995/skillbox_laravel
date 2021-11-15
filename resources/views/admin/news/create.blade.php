@extends('layouts.main')

@section('title')
    Добавление новости
@endsection

@section('content')
    <div class="container">

        @include('layouts.errors')

        <div class="row">
            <form method="post" action="{{ route('admin.news.store') }}" class="col-md-8 blog-main">

                @csrf

                @include('admin.news.layouts.form-inputs', ['news' => new \App\News()])
            </form>
        </div>

    </div>
@endsection
