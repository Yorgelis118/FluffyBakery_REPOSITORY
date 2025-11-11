<?php $__env->startSection('title', 'Productos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Nuestra Tienda</h2>

        <!-- Categorías -->
        <div class="flex justify-center gap-4 mb-8 border-b border-gray-200 pb-2">
            <a href="<?php echo e(route('users.productos')); ?>"
                class="px-4 py-2 <?php echo e(request('category') == '' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500'); ?>">
                Todos
            </a>
            <a href="<?php echo e(route('users.productos', ['category' => 'pasteles'])); ?>"
                class="px-4 py-2 <?php echo e(request('category') == 'pasteles' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500'); ?>">
                Pasteles
            </a>
            <a href="<?php echo e(route('users.productos', ['category' => 'cupcakes'])); ?>"
                class="px-4 py-2 <?php echo e(request('category') == 'cupcakes' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500'); ?>">
                Cupcakes
            </a>
            <a href="<?php echo e(route('users.productos', ['category' => 'galletas'])); ?>"
                class="px-4 py-2 <?php echo e(request('category') == 'galletas' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500'); ?>">
                Galletas
            </a>
            <a href="<?php echo e(route('users.productos', ['category' => 'rellenos'])); ?>"
                class="px-4 py-2 <?php echo e(request('category') == 'rellenos' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500'); ?>">
                Rellenos
            </a>
            <a href="<?php echo e(route('users.productos', ['category' => 'brownies'])); ?>"
                class="px-4 py-2 <?php echo e(request('category') == 'brownies' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500'); ?>">
                Brownies
            </a>
            <a href="<?php echo e(route('users.productos', ['category' => 'alfajores'])); ?>"
                class="px-4 py-2 <?php echo e(request('category') == 'alfajores' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500'); ?>">
                Alfajores
            </a>
        </div>

        <!-- Productos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                    <img src="<?php echo e(asset('storage/'.$producto->image)); ?>"
                        alt="<?php echo e($producto->product_name); ?>"
                        class="h-48 w-full object-cover">

                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800"><?php echo e($producto->product_name); ?></h3>
                        <p class="text-sm text-gray-500"><?php echo e($producto->description); ?></p>
                        <p class="mt-2 font-bold text-pink-600">
                            $<?php echo e(number_format($producto->price, 2)); ?>

                        </p>

                        <?php if(auth()->guard()->check()): ?>
                            <form action="<?php echo e(route('carrito.agregar', $producto->product_code)); ?>" method="POST" class="mt-auto">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                    class="mt-3 w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition cursor-pointer">
                                    Agregar al Carrito
                                </button>
                            </form>
                        <?php endif; ?>

                        <?php if(auth()->guard()->guest()): ?>
                            <button onclick="toggleModal('loginModal', true)"
                                class="mt-3 w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition cursor-pointer">
                                Agregar al Carrito
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="col-span-4 text-center text-gray-500">
                    No hay productos disponibles en esta categoría.
                </p>
            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FluffyBakery_REPOSITORY\resources\views/users/productos.blade.php ENDPATH**/ ?>