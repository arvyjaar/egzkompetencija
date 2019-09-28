<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitoringreportCriterionPointPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoringreport_criterion_point_pivot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('monitoringreport_id')->nullable();
            $table->foreign('monitoringreport_id', 'fk_report_report_000')->references('id')->on('monitoring_reports');
            $table->unsignedInteger('criterion_id')->nullable();
            $table->foreign('criterion_id', 'fk_report_criterion_000')->references('id')->on('criteria');
            $table->unsignedInteger('point_id')->nullable();
            $table->foreign('point_id', 'fk_report_point_000')->references('id')->on('points');
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
        Schema::dropIfExists('monitoringreport_criterion_point_pivot');
    }
}
