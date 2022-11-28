<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeojsonPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geojson_properties', function (Blueprint $table) {
            $table->integer('prop_id')->primary()->autoIncrement();
            $table->integer('geojson_id');
            $table->string('table_key');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geojson_properties');
    }
}
