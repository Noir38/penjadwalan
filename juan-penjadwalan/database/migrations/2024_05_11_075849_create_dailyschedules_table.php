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
        Schema::create('dailyschedules', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->index();
            $table->string('matakuliah', 255);
            $table->string('sks', 10);
            $table->string('nama_kelas', 100);
            $table->string('hari', 20);
            $table->string('jam', 20);
            $table->string('ruang', 100);
            $table->string('pengampu1', 100)->nullable();
            $table->string('pengampu2', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dailyschedules');
    }
};
