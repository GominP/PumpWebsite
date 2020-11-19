<?php

use Illuminate\Database\Seeder;
use \App\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0 ; $i <= 5 ; $i++){
            DB::table('products')->insert([
                    'name' => Str::random(10),
                    'detail' => Str::random(10).'@gmail.com',
                    'type' => 'VARVEL',
                    'price' => 4000,
                    'img' => '/img/products/v1.jpg'
            ]);
        }

        for($i = 0 ; $i <= 5 ; $i++){
            DB::table('products')->insert([
                'name' => Str::random(10),
                'detail' => Str::random(10).'@gmail.com',
                'type' => 'AC INDUCTION MOTORS',
                'price' => 4000,
                'img' => '/img/products/v1.jpg'

            ]);
        }

        for($i = 0 ; $i <= 5 ; $i++){
            DB::table('products')->insert([
                'name' => Str::random(10),
                'detail' => Str::random(10).'@gmail.com',
                'type' => 'EXPLOSION PROOF MOTORS',
                'price' => 5000,
                'img' => '/img/products/v1.jpg'

            ]);
        }
        for($i = 0 ; $i <= 5 ; $i++){
            DB::table('products')->insert([
                'name' => Str::random(10),
                'detail' => Str::random(10).'@gmail.com',
                'type' => 'BLOWER AND TURBO BLOWER',
                'price' => 5000,
                'img' => '/img/products/v1.jpg'


            ]);
        }

    }
}
