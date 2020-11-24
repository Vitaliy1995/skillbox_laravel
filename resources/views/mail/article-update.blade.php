@component('mail::message')
    # {{ $event }} статья
    Код: {{ $article->slug }}<br>
    Название: {{ $article->name }}

    @component('mail::button', ['url' => route('posts.show', ['article' => $article->slug])])
    Посмотреть статью
    @endcomponent

@endcomponent
