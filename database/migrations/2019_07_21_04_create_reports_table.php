<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->nullable;
            $table->foreignId('employee_id')->constrained('users');
            $table->foreignId('observer_id')->constrained('users');
            $table->dateTime('procedure_date');
            $table->foreignId('drivecategory_id')->nullable()->constrained();
            $table->date('observing_date');
            $table->foreignId('observing_type_id')->constrained('observing_types');
            $table->longText('technical_note')->nullable();
            $table->longText('observer_note')->nullable();
            $table->longText('employee_note')->nullable();
            $table->dateTime('employee_reviewed_at')->nullable();
            $table->longText('manager_note')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
