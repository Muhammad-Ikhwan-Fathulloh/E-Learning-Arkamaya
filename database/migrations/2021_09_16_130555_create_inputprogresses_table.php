<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputprogressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputprogresses', function (Blueprint $table) {
            $table->id('id_progress');
            $table->integer('id_mentor');
            $table->integer('id_student');
            $table->integer('id_material')->nullable();
            $table->integer('score_material')->nullable();
            $table->string('description_progress')->nullable();
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
        Schema::dropIfExists('inputprogresses');
    }
}
