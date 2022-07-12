<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Image;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//    1  =====================================================================

      $product = new Product();
      $product->title = 'Treats - cup with saucer tassen (200 ml)';
      $product->description = 'Treats - cup with saucer tassen (200 ml)';
      $product->price = 800;
      $product->old_price = 900;
      $product->category_id = 1;
      $product->emotion = 'delicacy';
      $product->volume = 200;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product1Images = Image::whereBetween('id', [1, 5])->get();
      $product1Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product1Images);
      $product->tags()->attach($product1Tags);

//  2    =====================================================================

      $product = new Product();
      $product->title = 'Optimist - kettle (1.2 l.) - 58products - tassen';
      $product->description = '<p>Cheerful "nosed" teapot with a wide smile and large, childishly wide-open eyes - a touching facial expression acts like an instant magic pill, raising the mood of everyone around. The unusual shape attracts attention with a beautiful slope, as if Dobryak is about to start dancing. Despite the curves, the lid is securely fixed to the kettle thanks to two porcelain "hooks" inside to keep hot and cold drinks fresh for as long as possible. Idea for shoppers who like bold experiments: use the teapot as a vase!</p>
<p>Genuine hard porcelain, hotel grade impact resistance.
Sanded base, enamelled top edge.
Suitable for dishwasher and microwave oven.
100% made in Germany.</p>
<p>Mint green gift box.</p>';
      $product->price = 2800;
      $product->old_price = 3100;
      $product->category_id = 4;
      $product->emotion = 'delicacy';
//      $product->volume = 200;
      $product->diameter = 12.5;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product2Images = Image::whereBetween('id', [6, 10])->get();
      $product2Tags = Tag::whereIn('title', ['Promotion'])->get();

      $product->images()->attach($product2Images);
      $product->tags()->attach($product2Tags);

//   3   ====================================================

      $product = new Product();
      $product->title = 'Happy smile - tassen cup with saucer (200 ml)';
      $product->description = 'Happy smile - tassen cup with saucer (200 ml)';
      $product->price = 800;
//      $product->old_price = 900;
      $product->category_id = 1;
      $product->emotion = 'smile';
      $product->volume = 200;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product3Images = Image::whereBetween('id', [11, 15])->get();
      $product3Tags = Tag::whereIn('title', ['Popular', 'Novelties'])->get();

      $product->images()->attach($product3Images);
      $product->tags()->attach($product3Tags);

//   4   =====================================================================

      $product = new Product();
      $product->title = 'Sleepyhead - cup and saucer tassen (200 ml)';
      $product->description = 'Sleepyhead - cup and saucer tassen (200 ml)';
      $product->price = 800;
//      $product->old_price = 900;
      $product->category_id = 1;
      $product->emotion = 'sleepyhead';
      $product->volume = 200;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product4Images = Image::whereBetween('id', [16, 20])->get();
      $product4Tags = Tag::whereIn('title', ['Novelties'])->get();

      $product->images()->attach($product4Images);
      $product->tags()->attach($product4Tags);

//   5   =====================================================================

      $product = new Product();
      $product->title = 'Sly smile - tassen cup with saucer (200 ml)';
      $product->description = 'Sly smile - tassen cup with saucer (200 ml)';
      $product->price = 800;
//      $product->old_price = 900;
      $product->category_id = 1;
      $product->emotion = 'smile';
      $product->volume = 200;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product5Images = Image::whereBetween('id', [21, 25])->get();
      $product5Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product5Images);
      $product->tags()->attach($product5Tags);

//   6   =====================================================================

      $product = new Product();
      $product->title = 'Oops, come on - tassen cup and saucer (200 ml)';
      $product->description = 'Oops, come on - tassen cup and saucer (200 ml)';
      $product->price = 800;
      $product->old_price = 900;
      $product->category_id = 1;
      $product->emotion = 'astonishment';
      $product->volume = 200;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product6Images = Image::whereBetween('id', [26, 30])->get();
      $product6Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product6Images);
      $product->tags()->attach($product6Tags);

//   7   =====================================================================

      $product = new Product();
      $product->title = 'Kiss - cup with saucer tassen (200 ml)';
      $product->description = 'Kiss - cup with saucer tassen (200 ml)';
      $product->price = 800;
//      $product->old_price = 900;
      $product->category_id = 1;
      $product->emotion = 'kiss';
      $product->volume = 200;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product7Images = Image::whereBetween('id', [31, 35])->get();
      $product7Tags = Tag::whereIn('title', ['Novelties'])->get();

      $product->images()->attach($product7Images);
      $product->tags()->attach($product7Tags);

//   8   =====================================================================

      $product = new Product();
      $product->title = 'Set of 8 cups';
      $product->description = 'Set of 8 cups';
      $product->price = 6800;
//      $product->old_price = 900;
      $product->category_id = 6;
//      $product->emotion = 'kiss';
      $product->volume = 200;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product8Images = Image::whereBetween('id', [36, 40])->get();
      $product8Tags = Tag::whereIn('title', ['Novelties'])->get();

      $product->images()->attach($product8Images);
      $product->tags()->attach($product8Tags);

//   9   =====================================================================

      $product = new Product();
      $product->title = 'Set of 4 cups and teapot';
      $product->description = 'Set of 4 cups and teapot';
      $product->price = 6800;
      $product->old_price = 9000;
      $product->category_id = 6;
//      $product->emotion = 'kiss';
//      $product->volume = 200;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product9Images = Image::whereBetween('id', [41, 45])->get();
      $product9Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product9Images);
      $product->tags()->attach($product9Tags);

//   10   =====================================================================

      $product = new Product();
      $product->title = 'Set of 4 cups';
      $product->description = 'Set of 4 cups';
      $product->price = 3800;
//      $product->old_price = 9000;
      $product->category_id = 6;
//      $product->emotion = 'kiss';
//      $product->volume = 200;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product10Images = Image::whereBetween('id', [46, 50])->get();
      $product10Tags = Tag::whereIn('title', ['Popular', 'Novelties'])->get();

      $product->images()->attach($product10Images);
      $product->tags()->attach($product10Tags);

//   11   =====================================================================

      $product = new Product();
      $product->title = 'Happy smile - espresso cup with saucer (100 ml)';
      $product->description = 'Happy smile - espresso cup with saucer (100 ml)';
      $product->price = 800;
      $product->old_price = 900;
      $product->category_id = 1;
      $product->emotion = 'smile';
      $product->volume = 100;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product11Images = Image::whereBetween('id', [51, 55])->get();
      $product11Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product11Images);
      $product->tags()->attach($product11Tags);

//   12   =====================================================================

      $product = new Product();
      $product->title = 'Kiss - espresso cup with saucer (100 ml)';
      $product->description = 'Kiss - espresso cup with saucer (100 ml)';
      $product->price = 800;
//      $product->old_price = 900;
      $product->category_id = 1;
      $product->emotion = 'kiss';
      $product->volume = 100;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product12Images = Image::whereBetween('id', [56, 60])->get();
      $product12Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product12Images);
      $product->tags()->attach($product12Tags);

//   13   =====================================================================

      $product = new Product();
      $product->title = 'Oops, come on - espresso cup with saucer (100 ml)';
      $product->description = 'Oops, come on - espresso cup with saucer (100 ml)';
      $product->price = 800;
//      $product->old_price = 900;
      $product->category_id = 1;
      $product->emotion = 'astonishment';
      $product->volume = 100;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product13Images = Image::whereBetween('id', [61, 65])->get();
      $product13Tags = Tag::whereIn('title', ['Promotion'])->get();

      $product->images()->attach($product13Images);
      $product->tags()->attach($product13Tags);

//   14   =====================================================================

      $product = new Product();
      $product->title = 'Sly smile - espresso cup with saucer (100 ml)';
      $product->description = 'Sly smile - espresso cup with saucer (100 ml)';
      $product->price = 800;
//      $product->old_price = 900;
      $product->category_id = 1;
      $product->emotion = 'smile';
      $product->volume = 100;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product14Images = Image::whereBetween('id', [66, 70])->get();
      $product14Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product14Images);
      $product->tags()->attach($product14Tags);


//   15   =====================================================================

      $product = new Product();
      $product->title = 'Set of 4 espresso cups with saucers (100 ml)';
      $product->description = 'Set of 4 espresso cups with saucers (100 ml)';
      $product->price = 2800;
      $product->old_price = 2900;
      $product->category_id = 6;
//      $product->emotion = 'smile';
      $product->volume = 100;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product15Images = Image::whereBetween('id', [71, 75])->get();
      $product15Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product15Images);
      $product->tags()->attach($product15Tags);

//   16   =====================================================================

      $product = new Product();
      $product->title = 'Smile - mug with handle tassen (350 ml) - 58products - tassen';
      $product->description = 'Smile - mug with handle tassen (350 ml) - 58products - tassen';
      $product->price = 900;
      $product->old_price = 1100;
      $product->category_id = 2;
      $product->emotion = 'smile';
      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product16Images = Image::whereBetween('id', [76, 80])->get();
      $product16Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product16Images);
      $product->tags()->attach($product16Tags);

//   17   =====================================================================

      $product = new Product();
      $product->title = 'Grumpy - mug with tassen handle (350 ml) - 58products - tassen';
      $product->description = 'Grumpy - mug with tassen handle (350 ml) - 58products - tassen';
      $product->price = 900;
//      $product->old_price = 1100;
      $product->category_id = 2;
      $product->emotion = 'grumpy';
      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product17Images = Image::whereBetween('id', [81, 85])->get();
      $product17Tags = Tag::whereIn('title', ['Novelties'])->get();

      $product->images()->attach($product17Images);
      $product->tags()->attach($product17Tags);

//   18   =====================================================================

      $product = new Product();
      $product->title = 'Prankster - mug with handle tassen (350 ml) - 58products - tassen';
      $product->description = 'Prankster - mug with handle tassen (350 ml) - 58products - tassen';
      $product->price = 900;
//      $product->old_price = 1100;
      $product->category_id = 2;
      $product->emotion = 'smile';
      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product18Images = Image::whereBetween('id', [86, 90])->get();
      $product18Tags = Tag::whereIn('title', ['Popular', 'Novelties'])->get();

      $product->images()->attach($product18Images);
      $product->tags()->attach($product18Tags);

//   19   =====================================================================

      $product = new Product();
      $product->title = 'Humble - tassen mug with handle (350 ml) - 58products - tassen';
      $product->description = 'Humble - tassen mug with handle (350 ml) - 58products - tassen';
      $product->price = 900;
//      $product->old_price = 1100;
      $product->category_id = 2;
      $product->emotion = 'astonishment';
      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product19Images = Image::whereBetween('id', [91, 95])->get();
      $product19Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product19Images);
      $product->tags()->attach($product19Tags);

//   20   =====================================================================

      $product = new Product();
      $product->title = 'Laughter - mug with tassin handle (350 ml) - 58products - tassin';
      $product->description = 'Laughter - mug with tassin handle (350 ml) - 58products - tassin';
      $product->price = 900;
//      $product->old_price = 1100;
      $product->category_id = 2;
      $product->emotion = 'laugh';
      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product20Images = Image::whereBetween('id', [96, 100])->get();
      $product20Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product20Images);
      $product->tags()->attach($product20Tags);

//   21   =====================================================================

      $product = new Product();
      $product->title = 'Grumpy & prankster - mug set without handle (350 ml) - 58products - tassen';
      $product->description = 'Grumpy & prankster - mug set without handle (350 ml) - 58products - tassen';
      $product->price = 1400;
      $product->old_price = 1500;
      $product->category_id = 2;
//      $product->emotion = 'laugh';
      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product21Images = Image::whereBetween('id', [101, 105])->get();
      $product21Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product21Images);
      $product->tags()->attach($product21Tags);

//   22   =====================================================================

      $product = new Product();
      $product->title = 'Smile & humble - mug set without handle (350 ml) - 58products - tassen';
      $product->description = 'Smile & humble - mug set without handle (350 ml) - 58products - tassen';
      $product->price = 1400;
//      $product->old_price = 1500;
      $product->category_id = 2;
//      $product->emotion = 'laugh';
      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product22Images = Image::whereBetween('id', [106, 110])->get();
      $product22Tags = Tag::whereIn('title', ['Novelties'])->get();

      $product->images()->attach($product22Images);
      $product->tags()->attach($product22Tags);

//   23   =====================================================================

      $product = new Product();
      $product->title = 'Happy smile - tassen bowl (500 ml)';
      $product->description = 'Happy smile - tassen bowl (500 ml)';
      $product->price = 1100;
      $product->old_price = 1300;
      $product->category_id = 3;
      $product->emotion = 'laugh';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product23Images = Image::whereBetween('id', [111, 115])->get();
      $product23Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product23Images);
      $product->tags()->attach($product23Tags);

//   24   =====================================================================

      $product = new Product();
      $product->title = 'Laughter therapy - bowl (500 ml.)';
      $product->description = 'Laughter therapy - bowl (500 ml.)';
      $product->price = 1100;
//      $product->old_price = 1300;
      $product->category_id = 3;
      $product->emotion = 'laugh';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product24Images = Image::whereBetween('id', [116, 120])->get();
      $product24Tags = Tag::whereIn('title', ['Popular', 'Novelties'])->get();

      $product->images()->attach($product24Images);
      $product->tags()->attach($product24Tags);

//   25   =====================================================================

      $product = new Product();
      $product->title = 'Delicacy - bowl tassen (500 ml.)';
      $product->description = 'Delicacy - bowl tassen (500 ml.)';
      $product->price = 1100;
//      $product->old_price = 1300;
      $product->category_id = 3;
      $product->emotion = 'smile';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product25Images = Image::whereBetween('id', [121, 125])->get();
      $product25Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product25Images);
      $product->tags()->attach($product25Tags);

//   26   =====================================================================

      $product = new Product();
      $product->title = 'Kiss - bowl tassin (500 ml.)';
      $product->description = 'Kiss - bowl tassin (500 ml.)';
      $product->price = 1100;
      $product->old_price = 1300;
      $product->category_id = 3;
      $product->emotion = 'kiss';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product26Images = Image::whereBetween('id', [126, 130])->get();
      $product26Tags = Tag::whereIn('title', ['Novelties', 'Promotion'])->get();

      $product->images()->attach($product26Images);
      $product->tags()->attach($product26Tags);

//   27   =====================================================================

      $product = new Product();
      $product->title = 'Crazy in love - tassen bowl (500 ml)';
      $product->description = 'Crazy in love - tassen bowl (500 ml)';
      $product->price = 1100;
//      $product->old_price = 1300;
      $product->category_id = 3;
      $product->emotion = 'smile';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product27Images = Image::whereBetween('id', [131, 135])->get();
      $product27Tags = Tag::whereIn('title', ['Novelties'])->get();

      $product->images()->attach($product27Images);
      $product->tags()->attach($product27Tags);

//   28   =====================================================================

      $product = new Product();
      $product->title = 'Kuksa - bowl tassen (500 ml.)';
      $product->description = 'Kuksa - bowl tassen (500 ml.)';
      $product->price = 1100;
//      $product->old_price = 1300;
      $product->category_id = 3;
      $product->emotion = 'astonishment';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product28Images = Image::whereBetween('id', [136, 140])->get();
      $product28Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product28Images);
      $product->tags()->attach($product28Tags);

//   29   =====================================================================

      $product = new Product();
      $product->title = 'Out of control - salad bowl (2.6 l.)';
      $product->description = 'Out of control - salad bowl (2.6 l.)';
      $product->price = 1900;
//      $product->old_price = 1300;
      $product->category_id = 3;
      $product->emotion = 'smile';
//      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product29Images = Image::whereBetween('id', [141, 145])->get();
      $product29Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product29Images);
      $product->tags()->attach($product29Tags);

//   30   =====================================================================

      $product = new Product();
      $product->title = 'Happy smile - bowl with a gold rim (500 ml)';
      $product->description = 'Happy smile - bowl with a gold rim (500 ml)';
      $product->price = 1300;
      $product->old_price = 1500;
      $product->category_id = 3;
      $product->emotion = 'smile';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product30Images = Image::whereBetween('id', [146, 150])->get();
      $product30Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product30Images);
      $product->tags()->attach($product30Tags);

//   31   =====================================================================

      $product = new Product();
      $product->title = 'Kuksa - bowl with a gold rim (500 ml)';
      $product->description = 'Kuksa - bowl with a gold rim (500 ml)';
      $product->price = 1300;
//      $product->old_price = 1500;
      $product->category_id = 3;
      $product->emotion = 'astonishment';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product31Images = Image::whereBetween('id', [151, 155])->get();
      $product31Tags = Tag::whereIn('title', ['Promotion'])->get();

      $product->images()->attach($product31Images);
      $product->tags()->attach($product31Tags);

//   32   =====================================================================

      $product = new Product();
      $product->title = 'Sly smile - bowl with a gold rim (500 ml)';
      $product->description = 'Sly smile - bowl with a gold rim (500 ml)';
      $product->price = 1300;
//      $product->old_price = 1500;
      $product->category_id = 3;
      $product->emotion = 'smile';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product32Images = Image::whereBetween('id', [156, 160])->get();
      $product32Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product32Images);
      $product->tags()->attach($product32Tags);

//   33   =====================================================================

      $product = new Product();
      $product->title = 'Kiss - bowl with a gold rim (500 ml)';
      $product->description = 'Kiss - bowl with a gold rim (500 ml)';
      $product->price = 1300;
//      $product->old_price = 1500;
      $product->category_id = 3;
      $product->emotion = 'kiss';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product33Images = Image::whereBetween('id', [161, 165])->get();
      $product33Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product33Images);
      $product->tags()->attach($product33Tags);

//   34   =====================================================================

      $product = new Product();
      $product->title = 'Crazy in love - bowl (500 ml)';
      $product->description = 'Crazy in love - bowl (500 ml)';
      $product->price = 1100;
//      $product->old_price = 1500;
      $product->category_id = 3;
      $product->emotion = 'smile';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product34Images = Image::whereBetween('id', [166, 170])->get();
      $product34Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product34Images);
      $product->tags()->attach($product34Tags);

//   35   =====================================================================

      $product = new Product();
      $product->title = 'Laughter therapy - bowl (500 ml.)';
      $product->description = 'Laughter therapy - bowl (500 ml.)';
      $product->price = 1100;
      $product->old_price = 1200;
      $product->category_id = 3;
      $product->emotion = 'laugh';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product35Images = Image::whereBetween('id', [171, 175])->get();
      $product35Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product35Images);
      $product->tags()->attach($product35Tags);

//   36   =====================================================================

      $product = new Product();
      $product->title = 'Sly smile - bowl (500 ml.)';
      $product->description = 'Sly smile - bowl (500 ml.)';
      $product->price = 1100;
      $product->old_price = 1200;
      $product->category_id = 3;
      $product->emotion = 'smile';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product36Images = Image::whereBetween('id', [176, 180])->get();
      $product36Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product36Images);
      $product->tags()->attach($product36Tags);

//   37   =====================================================================

      $product = new Product();
      $product->title = 'Happy smile - bowl (500 ml)';
      $product->description = 'Happy smile - bowl (500 ml)';
      $product->price = 1100;
      $product->old_price = 1200;
      $product->category_id = 3;
      $product->emotion = 'smile';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product37Images = Image::whereBetween('id', [181, 185])->get();
      $product37Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product37Images);
      $product->tags()->attach($product37Tags);

//   38   =====================================================================

      $product = new Product();
      $product->title = 'Kiss - bowl (500 ml.)';
      $product->description = 'Kiss - bowl (500 ml.)';
      $product->price = 1100;
//      $product->old_price = 1200;
      $product->category_id = 3;
      $product->emotion = 'kiss';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product38Images = Image::whereBetween('id', [186, 190])->get();
      $product38Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product38Images);
      $product->tags()->attach($product38Tags);

//   39   =====================================================================

      $product = new Product();
      $product->title = 'Set of 6 pials';
      $product->description = 'Set of 6 pials';
      $product->price = 6500;
//      $product->old_price = 1200;
      $product->category_id = 6;
//      $product->emotion = 'kiss';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product39Images = Image::whereBetween('id', [191, 195])->get();
      $product39Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product39Images);
      $product->tags()->attach($product39Tags);

//   40   =====================================================================

      $product = new Product();
      $product->title = 'Mega set of 13 pials';
      $product->description = 'Mega set of 13 pials';
      $product->price = 7500;
//      $product->old_price = 1200;
      $product->category_id = 6;
//      $product->emotion = 'kiss';
      $product->volume = 500;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product40Images = Image::whereBetween('id', [196, 200])->get();
      $product40Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product40Images);
      $product->tags()->attach($product40Tags);

//   41   =====================================================================

      $product = new Product();
      $product->title = 'Happy smile & oh, come on - set of 2 pials (200 ml)';
      $product->description = 'Happy smile & oh, come on - set of 2 pials (200 ml)';
      $product->price = 1500;
//      $product->old_price = 1200;
      $product->category_id = 6;
//      $product->emotion = 'kiss';
      $product->volume = 200;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product41Images = Image::whereBetween('id', [201, 205])->get();
      $product41Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product41Images);
      $product->tags()->attach($product41Tags);

//   42   =====================================================================

      $product = new Product();
      $product->title = 'All assembly - salad bowl (2.6 l.) and bowl set (4x100 ml.)';
      $product->description = 'All assembly - salad bowl (2.6 l.) and bowl set (4x100 ml.)';
      $product->price = 3500;
//      $product->old_price = 1200;
      $product->category_id = 6;
//      $product->emotion = 'kiss';
//      $product->volume = 200;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product42Images = Image::whereBetween('id', [206, 210])->get();
      $product42Tags = Tag::whereIn('title', ['Novelties'])->get();

      $product->images()->attach($product42Images);
      $product->tags()->attach($product42Tags);

//   43   =====================================================================

      $product = new Product();
      $product->title = 'Merry family - salad bowl (2.6 l.) and bowls (4x200 ml.)';
      $product->description = 'Merry family - salad bowl (2.6 l.) and bowls (4x200 ml.)';
      $product->price = 3500;
//      $product->old_price = 1200;
      $product->category_id = 6;
//      $product->emotion = 'kiss';
//      $product->volume = 200;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product43Images = Image::whereBetween('id', [211, 215])->get();
      $product43Tags = Tag::whereIn('title', ['Promotion'])->get();

      $product->images()->attach($product43Images);
      $product->tags()->attach($product43Tags);

      //   44   =====================================================================

      $product = new Product();
      $product->title = 'Kind - milk jar (350 ml) - 58products - tassen';
      $product->description = 'Kind - milk jar (350 ml) - 58products - tassen';
      $product->price = 1700;
//      $product->old_price = 1200;
      $product->category_id = 4;
      $product->emotion = 'smile';
      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product44Images = Image::whereBetween('id', [216, 220])->get();
      $product44Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product44Images);
      $product->tags()->attach($product44Tags);

//   45   =====================================================================

      $product = new Product();
      $product->title = 'Dream team - teapot (1.2l) and milk jar (350ml) - 58products - tassen';
      $product->description = 'Dream team - teapot (1.2l) and milk jar (350ml) - 58products - tassen';
      $product->price = 1700;
//      $product->old_price = 1200;
      $product->category_id = 4;
      $product->emotion = 'smile';
//      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 200;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product45Images = Image::whereBetween('id', [221, 225])->get();
      $product45Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product45Images);
      $product->tags()->attach($product45Tags);

//   46   =====================================================================

      $product = new Product();
      $product->title = 'Happy life - tassen vase';
      $product->description = 'Happy life - tassen vase';
      $product->price = 2400;
//      $product->old_price = 1200;
      $product->category_id = 5;
      $product->emotion = 'smile';
//      $product->volume = 350;
      $product->diameter = 8;
      $product->height = 16.5;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product46Images = Image::whereBetween('id', [226, 230])->get();
      $product46Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product46Images);
      $product->tags()->attach($product46Tags);

//   47   =====================================================================

      $product = new Product();
      $product->title = 'Inspiration - vase tassen';
      $product->description = 'Inspiration - vase tassen';
      $product->price = 2400;
//      $product->old_price = 1200;
      $product->category_id = 5;
      $product->emotion = 'smile';
//      $product->volume = 350;
      $product->diameter = 8.2;
      $product->height = 23;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product47Images = Image::whereBetween('id', [231, 235])->get();
      $product47Tags = Tag::whereIn('title', ['Promotion'])->get();

      $product->images()->attach($product47Images);
      $product->tags()->attach($product47Tags);

//   48   =====================================================================

      $product = new Product();
      $product->title = 'Set of 2 deep partially eaten plates (24 sm)';
      $product->description = 'Set of 2 deep partially eaten plates (24 sm)';
      $product->price = 1400;
      $product->old_price = 1500;
      $product->category_id = 7;
//      $product->emotion = 'smile';
//      $product->volume = 350;
      $product->diameter = 24;
//      $product->height = 23;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product48Images = Image::whereBetween('id', [236, 240])->get();
      $product48Tags = Tag::whereIn('title', ['Promotion'])->get();

      $product->images()->attach($product48Images);
      $product->tags()->attach($product48Tags);

//   49   =====================================================================

      $product = new Product();
      $product->title = 'Set of 2 deep partially eaten big plates (28 sm)';
      $product->description = 'Set of 2 deep partially eaten big plates (28 sm)';
      $product->price = 1300;
//      $product->old_price = 1500;
      $product->category_id = 7;
//      $product->emotion = 'smile';
//      $product->volume = 350;
      $product->diameter = 28;
//      $product->height = 23;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product49Images = Image::whereBetween('id', [241, 245])->get();
      $product49Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product49Images);
      $product->tags()->attach($product49Tags);

//   50   =====================================================================

      $product = new Product();
      $product->title = 'Set of 2 with a bite dessert saucers (20 cm)';
      $product->description = 'Set of 2 with a bite dessert saucers (20 cm)';
      $product->price = 900;
//      $product->old_price = 1500;
      $product->category_id = 7;
//      $product->emotion = 'smile';
//      $product->volume = 350;
      $product->diameter = 20;
//      $product->height = 23;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product50Images = Image::whereBetween('id', [246, 250])->get();
      $product50Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product50Images);
      $product->tags()->attach($product50Tags);

//   51   =====================================================================

      $product = new Product();
      $product->title = 'Bowl set "delicious" and 2 partially eaten saucers';
      $product->description = 'Bowl set "delicious" and 2 partially eaten saucers';
      $product->price = 1800;
      $product->old_price = 1900;
      $product->category_id = 7;
//      $product->emotion = 'smile';
//      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 23;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product51Images = Image::whereBetween('id', [251, 255])->get();
      $product51Tags = Tag::whereIn('title', ['Popular', 'Promotion'])->get();

      $product->images()->attach($product51Images);
      $product->tags()->attach($product51Tags);

//   52   =====================================================================

      $product = new Product();
      $product->title = 'Espresso cup saucer';
      $product->description = 'Espresso cup saucer';
      $product->price = 90;
//      $product->old_price = 1900;
      $product->category_id = 7;
//      $product->emotion = 'smile';
//      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 23;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product52Images = Image::whereBetween('id', [256, 260])->get();
      $product52Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product52Images);
      $product->tags()->attach($product52Tags);

//   53   =====================================================================

      $product = new Product();
      $product->title = 'Oh, come on & treats - egg racks';
      $product->description = 'Oh, come on & treats - egg racks';
      $product->price = 700;
//      $product->old_price = 1900;
      $product->category_id = 8;
//      $product->emotion = 'smile';
//      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 23;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product53Images = Image::whereBetween('id', [261, 265])->get();
      $product53Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product53Images);
      $product->tags()->attach($product53Tags);

//   54   =====================================================================

      $product = new Product();
      $product->title = 'Kiss & dreamer - egg racks';
      $product->description = 'Kiss & dreamer - egg racks';
      $product->price = 700;
//      $product->old_price = 1900;
      $product->category_id = 8;
//      $product->emotion = 'smile';
//      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 23;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product54Images = Image::whereBetween('id', [266, 270])->get();
      $product54Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product54Images);
      $product->tags()->attach($product54Tags);

//   55   =====================================================================

      $product = new Product();
      $product->title = 'Happy smile and hmmm - egg racks';
      $product->description = 'Happy smile and hmmm - egg racks';
      $product->price = 770;
//      $product->old_price = 1900;
      $product->category_id = 8;
//      $product->emotion = 'smile';
//      $product->volume = 350;
//      $product->diameter = 20;
//      $product->height = 23;
      $product->color = 'white';
      $product->material = 'Porcelain';
      $product->made_by = 'Germany';
      $product->is_available = 1;
      $product->is_active = 1;
      $product->save();

      $product55Images = Image::whereBetween('id', [271, 275])->get();
      $product55Tags = Tag::whereIn('title', ['Popular'])->get();

      $product->images()->attach($product55Images);
      $product->tags()->attach($product55Tags);

//      Product::factory()
//        ->count(1)
//        ->hasAttached(Image::inRandomOrder()->limit(4)->get())
//        ->state(new Sequence(
//          function ($sequence) {
//            return ['category_id' => Category::all()->random()];
//          },
//        ))
//        ->hasAttached(Tag::first())
//        ->create();
//
//      Product::factory()
//        ->count(1)
//        ->hasAttached(Image::inRandomOrder()->limit(4)->get())
//        ->state(new Sequence(
//          function ($sequence) {
//            return ['category_id' => Category::all()->random()];
//          },
//        ))
//        ->hasAttached(Tag::first())
//        ->create();
//
//      Product::factory()
//        ->count(1)
//        ->hasAttached(Image::inRandomOrder()->limit(4)->get())
//        ->state(new Sequence(
//          function ($sequence) {
//            return ['category_id' => Category::all()->random()];
//          },
//        ))
//        ->hasAttached(Tag::first())
//        ->create();
//
//      Product::factory()
//        ->count(1)
//        ->hasAttached(Image::inRandomOrder()->limit(4)->get())
//        ->state(new Sequence(
//          function ($sequence) {
//            return ['category_id' => Category::all()->random()];
//          },
//        ))
//        ->hasAttached(Tag::first())
//        ->create();
//
//      Product::factory()
//        ->count(1)
//        ->hasAttached(Image::inRandomOrder()->limit(4)->get())
//        ->state(new Sequence(
//          function ($sequence) {
//            return ['category_id' => Category::all()->random()];
//          },
//        ))
//        ->hasAttached(Tag::first())
//        ->create();
    }
}
