<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tag = new Tag();
      $tag->title = 'Popular';
      $tag->save();

      $tag = new Tag();
      $tag->title = 'Novelties';
      $tag->save();

      $tag = new Tag();
      $tag->title = 'Promotion';
      $tag->save();
    }
}
