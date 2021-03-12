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
            $table->integer('order_id', true);
            $table->double('sub_total');
            $table->integer('delivery_id')->index('fk_delivery_id');
            $table->double('deliver_amount');
            $table->double('total_amount');
            $table->unsignedBigInteger('created_by')->index('fk_created_by');
            $table->dateTime('created_at');
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
