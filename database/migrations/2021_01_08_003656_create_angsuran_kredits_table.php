<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngsuranKreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angsuran_kredits', function (Blueprint $table) {
            $table->integerIncrements('id_angsuran_kredit');
            $table->unsignedInteger('id_kredit');
            $table->foreign('id_kredit')->references('id_kredit')->on('kredits')->onDelete('cascade');
            $table->char('no_anggota',5);
            $table->foreign('no_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
            $table->date('tgl');
            $table->char('data_kredit');
            $table->integer('jumlah_angsuran');
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
        Schema::dropIfExists('angsuran_kredits');
    }
}
