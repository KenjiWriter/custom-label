<x-layouts.head :title="$title" />

<x-layouts.header />

<!-- Main Content -->
<main class="min-h-screen">
    <div class="{{ $containerClass ?? 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8' }}">
        {{ $slot }}
    </div>
</main>

<x-layouts.footer />

@livewireScripts
@stack('scripts')
</body>
</html>
