<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'description',
        'metadata',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function log($userId, $type, $title, $description = null, $metadata = [])
    {
        return self::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'description' => $description,
            'metadata' => $metadata,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    public function getDeviceInfoAttribute()
    {
        $userAgent = $this->user_agent;
        
        if (str_contains($userAgent, 'Mobile')) {
            return '📱 Telefon';
        } elseif (str_contains($userAgent, 'Tablet')) {
            return '📱 Tablet';
        } elseif (str_contains($userAgent, 'Windows')) {
            return '💻 Windows';
        } elseif (str_contains($userAgent, 'Mac')) {
            return '💻 Mac';
        } elseif (str_contains($userAgent, 'Linux')) {
            return '💻 Linux';
        } else {
            return '💻 Komputer';
        }
    }

    public function getTypeIconAttribute()
    {
        return match($this->type) {
            'login' => '🔐',
            'label_created' => '🏷️',
            'label_updated' => '✏️',
            'profile_updated' => '👤',
            'project_created' => '📁',
            'project_updated' => '📝',
            default => '📋'
        };
    }

    public function getTypeColorAttribute()
    {
        return match($this->type) {
            'login' => 'orange',
            'label_created' => 'green',
            'label_updated' => 'blue',
            'profile_updated' => 'purple',
            'project_created' => 'indigo',
            'project_updated' => 'yellow',
            default => 'gray'
        };
    }
}