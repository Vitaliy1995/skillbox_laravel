@extends('layouts.main')

@section('title')
    Изменение новости
@endsection

@section('content')
    <div class="container">

        @include('layouts.errors')

        <div class="row">
            <div class="col-md-8 blog-main">
                <form method="post" action="{{ route('admin.news.update', $news) }}">

                    @csrf
                    @method('PATCH')

                    @include('admin.news.layouts.form-inputs', ['news' => $news])
                </form>

                <form method="post" action="{{ route('admin.news.destroy', $news) }}">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>

    </div>
@endsection
