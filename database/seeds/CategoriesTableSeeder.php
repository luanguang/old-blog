<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::insert([
            ['name' => '欢乐'],
            ['name' => '搞笑'],
            ['name' => '日常'],
        ]);
    }
}
