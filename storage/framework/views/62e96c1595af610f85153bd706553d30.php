
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo e($title ?? 'Welcome Back - Login & Registration'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

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
    
    <?php echo e($slot); ?>


    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\custom-label\resources\views/components/layouts/auth.blade.php ENDPATH**/ ?>