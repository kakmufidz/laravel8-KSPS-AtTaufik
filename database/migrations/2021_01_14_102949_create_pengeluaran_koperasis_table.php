<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaranKoperasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_koperasis', function (Blueprint $table) {
            $table->integerIncrements('id_pengeluaran');
            $table->date('tgl');
            $table->char('sumber_dana',50);
            $table->char('pengeluaran',50);
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('total_harga');
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
        Schema::dropIfExists('pengeluaran_koperasis');
    }
}
