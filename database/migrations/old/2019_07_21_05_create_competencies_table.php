<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('monitoringreport_id')->nullable();
            $table->foreign('monitoringreport_id', 'fk_report_report_000')->references('id')->on('monitoring_reports');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id', 'fk_report_criterion_000')->references('id')->on('categories');
            $table->longText('note')->nullable();
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
