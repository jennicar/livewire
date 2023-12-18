<?php

namespace Database\Seeders\Mock;

use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // lets create a bunch of random blogs with random tags, and authors.
        // you probably dont want to run this in production :)

        $categories = [];
        $authors = [];
        $faker = Factory::create();

        for ($i = 1; $i <= 6; $i++) {
            $name = implode(' ', $faker->words(rand(1, 2)));
            $categories[$i] = Category::create([
                'name' => Str::title($name),
                'slug' => Str::slug($name),
                'photo' => null,
                'description' => $faker->paragraph()
            ]);
        }

        for ($i = 1; $i <= 6; $i++) {
            $filename = uniqid();
            $file = Http::get('https://picsum.photos/128')->body();
            Storage::disk(config('filesystems.cloud'))->put($filename, $file);
            $authors[$i] = Author::create([
                'name' => Str::title($faker->name()),
                'photo' => $filename,
            ]);
        }

        // create some random photos
        $blogPhotos = [];
        for ($i = 1; $i <= 40; $i++) {
            $filename = uniqid();
            $file = Http::get('https://source.unsplash.com/random/?camping&w=1600&h=1200')->body();
            Storage::disk(config('filesystems.cloud'))->put($filename, $file);
            $blogPhotos[$i] = $filename;
        }

        // get some random html
        $blogContent = [];
        for ($i = 1; $i <= 40; $i++) {
            $blogContent[$i]  = Http::get('https://loripsum.net/api/long/decorate/link/ul')->body();
        }

        for ($i = 1; $i <= 120; $i++) {
            $published = rand(1, 10) === 1 ? false : true;
            $date = $faker->dateTimeBetween('-2 years', 'now');
            $title = $faker->sentence();

            Post::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => $faker->paragraph(),
                'content' => $blogContent[rand(1, 40)],
                'category_id' => rand(1, 6),
                'author_id' => rand(1, 6),
                'published_at' => $published ? $date : null,
                'created_at' => $date,
                'updated_at' => $date,
                'photo' => $blogPhotos[rand(1, 40)]
            ]);
        }
    }
}
