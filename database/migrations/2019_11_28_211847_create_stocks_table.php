<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->nullable()->unsigned();
            $table->foreign('product_id')->references('id')->onDelete('cascade')->on('products');
            $table->integer('stock_type_id')->nullable()->unsigned();
            $table->foreign('stock_type_id')->references('id')->onDelete('cascade')->on('stock_types');
            $table->integer('warehouse_id')->nullable()->unsigned();
            $table->foreign('warehouse_id')->references('id')->onDelete('cascade')->on('warehouses');            
            $table->integer('quantity')->default(0);
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable(); 
            $table->softDeletes();          
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
        Schema::dropIfExists('stocks');
    }
}
