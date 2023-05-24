<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama');
            $table->string('email');
            $table->double('xVal');
            $table->double('yVal');
            $table->double('zVal');
            $table->double('wVal');
            $table->double('aspek_intelegensi');
            $table->double('aspek_numerical_ability');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
