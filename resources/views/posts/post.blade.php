<div class="blog-post card mb-3">
    <div class="card-header clearfix">
        <a href="{{ route('posts.show', ['article' => $article->slug]) }}">{{ $article->name }}</a>
        <span class="blog-post-meta float-right">{{ date("d.m.Y H:i:s", strtotime($article->updated_at)) }}</span>
    </div>
    <div class="card-body position-relative p-3">
        @if ($article->tags->isNotEmpty())
            <div>
                @foreach($article->tags as $tag)
                    <a href="{{ route('posts.tags', ['tag' => $tag->getRouteKey()]) }}" class="btn btn-{{ \App\Bootstrap::getBootstrapClassByColor($tag->color) }} btn-sm">{{ $tag->name }}</a>
                @endforeach
            </div>
        @endif

        @can('update', $article)
            <div class="position-absolute clearfix" style="top: 0;right: 0;">
                <a href="{{ route('posts.edit', ['article' => $article->slug]) }}" class="btn btn-primary float-right m-2">Изменить</a>
            </div>
        @endcan

        <div class="my-3">
            <p>{{ $article->annotation }}</p>
        </div>
        <hr>
        <div>
            {{ $article->description }}
        </div>
    </div>
</div>