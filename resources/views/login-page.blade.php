<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Welcome Back - Logowanie i Rejestracja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fff7ed 0%, #fef6f0 100%);
            min-height: 100vh;
        }
        .card {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }
        .btn-orange {
            background: linear-gradient(90deg, #ff9800 0%, #ff7300 100%);
            color: #fff;
        }
        .btn-orange:hover {
            background: linear-gradient(90deg, #ff7300 0%, #ff9800 100%);
        }
        .icon-box {
            background: #fff7ed;
            box-shadow: 0 2px 8px 0 rgba(255, 152, 0, 0.08);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="flex flex-col md:flex-row items-center justify-center gap-10 w-full max-w-5xl mx-auto px-4 py-12">
        <!-- Left: Login/Register -->
        <div class="w-full md:w-1/2 flex flex-col gap-8">
            <div class="flex flex-col items-center mb-6">
                <div class="icon-box rounded-full w-14 h-14 flex items-center justify-center mb-3">
                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="4" stroke-width="2"/>
                        <path stroke-width="2" d="M6 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-1">Welcome Back</h1>
                <p class="text-gray-500 text-center max-w-md">Access your account to manage payments, view transactions, and enjoy seamless financial experiences</p>
            </div>
            <div x-data="{ tab: '{{ request()->routeIs('register') ? 'register' : 'login' }}' }" class="w-full">
                <div class="flex justify-center mb-6 gap-2">
                    <button :class="tab === 'login' ? 'btn-orange px-6 py-2 rounded-xl font-semibold shadow' : 'bg-white px-6 py-2 rounded-xl font-semibold text-gray-700 border border-gray-200'" @click="tab = 'login'">Login</button>
                    <button :class="tab === 'register' ? 'btn-orange px-6 py-2 rounded-xl font-semibold shadow' : 'bg-white px-6 py-2 rounded-xl font-semibold text-gray-700 border border-gray-200'" @click="tab = 'register'">Register</button>
                </div>
                <!-- Login Form -->
                <form x-show="tab === 'login'" method="POST" action="{{ route('login') }}" class="card bg-white rounded-2xl p-8 space-y-6 shadow transition-all duration-300">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email Address</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-orange-200 focus:border-orange-400" placeholder="Enter your email address">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Password</label>
                        <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-orange-200 focus:border-orange-400" placeholder="Enter your password">
                        <div class="flex justify-end mt-1">
                            <a href="{{ route('password.request') }}" class="text-orange-500 text-sm hover:underline">Forgot password?</a>
                        </div>
                    </div>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember" class="text-gray-600 text-sm">Remember me for 30 days</label>
                    </div>
                    <button type="submit" class="w-full btn-orange py-3 rounded-xl font-semibold text-lg shadow transition-all duration-200 hover:scale-105">Sign In to Account</button>
                    <div class="flex items-center my-4">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="mx-3 text-gray-400 text-sm">Or continue with</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('social.login', 'google') }}" class="flex-1 flex items-center justify-center border border-gray-200 rounded-lg py-2 hover:bg-gray-50">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg" class="w-5 h-5 mr-2"> Google
                        </a>
                        <a href="{{ route('social.login', 'microsoft') }}" class="flex-1 flex items-center justify-center border border-gray-200 rounded-lg py-2 hover:bg-gray-50">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/microsoft/microsoft-original.svg" class="w-5 h-5 mr-2"> Microsoft
                        </a>
                    </div>
                </form>
                <!-- Register Form -->
                <form x-show="tab === 'register'" method="POST" action="{{ route('register') }}" class="card bg-white rounded-2xl p-8 space-y-6 shadow transition-all duration-300">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Full Name</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-orange-200 focus:border-orange-400" placeholder="Enter your full name">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email Address</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-orange-200 focus:border-orange-400" placeholder="Enter your email address">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Password</label>
                        <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-orange-200 focus:border-orange-400" placeholder="Create a password">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" required class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-orange-200 focus:border-orange-400" placeholder="Repeat your password">
                    </div>
                    <button type="submit" class="w-full btn-orange py-3 rounded-xl font-semibold text-lg shadow transition-all duration-200 hover:scale-105">Create Account</button>
                </form>
            </div>
        </div>
        <!-- Right: Secure & Trusted -->
        <div class="w-full md:w-1/2 flex flex-col items-center justify-center">
            <div class="card bg-white rounded-2xl p-8 shadow-lg w-full max-w-md">
                <div class="flex flex-col items-center mb-4">
                    <div class="icon-box rounded-full w-14 h-14 flex items-center justify-center mb-3">
                        <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 4a2 2 0 110 4 2 2 0 010-4zm0 14a8 8 0 01-6.32-3.16c.03-2.53 5.05-3.92 6.32-3.92s6.29 1.39 6.32 3.92A8 8 0 0112 20z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Secure & Trusted</h2>
                    <p class="text-gray-500 text-center mb-4">Your financial data is protected with bank-level security and encryption</p>
                </div>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-center gap-3">
                        <span class="inline-block w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </span>
                        <span class="text-gray-700 font-medium">256-bit SSL Encryption</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="inline-block w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke-width="2"/>
                                <path stroke-width="2" d="M12 6v6l4 2"/>
                            </svg>
                        </span>
                        <span class="text-gray-700 font-medium">24/7 Monitoring</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="inline-block w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M17 8V6a5 5 0 00-10 0v2a5 5 0 00-2 4v5a2 2 0 002 2h10a2 2 0 002-2v-5a5 5 0 00-2-4z"/>
                            </svg>
                        </span>
                        <span class="text-gray-700 font-medium">Trusted by 50,000+</span>
                    </li>
                </ul>
                <div class="bg-orange-50 rounded-xl p-4 flex items-center gap-3">
                    <div>
                        <span class="block text-yellow-500 text-xl">★★★★★</span>
                        <p class="text-gray-700 text-sm mt-1">
                            “PayFlow made managing my business payments incredibly simple. The interface is intuitive and the security gives me peace of mind.”
                        </p>
                        <span class="block text-xs text-gray-500 mt-2">Sarah Johnson • Small Business Owner</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Alpine.js for tab switching -->
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
