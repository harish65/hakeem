<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsvFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csv_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_extension')->nullable();
            $table->string('file_description')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->string('file_type')->default(1)->comment('1 for Add 2 for edit');
            $table->string('type')->default(0)->comment('0 for upload,1 for download');
            $table->tinyInteger('status')->default(0)->comment('0 for inactive , 1 for active');
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
        Schema::dropIfExists('csv_files');
    }
}
