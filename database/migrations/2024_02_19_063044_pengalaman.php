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
        Schema::create('pengalamans', function (Blueprint $table) {
            $table->id();
            $table->string('tingkatan');
            $table->string('alamat');
            $table->string('tipe');
            $table->string('nama_pengalaman');
            $table->string('nama_instansi');
            $table->date('tgl_selesai');
            $table->date('tgl_mulai');
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
        Schema::dropIfExists('pengalamans');
    }
};
