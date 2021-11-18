@include('layouts.errors')
@include('layouts.flash_message')

@auth()
    <form class="mt-5" method="post" action="{{ route('news.comment.store', ['news' => $news]) }}">

        @csrf

        <div class="mb-3">
            <label for="comment" class="form-label">Оставьте свой комментарий ниже:</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@else
    <p>Чтобы оставить комментарий - нужно авторизоваться!</p>
@endauth

<h2>Комментарии к новости :</h2>
@forelse($news->comments as $comment)
    <div class="card">
        <div class="card-header @if ($comment->owner->isAdmin()) bg-info @endif">
            {{ $comment->owner->name }}
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p>{{ $comment->comment }}</p>
            </blockquote>
        </div>
        <div class="card-footer">
            {{ $comment->created_at->format('H:i:s d.m.Y') }}
        </div>
    </div>
@empty
    <p>Еще никто не оставлял комментариев, будьте первым!</p>
@endforelse
