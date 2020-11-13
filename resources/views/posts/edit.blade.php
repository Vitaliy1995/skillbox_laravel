@extends('layouts.main')

@section('title')
    Изменение статьи
@endsection

@section('content')
    <div class="container">

        @include('layouts.errors')

        <div class="row">
            <div class="col-md-8 blog-main">
                <form method="post" action="/posts/{{ $article->slug }}">

                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name">Название статьи</label>
                        <input type="text"
                               class="form-control"
                               id="name"
                               name="name"
                               minlength="5"
                               maxlength="100"
                               value="{{ old('name', $article->name) }}"
                               required
                        >
                    </div>
                    <div class="form-group">
                        <label for="annotation">Краткое описание статьи</label>
                        <input type="text"
                               class="form-control"
                               id="annotation"
                               name="annotation"
                               maxlength="255"
                               value="{{ old('annotation', $article->annotation) }}"
                               required
                        >
                    </div>
                    <div class="form-group">
                        <label for="description">Текст статьи</label>
                        <textarea name="description" id="description" class="col-md-12" rows="10" required>{{ $article->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="tags">Теги статьи</label>
                        <input type="text"
                               name="tags"
                               id="tags"
                               class="form-control"
                               value="{{ old('tags', $article->tags->pluck('name')->implode(',')) }}"
                        />
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox"
                               class="form-check-input"
                               id="published"
                               name="published"
                               @if (old('published', $article->published ? 'on' : '') === 'on')
                               checked
                               @endif
                        >
                        <label class="form-check-label" for="published">Опубликовано</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>

                <form method="post" action="/posts/{{ $article->slug }}" class>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>

            @include('layouts.right_menu')
        </div>

    </div>
@endsection
