@component('mail::message')
    @foreach($articles as $article)
        # Новая статья
        Код: {{ $article->slug }}<br>
        Название: {{ $article->name }}

        @component('mail::button', ['url' => route('posts.show', $article)])
            Посмотреть статью
        @endcomponent
    @endforeach
@endcomponent
