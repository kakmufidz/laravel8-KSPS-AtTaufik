<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuntunganMudorobahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keuntungan_mudorobahs', function (Blueprint $table) {
            $table->integerIncrements('id_keuntungan');
            $table->unsignedInteger('id_mudorobah');
            $table->foreign('id_mudorobah')->references('id_mudorobah')->on('mudorobahs')->onDelete('cascade');
            $table->char('no_anggota',5);
            $table->foreign('no_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
            $table->date('tgl');
            $table->char('data_mudorobah');
            $table->integer('laba_usaha');
            $table->integer('jumlah');
            $table->integer('prosentase_danacadangan');
            $table->integer('prosentase_danasosial');
            $table->integer('prosentase_shupengurus');
            $table->integer('prosentase_shuanggota');
            $table->integer('masuk_danacadangan');
            $table->integer('masuk_danasosial');
            $table->integer('masuk_shupengurus');
            $table->integer('masuk_shuanggota');
            $table->string('keterangan',500);
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
        Schema::dropIfExists('keuntungan_mudorobahs');
    }
}
