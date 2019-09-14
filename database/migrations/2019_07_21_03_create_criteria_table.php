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
            $table->unsignedInteger('critcategory_id')->nullable();
            $table->foreign('critcategory_id')->references('id')->on('critcategories');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
