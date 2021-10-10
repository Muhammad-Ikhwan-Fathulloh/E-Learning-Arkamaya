<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputtasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputtasks', function (Blueprint $table) {
            $table->id('id_task');
            $table->integer('id_student')->nullable();
            $table->integer('id_material')->nullable();
            $table->string('title_task')->nullable();
            $table->string('task')->nullable();
            $table->string('description_task')->nullable();
            $table->string('status_task')->nullable();
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
        Schema::dropIfExists('inputtasks');
    }
}
