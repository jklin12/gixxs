<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /* Schema::create('menus', function (Blueprint $table) {
            $table->integer('menu_id')->autoIncrement();
            $table->integer('menu_order')->nullable();
            $table->string('menu_name')->nullable();
            $table->tinyInteger('menu_show')->default(0)->nullable();
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
        //Schema::dropIfExists('menus');
    }
}
