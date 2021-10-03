<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeterangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fitur_kurirs', function (Blueprint $table) {
            $table->string('keterangan');
            $table->string('biaya_tambahan')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fitur_kurirs', function (Blueprint $table) {
            $table->dropColumn('keterangan');
            $table->dropColumn('biaya_tambahan')->default(0);
        });
    }
}
