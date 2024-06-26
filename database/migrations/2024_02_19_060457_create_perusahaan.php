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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kota_id');
            $table->string('nama_pemilik');
            $table->string('surat_mou')->nullable();
            $table->string('nama_perusahaan');
            $table->string('logo_perusahaan')->nullable();
            $table->string('email_perusahaan');
            $table->string('alamat_perusahaan');
            $table->string('deskripsi');
            $table->string('no_telp');
            $table->string('website')->nullable();
            $table->enum('status', ['banned', 'unbanned'])->default('unbanned');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('kota_id')->references('id')->on('kotas')->restrictOnDelete();
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
        Schema::dropIfExists('perusahaan');
    }
};
