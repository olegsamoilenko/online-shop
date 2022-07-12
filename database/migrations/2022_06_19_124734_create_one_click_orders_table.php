<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOneClickOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('one_click_orders', function (Blueprint $table) {
      $table->id();
      $table->string('name')->default('');
      $table->string('surname')->default('');
      $table->decimal('phone', $precision = 12, $scale = 0)->unsigned();
      $table->string('city')->default('')->nullable();
      $table->string('shipping')->default('');
      $table->string('address')->default('')->nullable();
      $table->string('post_office')->default('')->nullable();
      $table->string('payment')->default('');
      $table->text('order_comment')->nullable();
      $table->boolean('paid')->default(false);
      $table->string('status')->default('new');
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
    Schema::dropIfExists('one_click_orders');
  }
}
