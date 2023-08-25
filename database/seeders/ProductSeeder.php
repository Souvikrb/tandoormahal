<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\product;
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
        for($i = 0;$i<5;$i++){
            product::create([
                'product' => 'Product '.rand(1,10),
                'rgPrice' => 100,
                'slPrice' => 60,
                'halfPrice' => 30,
                'prodImg' => 'defaulticon.png',
                'type' => 'Non-Veg',
                'tags' => ''
            ]);
        }
        
    }
}
