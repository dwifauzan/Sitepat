<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datasiswa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Nisn');
            $table->string('Nama_siswa');
            $table->string('Jenis_kelamin');
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->foreignId('jurusan_id')->constrained('jurusan');
            $table->string('Alamat');
            $table->bigInteger('No_Handphone');
            $table->string('Nama_Ortu_Ayah');
            $table->string('Nama_Ortu_Ibu');
            $table->bigInteger('No_Handphone_Ayah');
            $table->bigInteger('No_Handphone_Ibu');
            $table->integer('Telat')->default(0); // Add 'Telat' column after 'created_at'
            $table->timestamps(); // This adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datasiswa');
    }
};
