<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilYayasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_yayasans', function (Blueprint $table) {
            $table->id();
            $table->string('logo_pic');
            $table->string('nama_yayasan');
            $table->string('sejarah');
            $table->string('visi');
            $table->string('misi');
            $table->string('struktur_organisasi');
            $table->string('nomor_rekening');
            $table->string('foto');
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
        Schema::dropIfExists('profil_yayasans');
    }
}
