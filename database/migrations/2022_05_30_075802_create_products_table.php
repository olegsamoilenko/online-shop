<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title');
      $table->string('slug')->unique();
      $table->text('description');
      $table->decimal('price', $precision = 10, $scale = 2)->unsigned();
      $table->decimal('old_price', $precision = 10, $scale = 2)->unsigned()->nullable();
      $table->integer('category_id')->unsigned();
      $table->string('emotion')->nullable();
      $table->decimal('volume', $precision = 10, $scale = 2)->unsigned()->nullable();
      $table->decimal('diameter', $precision = 10, $scale = 2)->unsigned()->nullable();
      $table->decimal('height', $precision = 10, $scale = 2)->unsigned()->nullable();
      $table->string('color');
      $table->string('material');
      $table->string('made_by');
      $table->boolean('is_available');
      $table->boolean('is_active');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('products');
  }
}
