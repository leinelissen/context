<?php

use App\Channel;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

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
        // Create parents
        $parents = factory(User::class, 10)->create()->each(function ($user) {
            $user->roles()->attach(Role::where('name', 'Parent')->get());
        });

        // $parents = User::all();

        // Create students & teachers
        factory(User::class, 30)->create()->each(function ($user) use($parents) {
            $user->channels()->attach(Channel::all());

            if (rand(0, 100) < $this->chanceOfTeacher) {
                $user->roles()->attach(Role::where('name', 'Teacher')->get());
            } else {
                $user->roles()->attach(Role::where('name', 'Student')->get());
                $user->parent()->associate($parents->random());
                $user->save();
            }
        });
    }
}
