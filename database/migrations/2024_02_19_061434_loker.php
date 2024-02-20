<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perusahaan_id');
            $table->string('nama_loker');
            $table->string('persyaratan');
            $table->string('deskripsi');
            $table->string('min_persyaratan');
            $table->string('gaji');
            $table->string('keahlian');
            $table->string('tipe_pekerjaan');
            $table->date('tgl_tutup');
            $table->string('lokasi');
            $table->integer('kuota');
            $table->foreign('perusahaan_id')->references('id')->on('perusahaans')->restrictOnDelete();
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
        Schema::dropIfExists('lokers');
    }
};
