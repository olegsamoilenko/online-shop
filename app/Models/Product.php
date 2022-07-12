<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, Sluggable;

  /**
   * Return the sluggable configuration array for this model.
   *
   * @return array
   */
  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'title',
    'short_description',
    'description',
    'price',
    'old_price',
    'category_id',
    'emotion',
    'volume',
    'diameter',
    'height',
    'color',
    'material',
    'made_by',
    'is_available',
    'is_active',
    'thumbnail'
  ];


  /**
   * The Tags that belong to the product.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */

  public function tags()
  {

    return $this->belongsToMany(Tag::class)->withTimestamps();
  }


  /**
   * The Images that belong to the product.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */

  public function images()
  {

    return $this->belongsToMany(Image::class)->withTimestamps();
  }

  /**
   * The Orders that belong to the product.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */

  public function orders()
  {

    return $this->belongsToMany(Order::class);
  }

  /**
   * The OneClickOrders that belong to the product.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */

  public function oneClickOrders()
  {

    return $this->belongsToMany(OneClickOrder::class);
  }

  /**
   * The Categories that belong to the product.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */

  public function category()
  {
    return $this->belongsTo(Category::class);
  }
}
