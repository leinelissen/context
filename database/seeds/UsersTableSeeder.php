<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 30)->create()->each(function ($user) {
            $user->channels()->attach(App\Channel::all()->pluck('id'));
        });
    }
}
