<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayananTable extends Migration
{
    public function up()
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');
            $table->string('time_start');
            $table->string('time_end');
            $table->string('duration');
            $table->string('burned_calories');
            $table->string('instructor');
            $table->decimal('rating', 2, 1);
            $table->integer('reviews');
            $table->text('description');
            $table->enum('state', ['available', 'unavailable']);
            $table->string('image_path');
            $table->string('reminder_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('layanan');
    }
}
