<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('label_projects', function (Blueprint $table) {
            $table->float('image_position_x')->default(50)->after('artwork_file_path')->nullable();
            $table->float('image_position_y')->default(50)->after('image_position_x')->nullable();
            $table->float('image_scale')->default(100)->after('image_position_y')->nullable();
            $table->float('image_rotation')->default(0)->after('image_scale')->nullable();
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'image_position_x',
                'image_position_y',
                'image_scale',
                'image_rotation'
            ]);
        });
    }
};
