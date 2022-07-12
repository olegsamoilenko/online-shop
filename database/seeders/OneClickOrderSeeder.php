<?php

namespace Database\Seeders;

use App\Models\OneClickOrder;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OneClickOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OneClickOrder::factory()
          ->count(25)
          ->hasAttached(Product::all()->random())
          ->create();
    }
}
