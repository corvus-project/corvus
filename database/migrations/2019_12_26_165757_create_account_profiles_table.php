<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->unique();
            $table->integer('stock_type_id')->nullable()->unsigned();
            $table->integer('pricing_group_id')->nullable()->unsigned();
            $table->integer('warehouse_id')->nullable()->unsigned();
            $table->string('account_number')->nullable();
            $table->string('account_group')->nullable();
            
            /*
             * Add Foreign/Unique/Index
             */
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('stock_type_id')
                ->references('id')
                ->on('stock_types')
                ->onDelete('cascade');

            $table->foreign('pricing_group_id')
                ->references('id')
                ->on('pricing_groups')
                ->onDelete('cascade');

            $table->foreign('warehouse_id')
                ->references('id')
                ->on('warehouses')
                ->onDelete('cascade');                
            
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
        Schema::dropIfExists('account_profiles');
    }
}