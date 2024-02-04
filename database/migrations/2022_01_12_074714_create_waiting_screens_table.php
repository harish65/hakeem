<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaitingScreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waiting_screens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_id',11)->nullable();
            $table->string('image',150)->nullable();
            $table->string('video',150)->nullable();
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
        Schema::dropIfExists('waiting_screens');
    }
}
