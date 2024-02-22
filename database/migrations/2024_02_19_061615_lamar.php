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
        Schema::create('lamars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loker_id');
            $table->string('resume');
            $table->enum('status',['diterima', 'tolak', 'pending'])->default('pending');
            $table->foreign('loker_id')->references('id')->on('lokers')->restrictOnDelete();
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
        Schema::dropIfExists('lamars');
    }
};