<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(100)->create();
    }
}
