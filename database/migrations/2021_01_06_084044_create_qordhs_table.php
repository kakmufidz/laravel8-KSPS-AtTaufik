<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQordhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qordhs', function (Blueprint $table) {
            $table->integerIncrements('id_qordh');
            $table->char('no_anggota',5);
            $table->foreign('no_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
            $table->date('tgl');
            $table->integer('jumlah');
            $table->integer('lama_angsuran');
            $table->date('jatuh_tempo');
            $table->integer('sisa_qordh');
            $table->char('surat_qordh',50)->nullable();
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
        Schema::dropIfExists('qordhs');
    }
}
