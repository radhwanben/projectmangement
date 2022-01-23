<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTachePivotTable extends Migration
{
    public function up()
    {
        Schema::create('project_tache', function (Blueprint $table) {
            $table->unsignedBigInteger('tache_id');
            $table->foreign('tache_id', 'tache_id_fk_5822971')->references('id')->on('taches')->onDelete('cascade');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id', 'project_id_fk_5822971')->references('id')->on('projects')->onDelete('cascade');
        });
    }
}