<?php $__env->startSection('content'); ?>
<div class="bg-white p-6 rounded-lg shadow max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-4 text-primary">Nuevo Producto</h2>
    <?php echo $__env->make('admin.productos.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FluffyBakery_REPOSITORY-main\resources\views/admin/productos/create.blade.php ENDPATH**/ ?>