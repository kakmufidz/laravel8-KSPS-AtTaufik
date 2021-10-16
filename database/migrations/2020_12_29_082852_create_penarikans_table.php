<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenarikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penarikans', function (Blueprint $table) {
            $table->integerIncrements('id_penarikan');
            $table->char('no_anggota',5);
            $table->foreign('no_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
            $table->date('tgl');
            $table->char('jenis_penarikan',50);
            $table->integer('jumlah');
            $table->string('catatan',500);
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
        Schema::dropIfExists('penarikans');
    }
}
