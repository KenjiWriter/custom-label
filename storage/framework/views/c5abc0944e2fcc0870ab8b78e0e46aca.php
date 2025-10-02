<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? config('app.name', 'Custom Label Creator')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
    
    <!-- Alpine.js x-cloak CSS -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    <!-- Simple Darkness Slider System -->
    <style>
        /* Base theme with darkness control */
        :root {
            --darkness-level: 0;
        }
        
        /* Apply darkness based on slider value */
        body {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
            color: rgb(
                calc(10 + (245 * var(--darkness-level) / 100)),
                calc(14 + (241 * var(--darkness-level) / 100)),
                calc(19 + (236 * var(--darkness-level) / 100))
            ) !important;
            transition: all 0.3s ease;
        }
        
        /* Darken all elements based on darkness level */
        .bg-white {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .bg-gray-50 {
            background: rgb(
                calc(250 - (250 * var(--darkness-level) / 100)),
                calc(251 - (251 * var(--darkness-level) / 100)),
                calc(252 - (252 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .bg-gray-100 {
            background: rgb(
                calc(244 - (244 * var(--darkness-level) / 100)),
                calc(246 - (246 * var(--darkness-level) / 100)),
                calc(248 - (248 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .text-gray-900 {
            color: rgb(
                calc(10 + (245 * var(--darkness-level) / 100)),
                calc(14 + (241 * var(--darkness-level) / 100)),
                calc(19 + (236 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .text-gray-800 {
            color: rgb(
                calc(26 + (229 * var(--darkness-level) / 100)),
                calc(31 + (224 * var(--darkness-level) / 100)),
                calc(46 + (209 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .text-gray-700 {
            color: rgb(
                calc(42 + (213 * var(--darkness-level) / 100)),
                calc(49 + (206 * var(--darkness-level) / 100)),
                calc(66 + (189 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .text-gray-600 {
            color: rgb(
                calc(58 + (197 * var(--darkness-level) / 100)),
                calc(66 + (189 * var(--darkness-level) / 100)),
                calc(86 + (169 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .text-gray-500 {
            color: rgb(
                calc(74 + (181 * var(--darkness-level) / 100)),
                calc(83 + (172 * var(--darkness-level) / 100)),
                calc(106 + (149 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .text-white {
            color: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .border-gray-200 {
            border-color: rgb(
                calc(226 - (226 * var(--darkness-level) / 100)),
                calc(232 - (232 * var(--darkness-level) / 100)),
                calc(240 - (240 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .border-gray-300 {
            border-color: rgb(
                calc(209 - (209 * var(--darkness-level) / 100)),
                calc(213 - (213 * var(--darkness-level) / 100)),
                calc(219 - (219 * var(--darkness-level) / 100))
            ) !important;
        }
        
        /* Override ALL white backgrounds in home page */
        .bg-white {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        /* Override white backgrounds with opacity */
        .bg-white\/10 {
            background: rgba(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                0.1
            ) !important;
        }
        
        .bg-white\/20 {
            background: rgba(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                0.2
            ) !important;
        }
        
        .bg-white\/30 {
            background: rgba(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                0.3
            ) !important;
        }
        
        /* Override all colored backgrounds to be darker */
        .bg-orange-100, .bg-orange-200, .bg-orange-300, .bg-orange-400, .bg-orange-500, .bg-orange-600 {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .bg-yellow-100, .bg-yellow-200, .bg-yellow-300, .bg-yellow-400, .bg-yellow-500, .bg-yellow-600 {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .bg-blue-100, .bg-blue-200, .bg-blue-300, .bg-blue-400, .bg-blue-500, .bg-blue-600 {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .bg-red-100, .bg-red-200, .bg-red-300, .bg-red-400, .bg-red-500, .bg-red-600 {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .bg-green-100, .bg-green-200, .bg-green-300, .bg-green-400, .bg-green-500, .bg-green-600 {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        .bg-purple-100, .bg-purple-200, .bg-purple-300, .bg-purple-400, .bg-purple-500, .bg-purple-600 {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        /* Override all gray backgrounds */
        .bg-gray-100, .bg-gray-200, .bg-gray-300, .bg-gray-400, .bg-gray-500, .bg-gray-600, .bg-gray-700, .bg-gray-800, .bg-gray-900 {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        /* Override all slate backgrounds */
        .bg-slate-100, .bg-slate-200, .bg-slate-300, .bg-slate-400, .bg-slate-500, .bg-slate-600, .bg-slate-700, .bg-slate-800, .bg-slate-900 {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        /* Override all zinc backgrounds */
        .bg-zinc-100, .bg-zinc-200, .bg-zinc-300, .bg-zinc-400, .bg-zinc-500, .bg-zinc-600, .bg-zinc-700, .bg-zinc-800, .bg-zinc-900 {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        /* Override all neutral backgrounds */
        .bg-neutral-100, .bg-neutral-200, .bg-neutral-300, .bg-neutral-400, .bg-neutral-500, .bg-neutral-600, .bg-neutral-700, .bg-neutral-800, .bg-neutral-900 {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        /* Override all stone backgrounds */
        .bg-stone-100, .bg-stone-200, .bg-stone-300, .bg-stone-400, .bg-stone-500, .bg-stone-600, .bg-stone-700, .bg-stone-800, .bg-stone-900 {
            background: rgb(
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100)),
                calc(255 - (255 * var(--darkness-level) / 100))
            ) !important;
        }
        
        /* Override orange gradients to stay orange but darker */
        .bg-gradient-to-r.from-orange-500.via-orange-400.to-orange-600 {
            background: linear-gradient(
                to right,
                rgb(
                    calc(249 - (100 * var(--darkness-level) / 100)),
                    calc(115 - (50 * var(--darkness-level) / 100)),
                    calc(22 - (10 * var(--darkness-level) / 100))
                ),
                rgb(
                    calc(251 - (100 * var(--darkness-level) / 100)),
                    calc(146 - (50 * var(--darkness-level) / 100)),
                    calc(60 - (10 * var(--darkness-level) / 100))
                ),
                rgb(
                    calc(234 - (100 * var(--darkness-level) / 100)),
                    calc(88 - (50 * var(--darkness-level) / 100)),
                    calc(12 - (10 * var(--darkness-level) / 100))
                )
            ) !important;
        }
        
        /* Override all orange gradients */
        .bg-gradient-to-r.from-orange-500 {
            background: linear-gradient(
                to right,
                rgb(
                    calc(249 - (100 * var(--darkness-level) / 100)),
                    calc(115 - (50 * var(--darkness-level) / 100)),
                    calc(22 - (10 * var(--darkness-level) / 100))
                ),
                rgb(
                    calc(251 - (100 * var(--darkness-level) / 100)),
                    calc(146 - (50 * var(--darkness-level) / 100)),
                    calc(60 - (10 * var(--darkness-level) / 100))
                ),
                rgb(
                    calc(234 - (100 * var(--darkness-level) / 100)),
                    calc(88 - (50 * var(--darkness-level) / 100)),
                    calc(12 - (10 * var(--darkness-level) / 100))
                )
            ) !important;
        }
        
        /* Override any gradient with orange colors */
        [class*="from-orange-"] {
            background: linear-gradient(
                to right,
                rgb(
                    calc(249 - (100 * var(--darkness-level) / 100)),
                    calc(115 - (50 * var(--darkness-level) / 100)),
                    calc(22 - (10 * var(--darkness-level) / 100))
                ),
                rgb(
                    calc(251 - (100 * var(--darkness-level) / 100)),
                    calc(146 - (50 * var(--darkness-level) / 100)),
                    calc(60 - (10 * var(--darkness-level) / 100))
                ),
                rgb(
                    calc(234 - (100 * var(--darkness-level) / 100)),
                    calc(88 - (50 * var(--darkness-level) / 100)),
                    calc(12 - (10 * var(--darkness-level) / 100))
                )
            ) !important;
        }
        
    </style>
    
    <!-- Simple Darkness Control JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load saved darkness level and apply it
            const savedDarkness = localStorage.getItem('darknessLevel') || '0';
            document.documentElement.style.setProperty('--darkness-level', savedDarkness);
        });
    </script>
</head>
<body class="font-sans antialiased"><?php /**PATH C:\xampp\htdocs\custom-label\resources\views/components/layouts/head.blade.php ENDPATH**/ ?>