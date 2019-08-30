<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,20) as $index) {
	        DB::table('news')->insert([
	            'title' => $faker->sentence,
	            'description' => $faker->sentence(4),
	            'body' => $faker->paragraph(20),
	            'featured_image' => 'seed.jpg',
	            'user_id' => 1
	        ]);
		}
    }
}
