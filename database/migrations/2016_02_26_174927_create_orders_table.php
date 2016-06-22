<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->string('hash');
            $table->float('total');
            $table->integer('address_id');
            $table->boolean('paid');
            $table->integer('customer_id')->unsigned()->nullable();        
            $table->timestamps();

            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
