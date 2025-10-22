<form action="<?php echo e(isset($producto) ? route('productos.update', $producto->product_code) : route('productos.store')); ?>"
      method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
    <?php echo csrf_field(); ?>
    <?php if(isset($producto)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    <?php if($errors->any()): ?>
      <div class="col-span-2 rounded-lg border border-red-200 bg-red-50 p-3 text-red-700 flex items-start gap-2">
        <i class="fas fa-circle-exclamation mt-0.5"></i>
        <div>
          <p class="font-semibold">Por favor corrige los siguientes campos:</p>
          <ul class="list-disc pl-5 text-sm mt-1">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      </div>
    <?php endif; ?>

    <!-- Nombre -->
    <div class="col-span-2">
        <label class="block font-medium">Nombre</label>
        <input type="text" name="product_name"
               value="<?php echo e(old('product_name', $producto->product_name ?? '')); ?>"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 <?php $__errorArgs = ['product_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-2 ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
        <?php $__errorArgs = ['product_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Categoría -->
    <div>
        <label class="block font-medium">Categoría</label>
        <select name="id_category" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 <?php $__errorArgs = ['id_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-2 ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <option value="">Selecciona una categoría</option>
            <?php $__empty_1 = true; $__currentLoopData = ($categoryOptions ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <option value="<?php echo e($id); ?>" <?php echo e((string)old('id_category', $producto->id_category ?? '') === (string)$id ? 'selected' : ''); ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <option value="" disabled>No hay categorías. Crea una primero.</option>
            <?php endif; ?>
        </select>
        <?php $__errorArgs = ['id_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Precio -->
    <div>
        <label class="block font-medium">Precio</label>
        <input type="number" step="0.01" name="price"
               value="<?php echo e(old('price', $producto->price ?? '')); ?>"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-2 ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Descuento -->
    <div>
        <label class="block font-medium">Descuento (%)</label>
        <input type="number" step="0.01" name="discount"
               value="<?php echo e(old('discount', $producto->discount ?? '')); ?>"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-2 ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Unidades Disponibles -->
    <div>
        <label class="block font-medium">Unidades Disponibles</label>
        <input type="number" name="available_unity"
               value="<?php echo e(old('available_unity', $producto->available_unity ?? '')); ?>"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 <?php $__errorArgs = ['available_unity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-2 ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
        <?php $__errorArgs = ['available_unity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Stock mínimo -->
    <div>
        <label class="block font-medium">Stock mínimo</label>
        <input type="number" name="minimum_stock"
               value="<?php echo e(old('minimum_stock', $producto->minimum_stock ?? '')); ?>"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 <?php $__errorArgs = ['minimum_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-2 ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['minimum_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Stock máximo -->
    <div>
        <label class="block font-medium">Stock máximo</label>
        <input type="number" name="maximum_stock"
               value="<?php echo e(old('maximum_stock', $producto->maximum_stock ?? '')); ?>"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 <?php $__errorArgs = ['maximum_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-2 ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['maximum_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Estado -->
    <div>
        <label class="block font-medium">Estado</label>
        <select name="status" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-2 ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <option value="1" <?php echo e(old('status', $producto->status ?? 1) == 1 ? 'selected' : ''); ?>>Activo</option>
            <option value="0" <?php echo e(old('status', $producto->status ?? 0) == 0 ? 'selected' : ''); ?>>Inactivo</option>
        </select>
        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Orden de visualización -->
    <div>
        <label class="block font-medium">Orden de visualización</label>
        <input type="number" name="display_order"
               value="<?php echo e(old('display_order', $producto->display_order ?? '')); ?>"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 <?php $__errorArgs = ['display_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-2 ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['display_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Descripción -->
    <div class="col-span-2">
        <label class="block font-medium">Descripción</label>
        <textarea name="description"
                  class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-2 ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description', $producto->description ?? '')); ?></textarea>
        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Ingredientes -->
    <div class="col-span-2">
        <label class="block font-medium">Ingredientes</label>
        <textarea name="ingredients"
                  class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 <?php $__errorArgs = ['ingredients'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-2 ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('ingredients', $producto->ingredients ?? '')); ?></textarea>
        <?php $__errorArgs = ['ingredients'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Imagen -->
    <div class="col-span-2">
        <label class="block font-medium">Imagen del Producto</label>
        <input type="file" name="image"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-2 ring-red-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <?php if(isset($producto) && $producto->image): ?>
            <div class="mt-2">
                <img src="<?php echo e(asset('storage/'.$producto->image)); ?>"
                    class="h-28 object-cover rounded-lg border-2 border-primary-light">
            </div>
        <?php endif; ?>
    </div>

    <!-- Botón -->
    <div class="col-span-2 flex justify-end">
        <button type="submit" class="px-5 py-2.5 rounded-lg flex items-center bg-gradient-to-r from-pink-500 to-pink-600 text-white font-semibold shadow hover:from-pink-600 hover:to-pink-700 active:from-pink-700 active:to-pink-800 transition">
            <?php echo e(isset($producto) ? 'Actualizar' : 'Guardar'); ?>

        </button>
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\FluffyBakery\resources\views/admin/productos/form.blade.php ENDPATH**/ ?>