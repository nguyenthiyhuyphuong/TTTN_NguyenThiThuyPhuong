<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->id();
            $table->string('author');
            $table->string('email');
            $table->string('phone');
            $table->string('zalo');
            $table->string('address');
            $table->string('facebook');
            $table->string('metadesc');
            $table->string('metakey');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('update_by');
            $table->timestamps();
            $table->unsignedTinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config');
    }
}
