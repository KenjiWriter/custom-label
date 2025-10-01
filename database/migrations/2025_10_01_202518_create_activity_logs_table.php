<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'login', 'label_created', 'label_updated', 'profile_updated', 'project_created', 'project_updated'
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('metadata')->nullable(); // device info, project details, etc.
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'type']);
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_logs');
    }
};