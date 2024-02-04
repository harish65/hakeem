<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_certifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('certification_category')->nullable();
            $table->string('certification_type')->nullable();
            $table->string('certification_name')->nullable();
            $table->string('certification_file')->nullable();
            $table->date('launch_day')->nullable();
            $table->string('no_launch_day',1)->default('0')->nullable();
            $table->date('expiratory_day')->nullable();
            $table->string('no_expiratory_day',1)->default('0')->nullable();
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
        Schema::dropIfExists('user_certifications');
    }
}
