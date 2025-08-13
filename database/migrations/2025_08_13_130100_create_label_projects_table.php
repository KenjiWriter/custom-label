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
        Schema::create('label_projects', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); // Public identifier
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('session_id', 255)->nullable(); // For guest users
            
            // Label configuration
            $table->foreignId('label_shape_id')->constrained('label_shapes');
            $table->foreignId('label_material_id')->constrained('label_materials');
            $table->foreignId('laminate_option_id')->nullable()->constrained('laminate_options')->onDelete('set null');
            $table->foreignId('predefined_size_id')->nullable()->constrained('predefined_sizes')->onDelete('set null');
            
            // Custom dimensions (if not using predefined size)
            $table->unsignedInteger('custom_width_mm')->nullable();
            $table->unsignedInteger('custom_height_mm')->nullable();
            
            // Order details
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('calculated_price', 10, 2)->nullable();
            
            // File uploads
            $table->string('artwork_file_path')->nullable();
            $table->string('artwork_file_name')->nullable();
            $table->unsignedBigInteger('artwork_file_size')->nullable();
            
            // Project status
            $table->enum('status', ['draft', 'configured', 'ordered', 'completed'])->default('draft');
            
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['session_id', 'status']);
            $table->index(['uuid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_projects');
    }
};