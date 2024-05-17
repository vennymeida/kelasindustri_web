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
        Schema::create('rekomendasilowongans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lulusan_id')->nullable();
            $table->foreign('lulusan_id')->references('id')->on('lulusans')->restrictOnDelete();
            $table->unsignedBigInteger('keahlian_id')->nullable();
            $table->foreign('keahlian_id')->references('id')->on('keahlians')->onDelete('set null');
            $table->unsignedBigInteger('loker_id');
            $table->foreign('loker_id')->references('id')->on('lokers')->restrictOnDelete();
            $table->string('score_similarity_lulusan');
            $table->string('score_similarity_keahlian');
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
        Schema::dropIfExists('rekomendasilowongans');
    }
};
