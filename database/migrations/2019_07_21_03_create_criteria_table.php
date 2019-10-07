<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriaTable extends Migration
{
    public function up()
    {
        Schema::create('criteria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('competency_id')->nullable();
            $table->foreign('competency_id')->references('id')->on('competencies');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
