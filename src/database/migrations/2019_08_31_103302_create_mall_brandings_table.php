<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMallBrandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mall_brandings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('admin_id');
            $table->string('title');
            $table->string('image')->nullable();
            $table->string('position')->nullable();
            $table->string('size')->nullable();
            $table->string('rate')->nullable();
            $table->integer('discount')->default(0);
            $table->string('whatsup_no')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('mall_brandings');
    }
}
