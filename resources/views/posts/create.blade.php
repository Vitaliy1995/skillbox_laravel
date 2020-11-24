@extends('layouts.main')

@section('title')
    Добавление статьи
@endsection

@section('content')
    <div class="container">

        @include('layouts.errors')

        <div class="row">
            <form method="post" action="{{ route('posts.store') }}" class="col-md-8 blog-main">

                @csrf

                <div class="form-group">
                    <label for="slug">Символьный код</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" required>
                </div>

                @include('posts.layouts.form-inputs', ['article' => new \App\Article()])
            </form>

            @include('layouts.right_menu')
        </div>

    </div>
@endsection
