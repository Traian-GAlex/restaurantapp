<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Data\Models\Menu;
use Faker\Generator as Faker;

function getFoodName(Faker $faker){
    $providers = [
//        'ar_SA' => new \FakerRestaurant\Provider\ar_SA\Restaurant($faker),
//        'de_AT' => new \FakerRestaurant\Provider\de_AT\Restaurant($faker),
//        'de_DE' => new \FakerRestaurant\Provider\de_DE\Restaurant($faker),
        'en_US' => new \FakerRestaurant\Provider\en_US\Restaurant($faker),
        'es_PE' => new \FakerRestaurant\Provider\es_PE\Restaurant($faker),
//        'fa_IR' => new \FakerRestaurant\Provider\fa_IR\Restaurant($faker),
        'fr_FR' => new \FakerRestaurant\Provider\fr_FR\Restaurant($faker),
//        'id_ID' => new \FakerRestaurant\Provider\id_ID\Restaurant($faker),
        'it_IT' => new \FakerRestaurant\Provider\it_IT\Restaurant($faker),
//        'ja_JP' => new \FakerRestaurant\Provider\ja_JP\Restaurant($faker),
//        'lt_LT' => new \FakerRestaurant\Provider\lt_LT\Restaurant($faker),
//        'pt_BR' => new \FakerRestaurant\Provider\pt_BR\Restaurant($faker),
        'sv_SE' => new \FakerRestaurant\Provider\sv_SE\Restaurant($faker),
        'tr_TR' => new \FakerRestaurant\Provider\tr_TR\Restaurant($faker),
//        'vi_VN' => new \FakerRestaurant\Provider\vi_VN\Restaurant($faker),
    ];
    $locale = (array_keys($providers))[mt_rand(0, count($providers) - 1)];
//    echo $locale . "\n";
    $provider = $providers[$locale];
    $faker->addProvider($provider);
    return $faker->foodName();
};

$factory->define(Menu::class, function (Faker $faker) {
    $prices = [1.50, 2.50 . 3, 4.5, 2.20, 5.99];
    return [
        'name' => getFoodName($faker),
        'price' => $prices[mt_rand(0, count($prices) - 1)],
        'description' => $faker->paragraph(mt_rand(3, 30)),
    ];
});
