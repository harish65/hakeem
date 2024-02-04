<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->string('name')->nullable();
            $table->date('date_adminstrated')->nullable();
            $table->date('next_vaccination_date')->nullable();
            $table->string('veternation')->nullable();
            $table->string('veternation_license_number')->nullable();
            $table->string('lot_number')->nullable();
            $table->float('pet_weight')->nullable();
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
        Schema::dropIfExists('vaccinations');
    }
}
