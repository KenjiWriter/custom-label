<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('laminate_options', function (Blueprint $table) {
            $table->string('texture_image_path')->nullable()->after('price_multiplier');
        });
    }

    public function down()
    {
        Schema::table('laminate_options', function (Blueprint $table) {
            $table->dropColumn('texture_image_path');
        });
    }
};