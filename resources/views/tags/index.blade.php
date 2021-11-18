@extends('layouts.main')

@section('title')
    Теги
@endsection

@section('content')
    <main role="main" class="container">
        <div class="row">
            <div class="blog-main col-md-6">

                @include('layouts.flash_message')

                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Статьи сайта
                </h3>

                @forelse($articles as $article)
                    @include('posts.post')
                @empty
                    <p>На сайте нет статей по тегуf</p>
                @endforelse

            </div>

            <div class="blog-main col-md-6">

                @include('layouts.flash_message')

                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Новости сайта
                </h3>

                @forelse($allNews as $news)
                    @include('news.news', ['short' => true])
                @empty
                    <p>На сайте нет новостей по тегу</p>
                @endforelse

            </div>
        </div>

    </main>
@endsection
