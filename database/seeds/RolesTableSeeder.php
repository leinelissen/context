<?php

use Illuminate\Database\Seeder;

use App\Role;

class RolesTableSeeder extends Seeder
{
    public $roles;

    public function __construct()
    {
        $this->roles = collect([
            'Teacher',
            'Student'
        ]);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
