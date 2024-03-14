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
            $table->enum('tipe_pekerjaan', ['Remote', 'Onsite']);
            $table->string('keahlian');
            $table->string('lokasi');
            $table->string('gaji_bawah');
            $table->string('gaji_atas');
            $table->integer('kuota');
            $table->date('tgl_tutup');
            $table->enum('status', ['Pending', 'Dibuka', 'Ditutup']);
            $table->foreign('perusahaan_id')->references('id')->on('perusahaan')->restrictOnDelete();
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
