<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTacheUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('tache_user', function (Blueprint $table) {
            $table->unsignedBigInteger('tache_id');
            $table->foreign('tache_id', 'tache_id_fk_5821551')->references('id')->on('taches')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_5821551')->references('id')->on('users')->onDelete('cascade');
        });
    }
}