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
            $table->string('slug');
            $table->string('persyaratan');
            $table->string('persyaratan_lowstr');
            $table->string('deskripsi');
            $table->string('deskripsi_lowstr');
            $table->string('min_persyaratan');
            $table->string('min_persyaratan_lowstr');
            $table->string('gaji');
            $table->string('keahlian');
            $table->string('keahlian_lowstr');
            $table->string('tipe_pekerjaan');
            $table->string('tipe_pekerjaan_lowstr');
            $table->date('tgl_tutup');
            $table->string('lokasi');
            $table->string('lokasi_lowstr');
            $table->integer('kuota');
            $table->enum('status', ['dibuka', 'ditutup', 'pending'])->default('pending');
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
