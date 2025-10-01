<div class="auth-form-section">
    <div class="auth-header">
        <div class="icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1M10 17L6 13L7.41 11.59L10 14.17L16.59 7.58L18 9L10 17Z"/>
            </svg>
        </div>
        <h1>Verify Email</h1>
        <p>Please verify your email address by clicking on the link we just emailed to you.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="text-center text-green-600 text-sm mb-4">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="text-center">
        <button wire:click="sendVerification" class="btn-primary">
            <span>Resend Verification Email</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M2.01 21L23 12 2.01 3 2 10L17 12 2 14 2.01 21Z"/>
            </svg>
        </button>

        <div class="mt-4">
            <button wire:click="logout" class="text-sm text-gray-600 hover:text-gray-800 underline">
                Log out
            </button>
        </div>
    </div>
</div>
