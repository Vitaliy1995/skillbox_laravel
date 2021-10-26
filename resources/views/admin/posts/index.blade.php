@extends('layouts.main')

@section('title')
    Админка. Редактирование статей
@endsection

@section('admin')
<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">

            @include('layouts.flash_message')

            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-lg btn-block mb-3">Добавить статью</a>

            @if (count($articles) > 0)
                @foreach($articles as $article)
                    @include('posts.post')
                @endforeach
            @else
                <p>Нет статей</p>
            @endif

        </div>

    </div>

</main>
@endsection
