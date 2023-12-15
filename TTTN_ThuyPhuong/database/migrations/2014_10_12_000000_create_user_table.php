<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('password');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->unsignedInteger('roles')->default(0);
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('update_by')->nullable();
            $table->timestamps();
            $table->unsignedTinyInteger('status')->default(2);
        });
    }
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
