<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneClickOrder extends Model
{
    use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'surname',
    'phone',
    'city',
    'shipping',
    'address',
    'post_office',
    'payment',
    'status',
    'paid',
    'order_comment',
    'no_confirmation_call',

  ];

  /**
   * The Tags that belong to the product.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */

  public function products()
  {

    return $this->belongsToMany(Product::class)->withPivot('count');
  }
}
