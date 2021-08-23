<?php

use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $limit = 10;
        for ($i = 0; $i < $limit; $i++) 
        {
            DB::table('stories')->insert([
            	'title' => $faker->text($maxNbChars = 50),
            	'status' => $faker->randomElement(['public', 'unlisted', 'draft']),
            	'content' => $faker->text,
            	'categories_id' => $faker->numberBetween(1,5),
            	'users_id' => $faker->numberBetween(2,5),
            ]);
        }
    }
}
