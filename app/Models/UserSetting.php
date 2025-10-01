<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'language',
        'timezone',
        'theme',
        'notifications',
    ];

    protected $casts = [
        'notifications' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getForUser($userId)
    {
        return self::firstOrCreate(
            ['user_id' => $userId],
            [
                'language' => 'pl',
                'timezone' => 'Europe/Warsaw',
                'theme' => 'light',
                'notifications' => [
                    'email' => true,
                    'projects' => true,
                    'updates' => false,
                ]
            ]
        );
    }
}