<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('monitoringreport_id')->nullable();
            $table->foreign('monitoringreport_id', 'fk_note_monitoringreport')->references('id')->on('monitoring_reports');
            $table->unsignedInteger('critcategory_id')->nullable();
            $table->foreign('critcategory_id', 'fk_note_critcategory')->references('id')->on('critcategories');
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
        Schema::dropIfExists('notes');
    }
}
