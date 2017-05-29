<?php

use Illuminate\Database\Seeder;
use App\Channel;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    public $chanceOfTeacher;

    public function __construct()
    {
        $this->chanceOfTeacher = 15;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 30)->create()->each(function ($user) {
            $user->channels()->attach(Channel::all());

            if (rand(0, 100) < $this->chanceOfTeacher) {
                $user->roles()->attach(Role::where('name', 'Teacher')->get());
            } else {
                $user->roles()->attach(Role::where('name', 'Student')->get());
            }
        });
    }
}
