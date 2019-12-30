<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->nullable()->unsigned();
            $table->foreign('product_id')->references('id')->onDelete('cascade')->on('products');
            $table->integer('pricing_group_id')->nullable()->unsigned();
            $table->foreign('pricing_group_id')->references('id')->onDelete('cascade')->on('pricing_groups');
            $table->decimal('amount', 8, 2);
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
        Schema::dropIfExists('pricings');
    }
}
