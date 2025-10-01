<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'status',
        'settings',
        'preview_image',
        'material',
        'laminate',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'draft' => 'gray',
            'active' => 'green',
            'completed' => 'blue',
            default => 'gray'
        };
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'draft' => 'Szkic',
            'active' => 'Aktywny',
            'completed' => 'Zakończony',
            default => 'Nieznany'
        };
    }
}