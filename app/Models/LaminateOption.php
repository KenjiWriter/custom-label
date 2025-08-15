<?php

namespace App\Models;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaminateOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_multiplier',
        'finish_type',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price_multiplier' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get label projects using this laminate option
     */
    public function labelProjects(): HasMany
    {
        return $this->hasMany(LabelProject::class);
    }

    /**
     * Scope for active laminate options
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
return new class extends Migration
{
    public function up()
    {
        Schema::table('laminate_options', function (Blueprint $table) {
            $table->string('texture_image_path')->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('laminate_options', function (Blueprint $table) {
            $table->dropColumn('texture_image_path');
        });
    }
};
