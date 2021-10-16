<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngsuranMudorobahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angsuran_mudorobahs', function (Blueprint $table) {
            $table->integerIncrements('id_angsuran_mudorobah');
            $table->unsignedInteger('id_mudorobah');
            $table->foreign('id_mudorobah')->references('id_mudorobah')->on('mudorobahs')->onDelete('cascade');
            $table->char('no_anggota',5);
            $table->foreign('no_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
            $table->date('tgl');
            $table->char('data_mudorobah');
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
        Schema::dropIfExists('angsuran_mudorobahs');
    }
}
