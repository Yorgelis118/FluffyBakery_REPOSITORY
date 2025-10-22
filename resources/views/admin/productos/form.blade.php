<form action="{{ isset($producto) ? route('productos.update', $producto->product_code) : route('productos.store') }}"
      method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
    @csrf
    @if(isset($producto)) @method('PUT') @endif

    @if ($errors->any())
      <div class="col-span-2 rounded-lg border border-red-200 bg-red-50 p-3 text-red-700 flex items-start gap-2">
        <i class="fas fa-circle-exclamation mt-0.5"></i>
        <div>
          <p class="font-semibold">Por favor corrige los siguientes campos:</p>
          <ul class="list-disc pl-5 text-sm mt-1">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

    <!-- Nombre -->
    <div class="col-span-2">
        <label class="block font-medium">Nombre</label>
        <input type="text" name="product_name"
               value="{{ old('product_name', $producto->product_name ?? '') }}"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 @error('product_name') border-red-500 ring-2 ring-red-200 @enderror" required>
        @error('product_name')<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror
    </div>

    <!-- Categoría -->
    <div>
        <label class="block font-medium">Categoría</label>
        <select name="id_category" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 @error('id_category') border-red-500 ring-2 ring-red-200 @enderror">
            <option value="">Selecciona una categoría</option>
            @forelse(($categoryOptions ?? []) as $id => $label)
                <option value="{{ $id }}" {{ (string)old('id_category', $producto->id_category ?? '') === (string)$id ? 'selected' : '' }}>{{ $label }}</option>
            @empty
                <option value="" disabled>No hay categorías. Crea una primero.</option>
            @endforelse
        </select>
        @error('id_category')<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror
    </div>

    <!-- Precio -->
    <div>
        <label class="block font-medium">Precio</label>
        <input type="number" step="0.01" name="price"
               value="{{ old('price', $producto->price ?? '') }}"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 @error('price') border-red-500 ring-2 ring-red-200 @enderror" required>
        @error('price')<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror
    </div>

    <!-- Descuento -->
    <div>
        <label class="block font-medium">Descuento (%)</label>
        <input type="number" step="0.01" name="discount"
               value="{{ old('discount', $producto->discount ?? '') }}"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 @error('discount') border-red-500 ring-2 ring-red-200 @enderror">
        @error('discount')<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror
    </div>

    <!-- Unidades Disponibles -->
    <div>
        <label class="block font-medium">Unidades Disponibles</label>
        <input type="number" name="available_unity"
               value="{{ old('available_unity', $producto->available_unity ?? '') }}"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 @error('available_unity') border-red-500 ring-2 ring-red-200 @enderror" required>
        @error('available_unity')<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror
    </div>

    <!-- Stock mínimo -->
    <div>
        <label class="block font-medium">Stock mínimo</label>
        <input type="number" name="minimum_stock"
               value="{{ old('minimum_stock', $producto->minimum_stock ?? '') }}"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 @error('minimum_stock') border-red-500 ring-2 ring-red-200 @enderror">
        @error('minimum_stock')<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror
    </div>

    <!-- Stock máximo -->
    <div>
        <label class="block font-medium">Stock máximo</label>
        <input type="number" name="maximum_stock"
               value="{{ old('maximum_stock', $producto->maximum_stock ?? '') }}"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 @error('maximum_stock') border-red-500 ring-2 ring-red-200 @enderror">
        @error('maximum_stock')<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror
    </div>

    <!-- Estado -->
    <div>
        <label class="block font-medium">Estado</label>
        <select name="status" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 @error('status') border-red-500 ring-2 ring-red-200 @enderror">
            <option value="1" {{ old('status', $producto->status ?? 1) == 1 ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ old('status', $producto->status ?? 0) == 0 ? 'selected' : '' }}>Inactivo</option>
        </select>
        @error('status')<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror
    </div>

    <!-- Orden de visualización -->
    <div>
        <label class="block font-medium">Orden de visualización</label>
        <input type="number" name="display_order"
               value="{{ old('display_order', $producto->display_order ?? '') }}"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 @error('display_order') border-red-500 ring-2 ring-red-200 @enderror">
        @error('display_order')<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror
    </div>

    <!-- Descripción -->
    <div class="col-span-2">
        <label class="block font-medium">Descripción</label>
        <textarea name="description"
                  class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 @error('description') border-red-500 ring-2 ring-red-200 @enderror">{{ old('description', $producto->description ?? '') }}</textarea>
        @error('description')<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror
    </div>

    <!-- Ingredientes -->
    <div class="col-span-2">
        <label class="block font-medium">Ingredientes</label>
        <textarea name="ingredients"
                  class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 @error('ingredients') border-red-500 ring-2 ring-red-200 @enderror">{{ old('ingredients', $producto->ingredients ?? '') }}</textarea>
        @error('ingredients')<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror
    </div>

    <!-- Imagen -->
    <div class="col-span-2">
        <label class="block font-medium">Imagen del Producto</label>
        <input type="file" name="image"
               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-200 focus:border-pink-300 @error('image') border-red-500 ring-2 ring-red-200 @enderror">
        @error('image')<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-circle-exclamation"></i>{{ $message }}</p>@enderror

        @if(isset($producto) && $producto->image)
            <div class="mt-2">
                <img src="{{ asset('storage/'.$producto->image) }}"
                    class="h-28 object-cover rounded-lg border-2 border-primary-light">
            </div>
        @endif
    </div>

    <!-- Botón -->
    <div class="col-span-2 flex justify-end">
        <button type="submit" class="px-5 py-2.5 rounded-lg flex items-center bg-gradient-to-r from-pink-500 to-pink-600 text-white font-semibold shadow hover:from-pink-600 hover:to-pink-700 active:from-pink-700 active:to-pink-800 transition">
            {{ isset($producto) ? 'Actualizar' : 'Guardar' }}
        </button>
    </div>
</form>
