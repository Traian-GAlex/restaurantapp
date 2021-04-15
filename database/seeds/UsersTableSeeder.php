<?php

use Illuminate\Database\Seeder;
use App\Data\Models\User;
use App\Data\Models\Role;
use App\Data\Models\Peron as Prs;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 10000)->create()->each(function($user){
            $role = Role::where('name', 'Guest')->first();
            $user->roles()->attach($role->id);
        });
    }
}
