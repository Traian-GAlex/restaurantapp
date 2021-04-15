<?php

use Illuminate\Database\Seeder;
use App\Data\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('it');
        $rolesArray = ['Admin', 'Cashier', 'Customer', 'Guest', 'Owner'];
        foreach ($rolesArray as $rae){
            $role = Role::find($rae);
            if (null == $role){
                $role = new Role();
                $role->name = $rae;
                $role->description = $faker->paragraph(mt_rand(3, 10));
                $role->save();
            }
        }
    }
}
