<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemasukanKoperasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukan_koperasis', function (Blueprint $table) {
            $table->integerIncrements('id_pemasukan');
            $table->date('tgl');
            $table->char('jenis_pemasukan',50);
            $table->char('pemasukan',50);
            $table->integer('jumlah');
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
        Schema::dropIfExists('pemasukan_koperasis');
    }
}
