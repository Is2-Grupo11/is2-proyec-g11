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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('backlog_id')->unsigned();
            $table->foreign('backlog_id')->references('id')->on('backlogs')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('sprint_id')->unsigned();
            $table->foreign('sprint_id')->references('id')->on('sprints')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('board_list_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->double('position');
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
        Schema::dropIfExists('cards');
    }
};
