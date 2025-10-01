<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // SQLite nie obsługuje MODIFY COLUMN, więc używamy Schema::table
        Schema::table('label_projects', function (Blueprint $table) {
            $table->string('status', 20)->default('draft')->change();
        });
    }

    public function down()
    {
        // Powrót do ENUM (opcjonalnie)
        Schema::table('label_projects', function (Blueprint $table) {
            $table->enum('status', ['draft', 'active', 'preview'])->default('draft')->change();
        });
    }
};
