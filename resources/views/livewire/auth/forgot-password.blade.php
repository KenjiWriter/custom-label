<div class="auth-form-section">
    <div class="auth-header">
        <div class="icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1M10 17L6 13L7.41 11.59L10 14.17L16.59 7.58L18 9L10 17Z"/>
            </svg>
        </div>
        <h1>Forgot Password</h1>
        <p>Enter your email to receive a password reset link</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="text-center text-green-600 text-sm mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" wire:submit="sendPasswordResetLink">
        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input
                id="email"
                type="email"
                wire:model="email"
                class="form-input"
                placeholder="email@example.com"
                required
                autofocus
            />
            @error('email')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-primary">
            <span>Send Reset Link</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M2.01 21L23 12 2.01 3 2 10L17 12 2 14 2.01 21Z"/>
            </svg>
        </button>
    </form>

    <div class="text-center text-sm text-gray-600 mt-4">
        <span>Or, return to </span>
        <a href="{{ route('login') }}" class="text-orange-600 hover:text-orange-700 font-medium">log in</a>
    </div>
</div>
