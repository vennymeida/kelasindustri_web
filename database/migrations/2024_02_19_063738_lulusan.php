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
            $table->unsignedBigInteger('pelatihan_id');
            $table->unsignedBigInteger('postingan_id');
            $table->unsignedBigInteger('portofolio_id');
            $table->unsignedBigInteger('pendidikan_id');
            $table->unsignedBigInteger('pengalaman_id');
            $table->unsignedBigInteger('lamaran_id');
            $table->string('foto')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan', 'kosong'])->default('kosong');
            $table->enum('status', ['aktif mencari kerja', 'sudah diterima kerja', 'melanjutkan kuliah'])->default('aktif mencari kerja');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('resume')->nullable();
            $table->text('ringkasan');
            $table->date('tgl_lahir');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('pelatihan_id')->references('id')->on('pelatihans')->restrictOnDelete();
            $table->foreign('postingan_id')->references('id')->on('postingans')->restrictOnDelete();
            $table->foreign('portofolio_id')->references('id')->on('portofolios')->restrictOnDelete();
            $table->foreign('pendidikan_id')->references('id')->on('pendidikans')->restrictOnDelete();
            $table->foreign('pengalaman_id')->references('id')->on('pengalamans')->restrictOnDelete();
            $table->foreign('lamaran_id')->references('id')->on('lamars')->restrictOnDelete();
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
