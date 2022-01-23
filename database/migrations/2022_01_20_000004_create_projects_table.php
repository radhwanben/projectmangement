<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('categorie')->nullable();
            $table->date('deadline');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}