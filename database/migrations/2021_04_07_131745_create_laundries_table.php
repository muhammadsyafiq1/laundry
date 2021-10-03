<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundries', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_laundry');
            $table->string('slug_laundry');
            $table->text('alamat_laundry');
            $table->text('deskripsi_laundry');
            $table->string('hp_laundry');
            $table->string('foto_laundry');
            $table->integer('harga_kilo');
            $table->date('berdiri_sejak');
            
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
        Schema::dropIfExists('laundries');
    }
}
