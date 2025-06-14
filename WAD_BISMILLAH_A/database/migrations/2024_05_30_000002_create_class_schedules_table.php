<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('class_schedules')) {
            Schema::create('class_schedules', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->unsignedBigInteger('trainer_id');
                $table->integer('capacity');
                $table->date('schedule_date');
                $table->time('start_time');
                $table->time('end_time');
                $table->string('room');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('class_schedules');
    }
}; 