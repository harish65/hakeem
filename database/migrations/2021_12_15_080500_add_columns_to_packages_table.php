<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            
            $table->string('service_id',90)->nullable();
            $table->string('valid_from',90)->nullable();
            $table->string('valid_to',90)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn("service_id");
            $table->dropColumn("valid_from");
            $table->dropColumn('valid_to');
            
        });
    }
}
