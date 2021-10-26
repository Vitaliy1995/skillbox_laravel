@extends('layouts.main')

@section('title')
    Изменение статьи
@endsection

@section('content')
    <div class="container">

        @include('layouts.errors')

        <div class="row">
            <div class="col-md-8 blog-main">
                <form method="post" action="{{ route('posts.update', $article) }}">

                    @csrf
                    @method('PATCH')

                    @include('posts.layouts.form-inputs', ['article' => $article])
                </form>

                <form method="post" action="{{ route('posts.destroy', $article) }}" class>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>

            @include('layouts.right_menu')
        </div>

    </div>
@endsection
