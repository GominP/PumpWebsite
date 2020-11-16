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
            for($j = 0 ; $j <= 5 ; $j++) {
                DB::table('products')->insert([
                    'name' => Str::random(10),
                    'detail' => Str::random(10).'@gmail.com',
                    'type' => Str::random(5),
                    'price' => 4000
                ]);

//                $p1 = new Product();
//                $p1->name = 'name';
//                $p1->detail = Str::random(10).'test';
//                $p1->type = 'type';
//                $p1->price = 4000;
                }
        }

    }
}
