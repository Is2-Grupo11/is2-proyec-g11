<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backlog_project', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('backlog_id')->unsigned();
            $table->foreign('backlog_id')->references('id')->on('backlogs');

            $table->integer('projectb_id')->unsigned();
            $table->foreign('projectb_id')->references('id')->on('projects');       

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
        Schema::dropIfExists('backlog_project');
    }
};
