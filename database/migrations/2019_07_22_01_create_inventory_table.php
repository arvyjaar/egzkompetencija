<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration
{
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tool_id')->nullable();
            $table->foreign('tool_id')->references('id')->on('tools');
            $table->string('condition');
            $table->integer('quantity');
            $table->longText('note')->nullable();
            $table->unsignedInteger('branch_id')->nullable;
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
