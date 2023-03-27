<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_menus', function (Blueprint $table) {
            $table->id('file_menu_id');
            $table->string('file_menu_title');
            $table->string('file_menu_file');
            $table->tinyInteger('file_menu_display');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_menus');
    }
}
