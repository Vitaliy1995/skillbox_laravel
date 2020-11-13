@component('mail::message')
    # Добавлена статья
    Код: {{ $article->slug }}<br>
    Название: {{ $article->name }}

    @component('mail::button', ['url' => "/posts/{$article->slug}"])
    Посмотреть статью
    @endcomponent

@endcomponent
