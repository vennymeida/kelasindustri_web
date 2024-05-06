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
        Schema::create('rekomendasis_lulusan', function (Blueprint $table) {
            $table->id();
            $table->integer('document_id');
            $table->string('word');
            $table->double('tf_value')->nullable();
            $table->double('tfidf_value')->nullable();
            $table->enum('document_type', ['lulusan', 'loker']);
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
        Schema::dropIfExists('rekomendasis');
    }
};
