@extends('layouts.main')

@section('title')
    Главная страница
@endsection

@section('content')
<main role="main" class="container">
    <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
            <h1 class="display-12 font-italic">Лучшие статьи в городе</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 blog-main">

            @include('layouts.flash_message')

            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Самые новые публикации
            </h3>

            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-lg btn-block mb-3">Добавить статью</a>

            @if (count($articles) > 0)
                @foreach($articles as $article)
                    @include('posts.post')
                @endforeach
            @else
                <p>Нет активных статей</p>
            @endif

        </div>

        @include('layouts.right_menu')

    </div>

</main>
@endsection