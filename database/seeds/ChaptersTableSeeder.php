<?php

use App\Models\Chapter;
use Illuminate\Database\Seeder;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chapters = factory(Chapter::class, 100)->create();
    }
}
