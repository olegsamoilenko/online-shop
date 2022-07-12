<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $category = new Category();
      $category->title = 'Cups';
      $category->save();

      $category = new Category();
      $category->title = 'Mugs';
      $category->save();

      $category = new Category();
      $category->title = 'Bowls';
      $category->save();

      $category = new Category();
      $category->title = 'Teapots';
      $category->save();

      $category = new Category();
      $category->title = 'Vases';
      $category->save();

      $category = new Category();
      $category->title = 'Crockery sets';
      $category->save();

      $category = new Category();
      $category->title = 'Plates';
      $category->save();

      $category = new Category();
      $category->title = 'Egg cups';
      $category->save();




    }
}
