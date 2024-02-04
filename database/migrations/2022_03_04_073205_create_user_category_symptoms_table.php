<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCategorySymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_category_symptoms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_symptom_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('category_symptom_id')->references('id')->on('category_symptoms');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_category_symptoms');
    }
}
