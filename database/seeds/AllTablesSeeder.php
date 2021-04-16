<?php

use Illuminate\Database\Seeder;

class AllTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            AdminSeeder::class,
            UsersTableSeeder::class,
            TablesTableSeeder::class,
            MenuTableSeeder::class,
            CategoriesTableSeeder::class,
            OrdersTableSeeder::class,
        ]);
    }
}
