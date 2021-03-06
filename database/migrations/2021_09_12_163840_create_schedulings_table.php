<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedulings', function (Blueprint $table) {
            $table->id('id_schedule');
            $table->integer('id_material')->nullable();
            $table->integer('id_mentor');
            $table->string('schedule')->nullable();
            $table->string('start_date')->nullable();
            $table->string('finish_date')->nullable();
            $table->string('description_schedule')->nullable();
            $table->string('publish')->nullable();
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
        Schema::dropIfExists('schedulings');
    }
}
