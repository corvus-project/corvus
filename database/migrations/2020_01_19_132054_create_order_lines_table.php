<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->nullable()->unsigned();
            $table->integer('warehouse_id')->nullable()->unsigned();
            $table->integer('order_header_id')->nullable()->unsigned();
            $table->foreign('order_header_id')->references('id')->onDelete('cascade')->on('order_headers');
            $table->string('warehouse_name')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_sku')->index();
            $table->decimal('price', 8, 2)->default(0);
            $table->integer('quantity')->default(0);
            $table->integer('status')->default(0)->unsigned();
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
        Schema::dropIfExists('order_lines');
    }
}
