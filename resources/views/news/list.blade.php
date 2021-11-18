@extends('layouts.main')

@section('title')
    Новости
@endsection

@section('content')
    <main role="main" class="container">
        <div class="row">
            <div class="blog-main">

                @include('layouts.flash_message')

                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Новости сайта
                </h3>

                @admin
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-lg btn-block mb-3">Добавить новость</a>
                @endadmin

                @forelse($allNews as $news)
                    @include('news.news', ['short' => true, 'withoutComments' => true])
                @empty
                    <p>На сайте нет новостей</p>
                @endforelse

                {{ $allNews->links() }}

            </div>

        </div>

    </main>
@endsection
