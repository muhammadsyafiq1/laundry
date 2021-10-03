<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laundry_galleries', function (Blueprint $table) {
            $table->integer('laundry_id');
            $table->string('caption');
            $table->string('foto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laundry_galleries', function (Blueprint $table) {
             $table->dropColumn('laundry_id');
            $table->dropColumn('caption');
            $table->dropColumn('foto');
        });
    }
}
