<aside class="col-md-4 blog-sidebar">
    @if ($tagsCloud->isNotEmpty())
        <div class="p-3">
            <h4 class="font-italic">Облако тегов</h4>
            @foreach($tagsCloud as $tag)
                <a href="{{ route('tags', ['tag' => $tag->getRouteKey()]) }}" class="btn btn-link btn-sm">{{ $tag->name }}</a>
            @endforeach
        </div>
    @endif
</aside>
