<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('m_user', function (Blueprint $table) {
            $table->integer('user_id')->autoIncrement()->primary();
            $table->integer('level_id'); // FK ke m_level
            $table->string('username', 20);
            $table->string('nama', 100);
            $table->string('password', 255);
            $table->string('email', 100)->unique();
            $table->timestamps();

            $table->foreign('level_id')->references('level_id')->on('m_level');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_user');
    }
};