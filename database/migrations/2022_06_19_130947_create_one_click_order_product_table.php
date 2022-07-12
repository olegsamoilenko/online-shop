<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOneClickOrderProductTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('one_click_order_product', function (Blueprint $table) {
      $table->id();
      $table->integer('one_click_order_id')->unsigned();
      $table->integer('product_id')->unsigned();
      $table->integer('count')->default(1);
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
    Schema::dropIfExists('one_click_order_product');
  }
}
