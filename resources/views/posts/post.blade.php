<div class="blog-post">
    <h2 class="blog-post-title"><a href="/posts/{{ $article->slug }}">{{ $article->name }}</a></h2>
    <p class="blog-post-meta">{{ date("d.m.Y H:i:s", strtotime($article->updated_at)) }}</p>

    <p>{{ $article->annotation }}</p>
    <hr>
    <div>
        {{ $article->description }}
    </div>
</div>