<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('language')->default('pl');
            $table->string('timezone')->default('Europe/Warsaw');
            $table->string('theme')->default('light'); // light, dark, gradient
            $table->json('notifications')->nullable(); // email settings, etc.
            $table->timestamps();
            
            $table->unique('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_settings');
    }
};