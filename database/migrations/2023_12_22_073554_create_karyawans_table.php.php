<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 10)->unique();
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->date('tanggal_bergabung');
            $table->enum('status', ['Aktif', 'Resigned']);
            $table->string('department');
            $table->string('nomor_hp')->nullable();
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
        Schema::dropIfExists('Karyawan');
    }
};
