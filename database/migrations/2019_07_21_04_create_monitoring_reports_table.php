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
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_173104')->references('id')->on('users');
            $table->unsignedInteger('observer_id');
            $table->foreign('user_id', 'user_fk_1731040')->references('id')->on('users');
            $table->string('branch');
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
