<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('sale_date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('car_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');           
            $table->foreign('car_id')->on('cars')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('create_by');//user id who is creating 
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
        Schema::dropIfExists('sales');
    }
};
