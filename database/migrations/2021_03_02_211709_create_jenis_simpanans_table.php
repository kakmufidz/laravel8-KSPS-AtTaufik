<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisSimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_simpanans', function (Blueprint $table) {
            $table->integerIncrements('id_jenis');
            $table->string('jenis_dana');
            $table->string('kode_jenis')->unique();
            $table->string('kategori')->unique();
            $table->string('minimal');
            $table->string('maksimal');
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
        Schema::dropIfExists('jenis_simpanans');
    }
}
