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
                <div class="form-group">
                    <label for="name">Название статьи</label>
                    <input type="text" class="form-control" id="name" name="name" minlength="5" maxlength="100" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="annotation">Краткое описание статьи</label>
                    <input type="text" class="form-control" id="annotation" name="annotation" maxlength="255" value="{{ old('annotation') }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Текст статьи</label>
                    <textarea name="description" id="description" class="col-md-12" rows="10" required>{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="tags">Теги статьи</label>
                    <input type="text"
                           name="tags"
                           id="tags"
                           class="form-control"
                           value="{{ old('tags') }}"
                    />
                </div>
                <div class="form-group form-check">
                    <input type="checkbox"
                           class="form-check-input"
                           id="published"
                           name="published"
                           @if (old('published') === 'on')
                           checked
                           @endif
                    >
                    <label class="form-check-label" for="published">Опубликовать</label>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>

            @include('layouts.right_menu')
        </div>

    </div>
@endsection
