<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sprints', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('backlog_id')->unsigned();
            $table->foreign('backlog_id')->references('id')->on('backlogs')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');  
            $table->date('fechainicio')->nullable();
            $table->date('fechafin')->addDays(14);
            $table->string('estado');
            $table->integer('numero');
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
        Schema::dropIfExists('sprints');
    }
};
