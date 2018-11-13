<?php

use App\Models\Favorite;
use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $favorites = factory(Favorite::class, 100)->create();
    }
}
