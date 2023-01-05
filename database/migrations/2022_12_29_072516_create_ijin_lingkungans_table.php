<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIjinLingkungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('ijin_lingkungans', function (Blueprint $table) {
            $table->integer('il_id')->primary()->autoIncrement();
            $table->string('il_nama')->nullable();
            $table->string('il_nib')->nullable();
            $table->string('il_jenis_usaha')->nullable();
            $table->string('il_penanggung_jawab')->nullable();
            $table->string('il_jabatan')->nullable();
            $table->text('il_alamat_pusat')->nullable();
            $table->text('il_alamat_perwakilan')->nullable();
            $table->text('il_alamat_cabang')->nullable();
            $table->text('il_lokasi')->nullable();
            $table->text('il_file')->nullable();
            $table->text('il_file_small')->nullable();
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('ijin_lingkungans');
    }
}
