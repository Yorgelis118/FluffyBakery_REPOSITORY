<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="bg-white rounded-lg shadow overflow-hidden">
  <div class="p-4 border-b flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-800">Productos</h2>
    <a href="<?php echo e(route('productos.create')); ?>" 
       class="px-4 py-2 rounded-lg flex items-center bg-pink-400 text-white hover:bg-pink-500 cursor-pointer">
      <i class="fas fa-plus mr-2"></i>
      Nuevo Producto
    </a>
  </div>

  <!-- Categorías -->
  <div class="p-4 border-b bg-gray-50">
    <div class="flex flex-wrap gap-2">
      <a href="<?php echo e(route('productos.index')); ?>" 
         class="px-4 py-2 rounded-lg flex items-center transition <?php echo e(($activeCategory ?? request('category')) === null ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500'); ?>">
        <i class="fas fa-list mr-2"></i>Todos
      </a>
      <a href="<?php echo e(route('productos.index', ['category' => 'pasteles'])); ?>" 
         class="px-4 py-2 rounded-lg flex items-center transition <?php echo e(($activeCategory ?? request('category')) === 'pasteles' ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500'); ?>">
        <i class="fas fa-birthday-cake mr-2"></i>Pasteles
      </a>
      <a href="<?php echo e(route('productos.index', ['category' => 'cupcakes'])); ?>" 
         class="px-4 py-2 rounded-lg flex items-center transition <?php echo e(($activeCategory ?? request('category')) === 'cupcakes' ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500'); ?>">
        <i class="fas fa-ice-cream mr-2"></i>Cupcakes
      </a>
      <a href="<?php echo e(route('productos.index', ['category' => 'galletas'])); ?>" 
         class="px-4 py-2 rounded-lg flex items-center transition <?php echo e(($activeCategory ?? request('category')) === 'galletas' ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500'); ?>">
        <i class="fas fa-cookie-bite mr-2"></i>Galletas
      </a>
      <a href="<?php echo e(route('productos.index', ['category' => 'rellenos'])); ?>" 
         class="px-4 py-2 rounded-lg flex items-center transition <?php echo e(($activeCategory ?? request('category')) === 'rellenos' ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500'); ?>">
        <i class="fas fa-cheese mr-2"></i>Rellenos
      </a>
      <a href="<?php echo e(route('productos.index', ['category' => 'brownies'])); ?>" 
         class="px-4 py-2 rounded-lg flex items-center transition <?php echo e(($activeCategory ?? request('category')) === 'brownies' ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500'); ?>">
        <i class="fas fa-square mr-2"></i>Brownies
      </a>
      <a href="<?php echo e(route('productos.index', ['category' => 'alfajores'])); ?>" 
         class="px-4 py-2 rounded-lg flex items-center transition <?php echo e(($activeCategory ?? request('category')) === 'alfajores' ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500'); ?>">
        <i class="fas fa-cookie mr-2"></i>Alfajores
      </a>
    </div>
  </div>

  <!-- Tabla de productos -->
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <?php $__empty_1 = true; $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td class="px-6 py-4">
              <?php if($producto->image): ?>
                <img src="<?php echo e(asset('storage/'.$producto->image)); ?>" 
                     alt="<?php echo e($producto->product_name); ?>" 
                     class="h-12 w-12 object-cover rounded">
              <?php else: ?>
                <span class="text-gray-400 italic">Sin imagen</span>
              <?php endif; ?>
            </td>
            <td class="px-6 py-4"><?php echo e($producto->product_name); ?></td>
            <td class="px-6 py-4">$<?php echo e(number_format($producto->price, 2)); ?></td>
            <td class="px-6 py-4"><?php echo e($producto->available_unity); ?></td>
            <td class="px-6 py-4">
              <?php if($producto->status): ?>
                <span class="px-2 py-1 bg-green-100 text-green-600 rounded-full text-xs">Activo</span>
              <?php else: ?>
                <span class="px-2 py-1 bg-red-100 text-red-600 rounded-full text-xs">Inactivo</span>
              <?php endif; ?>
            </td>
            <td class="px-6 py-4 flex gap-2">
              <a href="<?php echo e(route('productos.edit', $producto->product_code)); ?>" 
                 class="text-blue-500 hover:underline">
                <i class="fas fa-edit"></i>
              </a>
              <form action="<?php echo e(route('productos.destroy', $producto->product_code)); ?>" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este producto?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="text-red-500 hover:underline">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
              No hay productos disponibles en esta categoría.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FluffyBakeryV2-carrito1\FluffyBakery\resources\views/admin/productos/index.blade.php ENDPATH**/ ?>