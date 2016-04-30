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
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('delivery_first_name');
            $table->string('delivery_last_name');
            $table->string('delivery_post_code');
            $table->string('delivery_address_line_1');
            $table->string('delivery_address_line_2')->nullable();
            $table->string('delivery_town/city');
            $table->string('delivery_country');
            $table->string('delivery_phone_number');
            $table->string('delivery_email_address');

            $table->string('billing_first_name')->nullable();
            $table->string('billing_last_name')->nullable();
            $table->string('billing_post_code')->nullable();
            $table->string('billing_address_line_1')->nullable();
            $table->string('billing_address_line_2')->nullable();
            $table->string('billing_town/city')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_phone_number')->nullable();
            $table->string('billing_email_address')->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
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
