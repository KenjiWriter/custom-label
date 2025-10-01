<div class="auth-form-section">
    <div class="auth-header">
        <div class="icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1M10 17L6 13L7.41 11.59L10 14.17L16.59 7.58L18 9L10 17Z"/>
            </svg>
        </div>
        <h1>Reset Password</h1>
        <p>Please enter your new password below</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="text-center text-green-600 text-sm mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" wire:submit="resetPassword">
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input
                id="email"
                type="email"
                wire:model="email"
                class="form-input"
                required
                autocomplete="email"
            />
            @error('email')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input
                id="password"
                type="password"
                wire:model="password"
                class="form-input"
                placeholder="Password"
                required
                autocomplete="new-password"
            />
            @error('password')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input
                id="password_confirmation"
                type="password"
                wire:model="password_confirmation"
                class="form-input"
                placeholder="Confirm password"
                required
                autocomplete="new-password"
            />
            @error('password_confirmation')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-primary">
            <span>Reset Password</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M8.59 16.59L13.17 12L8.59 7.41L10 6L16 12L10 18L8.59 16.59Z"/>
            </svg>
        </button>
    </form>
</div>
