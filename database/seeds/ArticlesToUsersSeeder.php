<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ArticlesToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCollection = factory(\App\User::class, 4)->create([
            'password' => Hash::make('123456')
        ]);

        $tagsCollection = factory(\App\Tag::class, 5)->create();

        factory(\App\Article::class, 20)
            ->create(['owner_id' => 1])
            ->each(function (\App\Article $article) use ($tagsCollection, $usersCollection) {
                $article->update(['owner_id' => $usersCollection->random()->id]);
                $article->tags()->sync($tagsCollection->random(rand(1, 5)));
            });
    }
}
