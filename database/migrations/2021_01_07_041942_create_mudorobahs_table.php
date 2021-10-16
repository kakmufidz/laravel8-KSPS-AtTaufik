<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMudorobahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mudorobahs', function (Blueprint $table) {
            $table->integerIncrements('id_mudorobah');
            $table->char('no_anggota',5);
            $table->foreign('no_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
            $table->date('tgl');
            $table->char('jenis_usaha',5);
            $table->integer('jumlah');
            $table->integer('bagi_hasil');
            $table->char('berakhir',255);
            $table->char('penanggungjawab',50);
            $table->char('saksi',50);
            $table->integer('sisa_hutang');
            $table->char('surat_mudorobah',50)->nullable();
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
        Schema::dropIfExists('mudorobahs');
    }
}
