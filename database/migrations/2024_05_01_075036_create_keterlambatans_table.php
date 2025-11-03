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
        Schema::create('keterlambatans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Nisn_siswa');
            $table->date('Tanggal');
            $table->foreignId('jurusan_id')->references('id')->on('jurusan');
            $table->foreignId('kelas_id')->references('id')->on('kelas');
            $table->integer('Telat')->default(1);
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
        Schema::dropIfExists('keterlambatans');
    }
};
