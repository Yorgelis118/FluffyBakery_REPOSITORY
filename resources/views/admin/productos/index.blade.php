@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="bg-white rounded-lg shadow overflow-hidden">
  <div class="p-4 border-b flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-800">Productos</h2>
    <a href="{{ route('productos.create') }}" 
       class="px-4 py-2 rounded-lg flex items-center bg-pink-400 text-white hover:bg-pink-500 cursor-pointer">
      <i class="fas fa-plus mr-2"></i>
      Nuevo Producto
    </a>
  </div>

  <!-- Categorías -->
  <div class="p-4 border-b bg-gray-50">
    <div class="flex flex-wrap gap-2">
      <a href="{{ route('productos.index') }}" 
         class="px-4 py-2 rounded-lg flex items-center transition {{ ($activeCategory ?? request('category')) === null ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500' }}">
        <i class="fas fa-list mr-2"></i>Todos
      </a>
      <a href="{{ route('productos.index', ['category' => 'pasteles']) }}" 
         class="px-4 py-2 rounded-lg flex items-center transition {{ ($activeCategory ?? request('category')) === 'pasteles' ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500' }}">
        <i class="fas fa-birthday-cake mr-2"></i>Pasteles
      </a>
      <a href="{{ route('productos.index', ['category' => 'cupcakes']) }}" 
         class="px-4 py-2 rounded-lg flex items-center transition {{ ($activeCategory ?? request('category')) === 'cupcakes' ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500' }}">
        <i class="fas fa-ice-cream mr-2"></i>Cupcakes
      </a>
      <a href="{{ route('productos.index', ['category' => 'galletas']) }}" 
         class="px-4 py-2 rounded-lg flex items-center transition {{ ($activeCategory ?? request('category')) === 'galletas' ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500' }}">
        <i class="fas fa-cookie-bite mr-2"></i>Galletas
      </a>
      <a href="{{ route('productos.index', ['category' => 'rellenos']) }}" 
         class="px-4 py-2 rounded-lg flex items-center transition {{ ($activeCategory ?? request('category')) === 'rellenos' ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500' }}">
        <i class="fas fa-cheese mr-2"></i>Rellenos
      </a>
      <a href="{{ route('productos.index', ['category' => 'brownies']) }}" 
         class="px-4 py-2 rounded-lg flex items-center transition {{ ($activeCategory ?? request('category')) === 'brownies' ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500' }}">
        <i class="fas fa-square mr-2"></i>Brownies
      </a>
      <a href="{{ route('productos.index', ['category' => 'alfajores']) }}" 
         class="px-4 py-2 rounded-lg flex items-center transition {{ ($activeCategory ?? request('category')) === 'alfajores' ? 'bg-pink-100 text-pink-600 font-semibold shadow-md' : 'text-gray-600 hover:text-pink-500' }}">
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
@endsection
