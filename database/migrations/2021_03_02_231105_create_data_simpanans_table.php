<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_simpanans', function (Blueprint $table) {
            $table->integerIncrements('id_jumlah');
            $table->char('id_anggota');
            $table->foreign('id_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
            $table->char('id_simpanan');
            $table->unsignedInteger('id_jenis');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_simpanans')->onDelete('cascade');
            $table->date('tgl');
            $table->string('kategori');
            $table->string('jumlah_simpanan');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_simpanans');
    }
}
