<?php

use App\Models\Novel;
use Illuminate\Database\Seeder;

class NovelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $novels = factory(Novel::class, 20)->create();
        $users  = App\Models\User::all();

        $users->each(function ($user) use ($novels) {
            $user->novels()->attach(
                $novels->random(rand(3, 5))->pluck('id')->toArray()
            );
        });
    }
}
