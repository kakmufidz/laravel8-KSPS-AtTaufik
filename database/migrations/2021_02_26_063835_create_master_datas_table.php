<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_datas', function (Blueprint $table) {
            $table->id();
            $table->integer('qordh');
            $table->integer('prosentase_keuntungan');
            $table->integer('prosentase_danacadangan');
            $table->integer('prosentase_danasosial');
            $table->integer('prosentase_shupengurus');
            $table->integer('prosentase_shuanggota');
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
        Schema::dropIfExists('master_datas');
    }
}
