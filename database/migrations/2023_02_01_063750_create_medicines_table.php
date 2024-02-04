<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->string('name')->nullable();
            $table->date('date_intake')->nullable();
            $table->time('time_intake')->nullable();
            $table->string('notes')->nullable();
            $table->string('dose_from')->nullable();
            $table->integer('dosage')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 for inactive , 1 for active');
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
        Schema::dropIfExists('medicines');
    }
}
