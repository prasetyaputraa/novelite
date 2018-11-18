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
        $novels  = factory(Novel::class, 20)->create();
        $users   = App\Models\User::all();
        $admins  = App\Models\Admin::all();

        $users->each(function ($user) use ($novels) {
            $user->favoriteNovels()->attach(
                $novels->random(rand(3, 5))->pluck('id')->toArray()
            );
        });

        $admins->each(function ($admin) use ($novels) {
            $admin->favoriteNovels()->attach(
                $novels->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
