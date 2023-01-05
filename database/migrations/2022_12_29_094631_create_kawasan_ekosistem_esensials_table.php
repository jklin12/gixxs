<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKawasanEkosistemEsensialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kawasan_ekosistem_esensials', function (Blueprint $table) {
            $table->id('kes_id');
            $table->string('kes_nama');
            $table->text('kes_file');
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
        Schema::dropIfExists('kawasan_ekosistem_esensials');
    }
}
