<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetencynotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencynotes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('monitoringreport_id')->nullable();
            $table->foreign('monitoringreport_id')->references('id')->on('monitoring_reports')->onDelete('cascade');

            $table->unsignedInteger('competency_id')->nullable();
            $table->foreign('competency_id')->references('id')->on('competencies');

            $table->longText('text')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competencynotes');
    }
}
