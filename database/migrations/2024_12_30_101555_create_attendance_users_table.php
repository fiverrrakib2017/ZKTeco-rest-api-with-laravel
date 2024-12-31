<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_users', function (Blueprint $table) {
            $table->id();
            $table->text('device_ip');
            $table->text('device_name')->nullable();
            $table->integer('uid');
            $table->integer('user_id');
            $table->text('name');
            $table->integer('role');
            $table->text('password');
            $table->text('cardno');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_users');
    }
};
