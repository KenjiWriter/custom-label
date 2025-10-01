<div>
    <div class="auth-header">
        <div class="icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M15 12C17.21 12 19 10.21 19 8C19 5.79 17.21 4 15 4C12.79 4 11 5.79 11 8C11 10.21 12.79 12 15 12ZM6 10V7H4V10H1V12H4V15H6V12H9V10H6ZM15 14C12.33 14 7 15.34 7 18V20H23V18C23 15.34 17.67 14 15 14Z"/>
            </svg>
        </div>
        <h1>Welcome Back</h1>
        <p>Access your account to manage payments, view transactions, and enjoy seamless financial experiences.</p>
    </div>

    <div class="auth-tabs">
        <a href="<?php echo e(route('login')); ?>" wire:navigate class="auth-tab">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z"/>
            </svg>
            Login
        </a>
        <div class="auth-tab active">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M15 12C17.21 12 19 10.21 19 8C19 5.79 17.21 4 15 4C12.79 4 11 5.79 11 8C11 10.21 12.79 12 15 12ZM6 10V7H4V10H1V12H4V15H6V12H9V10H6ZM15 14C12.33 14 7 15.34 7 18V20H23V18C23 15.34 17.67 14 15 14Z"/>
            </svg>
            Register
        </div>
    </div>

    <div class="form-section">
        <h2>Create Your Account</h2>
        <p>Enter your details below to create your account and get started.</p>

        <!-- Session Status -->
        <!--[if BLOCK]><![endif]--><?php if(session('status')): ?>
            <div class="text-center text-green-600 text-sm mb-4">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <form method="POST" wire:submit="register">
            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input
                    id="name"
                    wire:model="name"
                    type="text"
                    class="form-input"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Enter your full name"
                />
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-sm mt-1"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input
                    id="email"
                    wire:model="email"
                    type="email"
                    class="form-input"
                    required
                    autocomplete="email"
                    placeholder="Enter your email address"
                />
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-sm mt-1"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input
                    id="password"
                    wire:model="password"
                    type="password"
                    class="form-input"
                    required
                    autocomplete="new-password"
                    placeholder="Create a strong password"
                />
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-sm mt-1"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input
                    id="password_confirmation"
                    wire:model="password_confirmation"
                    type="password"
                    class="form-input"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                />
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-sm mt-1"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <button type="submit" class="btn-primary">
                <span>Create Account</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8.59 16.59L13.17 12L8.59 7.41L10 6L16 12L10 18L8.59 16.59Z"/>
                </svg>
            </button>
        </form>

        <div class="divider">
            <span>Or continue with</span>
        </div>

        <div class="social-buttons">
            <a href="<?php echo e(route('auth.google')); ?>" class="social-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Google
            </a>
            <a href="<?php echo e(route('auth.microsoft')); ?>" class="social-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11.4 24H0V12.6h11.4V24zM24 24H12.6V12.6H24V24zM11.4 11.4H0V0h11.4v11.4zM24 11.4H12.6V0H24v11.4z"/>
                </svg>
                Microsoft
            </a>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\custom-label\resources\views/livewire/auth/register.blade.php ENDPATH**/ ?>