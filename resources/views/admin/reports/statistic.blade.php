@extends('layouts.main')

@section('title')
    Админка. Статистика
@endsection

@section('admin')
    <p>Кол-во статей: {{ $stat['articlesCount'] }}</p>
    <p>Кол-во новостей: {{ $stat['newsCount'] }}</p>
    <p>Пользователь с макс. кол-вом статей: {{ $stat['userNameWithMaxArticlesCount'] }}</p>
    <p>Самая длинная статья ({{ $stat['articleWithMaxDescriptionLength']->length }} символов):
        <a href="{{ route('posts.show', ['article' => $stat['articleWithMaxDescriptionLength']->slug]) }}">
            {{ $stat['articleWithMaxDescriptionLength']->name }}
        </a>
    </p>
    <p>Самая короткая статья ({{ $stat['articleWithMinDescriptionLength']->length }} символов):
        <a href="{{ route('posts.show', ['article' => $stat['articleWithMaxDescriptionLength']->slug]) }}">
            {{ $stat['articleWithMinDescriptionLength']->name }}
        </a>
    </p>
    <p>Среднее кол-во статей у пользователей: {{ $stat['avgUsersArticles'] }}</p>
    <p>Статья с большим кол-вом изменений ({{ $stat['articleWithMaxChanges']->history_count }} изменений):
        <a href="{{ route('posts.show', ['article' => $stat['articleWithMaxChanges']->slug]) }}">
            {{ $stat['articleWithMaxChanges']->name }}
        </a>
    </p>
    <p>Статья с большим кол-вом комментариев ({{ $stat['articleWithMaxComments']->comments_count }} комментариев):
        <a href="{{ route('posts.show', ['article' => $stat['articleWithMaxComments']->slug]) }}">
            {{ $stat['articleWithMaxComments']->name }}
        </a>
    </p>
@endsection
