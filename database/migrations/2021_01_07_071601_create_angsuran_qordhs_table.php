<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngsuranQordhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angsuran_qordhs', function (Blueprint $table) {
            $table->integerIncrements('id_angsuran_qordh');
            $table->unsignedInteger('id_qordh');
            $table->foreign('id_qordh')->references('id_qordh')->on('qordhs')->onDelete('cascade');
            $table->char('no_anggota',5);
            $table->foreign('no_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
            $table->date('tgl');
            $table->char('data_qordh');
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
        Schema::dropIfExists('angsuran_qordhs');
    }
}
