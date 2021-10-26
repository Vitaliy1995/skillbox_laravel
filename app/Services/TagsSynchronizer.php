<?php


namespace App\Services;


use App\Article;
use App\Tag;
use Illuminate\Support\Collection;

class TagsSynchronizer
{
    public function sync(Article $article, $tags)
    {
        /** @var Collection $articleTags */
        $articleTags = $article->tags->keyBy('name');
        $formTags = collect(explode(",", $tags))->keyBy(function ($item) {return $item;});

        $syncIds = $articleTags->intersectByKeys($formTags)->pluck('id')->toArray();

        $tagsToAttach = $formTags->diffKeys($articleTags);
        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $article->tags()->sync($syncIds);
    }
}
