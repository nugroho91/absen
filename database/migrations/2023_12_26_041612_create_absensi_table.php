<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan');
            $table->date('tanggal_absen');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->integer('durasi_kerja')->nullable();
            $table->boolean('telat')->default(false);
            $table->timestamps();

            $table->foreign('id_karyawan')->references('id')->on('karyawan'); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}