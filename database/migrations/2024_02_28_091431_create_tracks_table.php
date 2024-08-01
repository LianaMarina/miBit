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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->foreignIdFor(App\Models\Genre::class);
            $table->string('img');
            $table->string('song');
            $table->integer('count_listen')->default(0);
            $table->string('status')->nullable()->default('Новый');
            $table->date('date');
            $table->integer('cenz')->default(0); // 0 - не ценз, 1 - не ценз
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
