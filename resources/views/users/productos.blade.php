@extends('layouts.main')
@section('title', 'Productos')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Nuestra Tienda</h2>

        <!-- Categorías -->
        <div class="flex justify-center gap-4 mb-8 border-b border-gray-200 pb-2">
            <a href="{{ route('users.productos') }}"
                class="px-4 py-2 {{ request('category') == '' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500' }}">
                Todos
            </a>
            <a href="{{ route('users.productos', ['category' => 'pasteles']) }}"
                class="px-4 py-2 {{ request('category') == 'pasteles' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500' }}">
                Pasteles
            </a>
            <a href="{{ route('users.productos', ['category' => 'cupcakes']) }}"
                class="px-4 py-2 {{ request('category') == 'cupcakes' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500' }}">
                Cupcakes
            </a>
            <a href="{{ route('users.productos', ['category' => 'galletas']) }}"
                class="px-4 py-2 {{ request('category') == 'galletas' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500' }}">
                Galletas
            </a>
            <a href="{{ route('users.productos', ['category' => 'rellenos']) }}"
                class="px-4 py-2 {{ request('category') == 'rellenos' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500' }}">
                Rellenos
            </a>
            <a href="{{ route('users.productos', ['category' => 'brownies']) }}"
                class="px-4 py-2 {{ request('category') == 'brownies' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500' }}">
                Brownies
            </a>
            <a href="{{ route('users.productos', ['category' => 'alfajores']) }}"
                class="px-4 py-2 {{ request('category') == 'alfajores' ? 'border-b-2 border-pink-500 text-pink-600 font-semibold' : 'text-gray-600 hover:text-pink-500' }}">
                Alfajores
            </a>
        </div>

        <!-- Productos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($productos as $producto)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                    <img src="{{ asset('storage/'.$producto->image) }}"
                        alt="{{ $producto->product_name }}"
                        class="h-48 w-full object-cover">

                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800">{{ $producto->product_name }}</h3>
                        <p class="text-sm text-gray-500">{{ $producto->description }}</p>
                        <p class="mt-2 font-bold text-pink-600">
                            ${{ number_format($producto->price, 2) }}
                        </p>

                        @auth
                            <form action="{{ route('carrito.agregar', $producto->product_code) }}" method="POST" class="mt-auto">
                                @csrf
                                <button type="submit"
                                    class="mt-3 w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition cursor-pointer">
                                    Agregar al Carrito
                                </button>
                            </form>
                        @endauth

                        @guest
                            <button onclick="toggleModal('loginModal', true)"
                                class="mt-3 w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition cursor-pointer">
                                Agregar al Carrito
                            </button>
                        @endguest
                    </div>
                </div>
            @empty
                <p class="col-span-4 text-center text-gray-500">
                    No hay productos disponibles en esta categoría.
                </p>
            @endforelse
        </div>
    </div>

@endsection