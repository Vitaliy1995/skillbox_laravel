@component('mail::message')
    # Удалена статья
    Код: {{ $article->slug }}<br>
    Название: {{ $article->name }}
@endcomponent
