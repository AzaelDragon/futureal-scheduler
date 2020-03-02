<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('schedules', function (Blueprint $table) {

            $table -> bigIncrements('id');
            $table -> date('date');
            $table -> unsignedBigInteger('block');
            $table -> unsignedBigInteger('class');
            $table -> unsignedBigInteger('room');
            $table -> unsignedBigInteger('user');
            $table -> timestamps();

            $table -> foreign('block') -> references('id') -> on('blocks');
            $table -> foreign('class') -> references('id') -> on('classes');
            $table -> foreign('room') -> references('id') -> on('rooms');
            $table -> foreign('user') -> references('id') -> on('users');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('schedules');

    }

}
