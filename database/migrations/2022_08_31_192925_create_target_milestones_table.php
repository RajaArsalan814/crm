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
        Schema::create('target_milestones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('target_id');
            $table->integer('amount');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_achieved')->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('target_id')->references('id')->on('sales_targets');
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
        Schema::dropIfExists('target_milestones');
    }
};