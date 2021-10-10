<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialaccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materialaccesses', function (Blueprint $table) {
            $table->id('id_material');
            $table->integer('id_mentor');
            $table->string('title')->nullable();
            $table->string('id_category')->nullable();
            $table->string('date')->nullable();
            $table->string('material')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('materialaccesses');
    }
}
