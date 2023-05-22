<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $products = [
            'Hp laptop EliteBook',
            'Hp laptop ProBook',
            'Dell laptop Latitude',
            'Dell PC GamingPC',
            'Dell PC PersonalPC',
            'Mac MacBook Air',
            'MacBook Pro',
            'iMac'
        ];
        $brands = [
            'Hp',
            'Dell',
            'Samsung',
            'Lenovo',
            'Apple'
        ];
        $categories = [
            'Macbook Pro',
            'others'
        ];
        foreach (range(0, 120) as $i) {
            $price_sale = $faker->numberBetween($min=10, $max=1200);
            DB::table('products')->insert([
                'name'=> $products[rand(0, count($products) - 1)],
                'description' => $faker->text(200),
                'brand'=> $brands[rand(0, count($brands) - 1)],
                'price'=>$price_sale * 1.23,
                'price_sale' => $price_sale,
                'category'=>$categories[rand(0, count($categories) - 1)],
                'stock'=>$faker->numberBetween($min=0, $max=100)
            ]);
        }
   
    }
}
