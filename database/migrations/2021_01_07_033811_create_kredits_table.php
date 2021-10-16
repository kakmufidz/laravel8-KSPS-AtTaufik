<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kredits', function (Blueprint $table) {
            $table->integerIncrements('id_kredit');
            $table->char('no_anggota',5);
            $table->foreign('no_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
            $table->date('tgl');
            $table->char('nama_barang',50);
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('total_harga');
            $table->integer('maximal_angsuran');
            $table->integer('lama_angsuran');
            $table->date('jatuh_tempo');
            $table->integer('total_kredit');
            $table->char('surat_kredit',50)->nullable();
            $table->integer('prosentase_keuntungankredit');
            $table->integer('prosentase_danacadangan');
            $table->integer('prosentase_danasosial');
            $table->integer('prosentase_shupengurus');
            $table->integer('prosentase_shuanggota');
            $table->integer('masuk_danacadangan');
            $table->integer('masuk_danasosial');
            $table->integer('masuk_shupengurus');
            $table->integer('masuk_shuanggota');
            $table->integer('sisa_kredit');
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
        Schema::dropIfExists('kredits');
    }
}
