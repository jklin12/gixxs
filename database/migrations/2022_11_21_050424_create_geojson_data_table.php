<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeojsonDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geojson_data', function (Blueprint $table) {
            //$table->integer('data_id')->autoIncrement();
            $table->id('data_id');
            $table->integer('geojson_id');
            $table->longText('data_properties');
            $table->longText('data_type');
            $table->longText('data_coordinates');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('geojson_data');
    }
}
