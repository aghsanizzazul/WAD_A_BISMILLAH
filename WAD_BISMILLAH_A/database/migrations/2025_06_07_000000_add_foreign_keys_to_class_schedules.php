<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->foreign('trainer_id')
                  ->references('id')
                  ->on('pelatih')
                  ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->dropForeign(['trainer_id']);
        });
    }
}; 