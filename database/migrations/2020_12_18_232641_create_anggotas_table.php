<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {

            $table->integerIncrements('id');
            $table->char('id_anggota',5)->unique();
            $table->date('tgldaftar');
            $table->char('name',50);
            $table->char('tmlahir',20);
            $table->date('tglahir');
            $table->char('alamat',100);
            $table->bigInteger('ktp');
            $table->char('pendidikan',20);
            $table->char('pekerjaan',20);
            $table->char('hp');
            $table->char('image',50)->nullable()->default('avatar1.png');
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
        Schema::dropIfExists('anggotas');
    }
}
