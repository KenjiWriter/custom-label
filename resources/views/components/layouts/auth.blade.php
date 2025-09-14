{{-- resources/views/components/layouts/auth.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Welcome Back - Login & Registration' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
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
    {{-- Tutaj będzie renderowany Twój komponent logowania/rejestracji --}}
    {{ $slot }}

    @livewireScripts
    {{-- Alpine.js for tab switching (jeżeli chcesz dynamicznie, tylko raz w layout!) --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
