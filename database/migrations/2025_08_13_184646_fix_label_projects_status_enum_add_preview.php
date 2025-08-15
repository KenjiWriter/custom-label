<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Zmień ENUM na VARCHAR żeby pomieścić 'preview'
        DB::statement("ALTER TABLE label_projects MODIFY COLUMN status VARCHAR(20) DEFAULT 'draft'");
    }

    public function down()
    {
        // Powrót do ENUM (opcjonalnie)
        DB::statement("ALTER TABLE label_projects MODIFY COLUMN status ENUM('draft', 'active', 'preview') DEFAULT 'draft'");
    }
};
