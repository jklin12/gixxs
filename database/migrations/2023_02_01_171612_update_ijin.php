<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIjin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ijin_lingkungans', function($table) {
            $table->date('il_exp_date')->nullable()->after('il_file');
        });

        Schema::table('kawasan_ekosistem_esensials', function($table) {
            $table->date('kes_exp_date')->nullable()->after('kes_file');;
        });
        Schema::table('dokumen_kajian_lingkungans', function($table) {
            $table->date('dkl_exp_date')->nullable()->after('dkl_file');;
        });
        Schema::table('sppls', function($table) {
            $table->date('sppl_exp_date')->nullable()->after('sppl_file');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
