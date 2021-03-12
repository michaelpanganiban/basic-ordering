<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_line', function (Blueprint $table) {
            $table->foreign('discount_id', 'fk_discount_id')->references('discount_id')->on('discount_configuration')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('order_id', 'fk_order_id')->references('order_id')->on('orders')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('product_id', 'fk_product_id')->references('product_id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_line', function (Blueprint $table) {
            $table->dropForeign('fk_discount_id');
            $table->dropForeign('fk_order_id');
            $table->dropForeign('fk_product_id');
        });
    }
}
