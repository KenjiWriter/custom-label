<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class GuestSessionService
{
    /**
     * Get or create guest session ID
     */
    public function getGuestSessionId(): string
    {
        $sessionId = Session::get('guest_session_id');
        
        if (!$sessionId) {
            $sessionId = 'guest_' . Str::uuid();
            Session::put('guest_session_id', $sessionId);
        }
        
        return $sessionId;
    }

    /**
     * Get user identifier (user_id or session_id)
     */
    public function getUserIdentifier(): array
    {
        if (auth()->check()) {
            return [
                'user_id' => auth()->id(),
                'session_id' => null
            ];
        }
        
        return [
            'user_id' => null,
            'session_id' => $this->getGuestSessionId()
        ];
    }

    /**
     * Clear guest session
     */
    public function clearGuestSession(): void
    {
        Session::forget('guest_session_id');
    }
}