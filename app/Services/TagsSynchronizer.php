<?php


namespace App\Services;

use App\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TagsSynchronizer
{
    public function sync(Model $model, $tags)
    {
        /** @var Collection $modelTags */
        $modelTags = $model->tags->keyBy('name');
        $formTags = collect(explode(",", $tags))->keyBy(function ($item) {return $item;});

        $syncIds = $modelTags->intersectByKeys($formTags)->pluck('id')->toArray();

        $tagsToAttach = $formTags->diffKeys($modelTags);
        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $model->tags()->sync($syncIds);
    }
}
