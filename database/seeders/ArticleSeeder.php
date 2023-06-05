<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i=0; $i<4; $i++){
            $title = $faker->sentence(7);

            DB::table('articles')->insert([
                'category_id'=>rand(1,7),
                'title'=>$title,
                'image' => sprintf('https://loremflickr.com/600/300/%s',$faker->word),
                'content'=>$faker->paragraph(6),
                'slug'=> Str::slug($title),
                'created_at'=> $faker->dateTime($max = 'now'),
                'updated_at'=>now()
            ]);
        }
    }
}
