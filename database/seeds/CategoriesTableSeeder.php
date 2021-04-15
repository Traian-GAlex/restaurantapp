<?php

use Illuminate\Database\Seeder;
use App\Data\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "Appetizers/Starters",
            "Breakfast",
            "Lunch",
            "Dinner",
            "Dessert",
            "Salads",
            "Side Items",
            "Pizza",
            "Beverages (Sodas, Milk, Coffee)",
            "Beverages (Beer List)",
            "Beverages (Wine List)",
            "Beverages (Liquors)",
            "Beverages (Non Alcoholic)",
            "Beverages",
        ];

        foreach ($categories as $category) {
            $item = Category::firstOrNew(['name' => $category]);
            $item->name = $category;
            $item->save();
        }

    }
}
