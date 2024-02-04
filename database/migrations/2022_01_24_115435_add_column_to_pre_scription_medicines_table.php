<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPreScriptionMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pre_scription_medicines', function (Blueprint $table) {
            
            $table->string('days',40)->after('pre_scription_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pre_scription_medicines', function (Blueprint $table) {
            
            $table->dropColumn('days');
        });
    }
}
