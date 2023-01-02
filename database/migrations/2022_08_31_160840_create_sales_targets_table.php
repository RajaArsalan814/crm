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
        Schema::create('sales_targets', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->integer('milestone');
            $table->integer('balance')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assign_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('assign_id')->references('id')->on('users');
            
            $table->date('duration');
            $table->boolean('is_achieved')->default(0);
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
        Schema::dropIfExists('sales_targets');
    }
};