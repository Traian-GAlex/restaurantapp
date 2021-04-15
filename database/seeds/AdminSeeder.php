<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Data\Models\User;
use App\Data\Models\Role;
use Illuminate\Support\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->insert([
//            'name' => 'admin',
//            'email' => 'admin@example.com',
//            'password' => '12345678',
//        ]);
        $admin = Role::where('name', 'Admin')->first();
        if (null == $admin){
            $admin = new Role();
            $admin->name = 'Admin';
            $admin->save();
        }

        $user = User::where('name', 'Admin')->first();
        if (null == $user){
            $user = new User();

            $user->uuid = \Illuminate\Support\Str::uuid();
            $user->name = 'Admin';
            $user->email_verified_at = Carbon::now();
            $user->email = 'admin@example.com';
            $user->password = 'secret';
            $user->save();
        }

        if (!$user->isInRole('Admin')){
            $user->roles()->attach($admin->id);
        }

    }
}
