<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('surname');
          $table->decimal('phone', $precision = 12, $scale = 0)->unsigned();
          $table->string('city')->nullable();
          $table->string('shipping');
          $table->string('address')->nullable();
          $table->string('post_office')->nullable();
          $table->string('payment');
          $table->text('order_comment')->nullable();
          $table->boolean('no_confirmation_call');
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
        Schema::dropIfExists('orders');
    }
}
