<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_line', function (Blueprint $table) {
            $table->integer('line_id', true);
            $table->integer('order_id')->index('fk_order_id');
            $table->integer('product_id')->index('fk_product_id');
            $table->double('quantity');
            $table->double('amount');
            $table->double('product_total_amount');
            $table->integer('discount_id')->index('fk_discount_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_line');
    }
}
