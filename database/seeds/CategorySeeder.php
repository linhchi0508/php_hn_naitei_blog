<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Business', 'parent' => null],
            ['id' => 2, 'name' => 'Travel', 'parent' => null],
            ['id' => 3, 'name' => 'Life', 'parent' => null],
            ['id' => 4, 'name' => 'Sport', 'parent' => null],
            ['id' => 5, 'name' => 'Medical', 'parent' => null],
        ]);
    }
}
