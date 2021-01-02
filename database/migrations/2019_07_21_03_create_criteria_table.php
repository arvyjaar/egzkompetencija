<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriaTable extends Migration
{
    public function up()
    {
        Schema::create('criteria', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('competency_id')->constrained();
            $table->foreignId('assessment_type_id')->constrained('assessment_types');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
