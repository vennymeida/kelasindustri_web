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
        Schema::create('lulusans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('foto')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan', 'kosong'])->default('kosong');
            $table->enum('status', ['Aktif Mencari Kerja', 'Sudah Bekerja', 'Melanjutkan Kuliah'])->default('Aktif Mencari Kerja');
            $table->string('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('resume')->nullable();
            $table->string('angkatan_tahun')->nullable();
            $table->string('divisi')->nullable();
            $table->text('ringkasan')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
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
        Schema::dropIfExists('lulusans');
    }
};
