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
            $table->unsignedBigInteger('lulusan_id');
            $table->foreign('lulusan_id')->references('id')->on('lulusans')->restrictOnDelete();
            $table->unsignedBigInteger('loker_id');
            $table->foreign('loker_id')->references('id')->on('lokers')->restrictOnDelete();
            $table->string('score_similarity');
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
