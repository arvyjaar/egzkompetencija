<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('username', 10)->nullable();
                $table->string('name', 30);
                $table->string('email');
                $table->foreignId('branch_id')->constrained();
                $table->dateTime('email_verified_at')->nullable();
                $table->string('password');
                $table->string('remember_token')->nullable();
                $table->timestamps();
                $table->softDeletes();
        });
    }
}
