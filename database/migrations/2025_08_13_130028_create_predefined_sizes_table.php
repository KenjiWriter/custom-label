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
        Schema::create('predefined_sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // e.g., "Business Card", "Round Small"
            $table->unsignedInteger('width_mm');
            $table->unsignedInteger('height_mm');
            $table->foreignId('label_shape_id')->constrained('label_shapes')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['label_shape_id', 'is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predefined_sizes');
    }
};