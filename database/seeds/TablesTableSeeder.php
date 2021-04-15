<?php

use Illuminate\Database\Seeder;
use App\Data\Models\Table;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();;
        $tableCount = 15;
        $chairType = [2, 4, 6];
        for ($i = 1; $i <= $tableCount; $i++) {
            (new Table([
                'name' => 'Table ' . $i,
                'chairs' => $chairType[mt_rand(0, count($chairType)-1)],
                'available' => true,
                'description' => $faker->paragraph(mt_rand(3, 10)),
            ]))->save();
        }
//        name
//        chairs
//        available
//        description
    }
}
