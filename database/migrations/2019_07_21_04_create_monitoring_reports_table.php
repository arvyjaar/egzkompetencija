<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringReportsTable extends Migration
{
    public function up()
    {
        Schema::create('monitoring_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('examiner_id');
            $table->foreign('examiner_id', 'examiner_fk_173104')->references('id')->on('users');
            $table->unsignedInteger('observer_id');
            $table->foreign('observer_id', 'observer_fk_1731040')->references('id')->on('users');
            $table->unsignedInteger('branch_id');
            $table->foreign('branch_id', 'branch_fk_1731040')->references('id')->on('branches');
            $table->dateTime('exam_date');
            $table->string('category');
            $table->date('observing_date');
            $table->string('observing_type');
            $table->longText('technical_notes')->nullable();
            $table->longText('observer_notes')->nullable();
            $table->longText('examiner_notes')->nullable();
            $table->dateTime('examiner_reviewed')->nullable();
            $table->longText('evpis_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
