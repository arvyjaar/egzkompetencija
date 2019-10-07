<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('monitoringreport_id')->nullable();
            $table->foreign('monitoringreport_id')->references('id')->on('monitoring_reports')->onDelete('cascade');

            $table->unsignedInteger('criterion_id')->nullable();
            $table->foreign('criterion_id')->references('id')->on('criteria');

            $table->unsignedInteger('point_id')->nullable();
            $table->foreign('point_id')->references('id')->on('points');

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
        Schema::dropIfExists('evaluations');
    }
}
