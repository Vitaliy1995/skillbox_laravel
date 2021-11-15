<h2>Изменения:</h2>
@forelse($article->history as $item)
    <p>{{ $item->pivot->created_at->diffForHumans() }} - {{ $item->email }} - {{ $item->pivot->changes['before'] }} - {{ $item->pivot->changes['after'] }}</p>
@empty
    <p>Нет истории изменений</p>
@endforelse
