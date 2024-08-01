<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login')->unique()->nullable();
            $table->string('nickname')->unique()->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('gender')->default(0)->nullable(); //1-мужской, 2-женский
            $table->timestamp('email_verified_at')->nullable();
            $table->string('img')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('role')->default(0); // 0 - пользователь, 1 - админ, 2 - исполнитель
            $table->string('status')->nullable(); //для исполнителя - "действующий", "ожидающий"
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
