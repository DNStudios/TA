<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1,30) as $index) {
        	Post::create([
        		'title'		=>  $faker->word,
        		'body'		=>	$faker->paragraph($nbSetences = 3),
        		'user_id'	=>	$faker->numberBetween($min = 1, $max = 5)
        		]);
        }
    }
}
