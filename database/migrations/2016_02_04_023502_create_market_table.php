<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('markets', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('image');
            $table->string('title1',255);
            $table->string('title2',255);
            $table->decimal('sc_price',10,2);
            $table->decimal('cb_price',10,2);
            $table->integer('rank');
            $table->text('desc');//产品描述
            $table->string('alibaba1');
            $table->string('alibaba2');
            $table->string('investigators',60);
            $table->integer('amount');
            $table->enum('status',array(0,1))->default('0');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default('0000-00-00 00:00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('markets');
    }
}
