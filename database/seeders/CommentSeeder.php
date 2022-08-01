<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory(2000)->create();
    }
}
