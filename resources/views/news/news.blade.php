<div class="blog-post card mb-3">
    <div class="card-header clearfix">
        <a href="{{ route('news.show', $news) }}">{{ $news->title }}</a>
        <span class="blog-post-meta float-right">{{ $news->created_at->format('d.m.Y H:i:s') }}</span>
    </div>
    <div class="card-body position-relative p-3">
        @if ($news->tags->isNotEmpty())
            <div>
                @foreach($news->tags as $tag)
                    <a href="{{ route('tags', ['tag' => $tag->getRouteKey()]) }}" class="btn btn-{{ \App\Bootstrap::getBootstrapClassByColor($tag->color) }} btn-sm">{{ $tag->name }}</a>
                @endforeach
            </div>
        @endif

        @admin
            <div class="" style="top: 0;right: 0;">
                <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-primary float-right m-2">Изменить</a>
            </div>
        @endadmin

        {{ isset($short) ? mb_strimwidth($news->description, 0, 127, '...') : $news->description }}
    </div>
</div>

@empty($withoutComments)
    @include('news.comments')
@endisset
