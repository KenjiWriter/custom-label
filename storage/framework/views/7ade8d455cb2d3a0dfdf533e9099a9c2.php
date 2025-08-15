<?php if (isset($component)) { $__componentOriginalffd1559aa66a8f395998457a9a7970a4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalffd1559aa66a8f395998457a9a7970a4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.head','data' => ['title' => $title]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalffd1559aa66a8f395998457a9a7970a4)): ?>
<?php $attributes = $__attributesOriginalffd1559aa66a8f395998457a9a7970a4; ?>
<?php unset($__attributesOriginalffd1559aa66a8f395998457a9a7970a4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalffd1559aa66a8f395998457a9a7970a4)): ?>
<?php $component = $__componentOriginalffd1559aa66a8f395998457a9a7970a4; ?>
<?php unset($__componentOriginalffd1559aa66a8f395998457a9a7970a4); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginal508dd3e42d353d46f68538c5a8e15cd5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal508dd3e42d353d46f68538c5a8e15cd5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal508dd3e42d353d46f68538c5a8e15cd5)): ?>
<?php $attributes = $__attributesOriginal508dd3e42d353d46f68538c5a8e15cd5; ?>
<?php unset($__attributesOriginal508dd3e42d353d46f68538c5a8e15cd5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal508dd3e42d353d46f68538c5a8e15cd5)): ?>
<?php $component = $__componentOriginal508dd3e42d353d46f68538c5a8e15cd5; ?>
<?php unset($__componentOriginal508dd3e42d353d46f68538c5a8e15cd5); ?>
<?php endif; ?>

<!-- Main Content -->
<main class="min-h-screen">
    <div class="<?php echo e($containerClass ?? 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8'); ?>">
        <?php echo e($slot); ?>

    </div>
</main>

<?php if (isset($component)) { $__componentOriginal2851f1e47c9108aacbab05e6d2ec4a68 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2851f1e47c9108aacbab05e6d2ec4a68 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2851f1e47c9108aacbab05e6d2ec4a68)): ?>
<?php $attributes = $__attributesOriginal2851f1e47c9108aacbab05e6d2ec4a68; ?>
<?php unset($__attributesOriginal2851f1e47c9108aacbab05e6d2ec4a68); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2851f1e47c9108aacbab05e6d2ec4a68)): ?>
<?php $component = $__componentOriginal2851f1e47c9108aacbab05e6d2ec4a68; ?>
<?php unset($__componentOriginal2851f1e47c9108aacbab05e6d2ec4a68); ?>
<?php endif; ?>

<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\custom-label\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>