<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusPemeritahuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemberitahuans', function (Blueprint $table) {
            $table->string('status')->default('belum dibaca');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemberitahuans', function (Blueprint $table) {
            $table->dropColumn('status')->default('belum dibaca');
        });
    }
}
