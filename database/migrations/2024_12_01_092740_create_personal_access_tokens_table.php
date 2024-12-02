<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayanansTable extends Migration
{
    public function up()
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();  // Primary key ID
            $table->string('class_name');
            $table->string('time_start');
            $table->string('time_end');
            $table->string('duration');
            $table->string('burned_calories');
            $table->string('instructor');
            $table->float('rating', 8, 2);
            $table->integer('reviews')->default(0);
            $table->text('description');
            $table->string('state')->default('available');
            $table->string('image_path')->nullable();
            $table->time('reminder_time');
            $table->integer('available_slots')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('layanans');
    }
}
