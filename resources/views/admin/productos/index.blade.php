@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="bg-white rounded-lg shadow overflow-hidden">
  <div class="p-4 border-b flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-800">Productos</h2>
    <div class="flex gap-2">
      <button onclick="openCategoryModal()" 
         class="px-4 py-2 rounded-lg flex items-center bg-pink-400 text-white hover:bg-pink-500 cursor-pointer">
        <i class="fas fa-tags mr-2"></i>
        Nueva Categoría
      </button>
      <a href="{{ route('productos.create') }}" 
         class="px-4 py-2 rounded-lg flex items-center bg-pink-400 text-white hover:bg-pink-500 cursor-pointer">
        <i class="fas fa-plus mr-2"></i>
        Nuevo Producto
      </a>
    </div>
  </div>

  <!-- Categorías -->
  <div class="p-4 border-b bg-gray-50">
    <div class="flex flex-wrap gap-2">
      <a href="{{ route('productos.index') }}" 
         class="px-4 py-2 rounded-lg flex items-center transition {{ ($activeCategory ?? request('category')) === null ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500' }}">
        <i class="fas fa-list mr-2"></i>Todos
      </a>
      @foreach($categorias as $categoria)
        <a href="{{ route('productos.index', ['category' => $categoria->slug]) }}" 
           class="px-4 py-2 rounded-lg flex items-center transition {{ ($activeCategory ?? request('category')) === $categoria->slug ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500' }}">
          <i class="fas {{ $categoria->icon }} mr-2"></i>{{ $categoria->name }}
        </a>
      @endforeach
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
        @forelse($productos as $producto)
          <tr>
            <td class="px-6 py-4">
              @if($producto->image)
                <img src="{{ asset('storage/'.$producto->image) }}" 
                     alt="{{ $producto->product_name }}" 
                     class="h-12 w-12 object-cover rounded">
              @else
                <span class="text-gray-400 italic">Sin imagen</span>
              @endif
            </td>
            <td class="px-6 py-4">{{ $producto->product_name }}</td>
            <td class="px-6 py-4">${{ number_format($producto->price, 2) }}</td>
            <td class="px-6 py-4">{{ $producto->available_unity }}</td>
            <td class="px-6 py-4">
              @if($producto->status)
                <span class="px-2 py-1 bg-green-100 text-green-600 rounded-full text-xs">Activo</span>
              @else
                <span class="px-2 py-1 bg-red-100 text-red-600 rounded-full text-xs">Inactivo</span>
              @endif
            </td>
            <td class="px-6 py-4 flex gap-2">
              <a href="{{ route('productos.edit', $producto->product_code) }}" 
                 class="text-blue-500 hover:underline">
                <i class="fas fa-edit"></i>
              </a>
              <form action="{{ route('productos.destroy', $producto->product_code) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este producto?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
              No hay productos disponibles en esta categoría.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- Modal para crear categoría -->
<div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
  <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
    <div class="p-6">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Nueva Categoría</h3>
        <button onclick="closeCategoryModal()" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      
      @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
          <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
            Nombre de la Categoría
          </label>
          <input type="text" 
                 id="name" 
                 name="name" 
                 value="{{ old('name') }}"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-200 focus:border-transparent"
                 placeholder="Ej: Pasteles, Cupcakes, etc."
                 required>
        </div>
        
        <div class="flex justify-end gap-2">
          <button type="button" 
                  onclick="closeCategoryModal()"
                  class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
            Cancelar
          </button>
          <button type="submit" 
                  class="px-4 py-2 bg-pink-400 text-white rounded-lg hover:bg-pink-500">
            <i class="fas fa-save mr-2"></i>
            Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function openCategoryModal() {
    document.getElementById('categoryModal').classList.remove('hidden');
  }

  function closeCategoryModal() {
    document.getElementById('categoryModal').classList.add('hidden');
  }

  // Cerrar modal al hacer clic fuera de él
  document.getElementById('categoryModal').addEventListener('click', function(e) {
    if (e.target === this) {
      closeCategoryModal();
    }
  });

  // Cerrar modal con la tecla ESC
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeCategoryModal();
    }
  });

  // Abrir modal automáticamente si hay errores de validación
  @if($errors->has('name'))
    document.addEventListener('DOMContentLoaded', function() {
      openCategoryModal();
    });
  @endif
</script>
@endsection
