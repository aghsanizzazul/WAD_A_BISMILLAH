<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('attendances')) {
            Schema::create('attendances', function (Blueprint $table) {
                $table->id();
                $table->foreignId('member_id')->constrained()->onDelete('cascade');
                $table->foreignId('class_schedule_id')->constrained()->onDelete('cascade');
                $table->dateTime('check_in_time');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}; 