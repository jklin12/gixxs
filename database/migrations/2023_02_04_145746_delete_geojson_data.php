<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteGeojsonData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geojson', function (Blueprint $table) {
            $table->integer('geojson_id')->autoIncrement();
            $table->integer('category');
            $table->string('geojson_name');
            $table->string('geojson_color')->nullable();
            $table->double('geojson_opacity')->nullable();
            $table->text('geojson_file')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        //
    }
}
