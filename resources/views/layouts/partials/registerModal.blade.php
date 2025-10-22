<div id="registerModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 
            transition-opacity duration-300 ease-out opacity-0">
    <div class="bg-white w-full max-w-md p-6 rounded-2xl shadow-lg relative 
                transform scale-95 transition-all duration-300 ease-out">

        <!-- Botón cerrar -->
        <button onclick="toggleModal('registerModal', false)"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-3xl font-bold">&times;</button>

        <h2 class="text-2xl font-bold mb-4 text-center">Crear Cuenta</h2>

        @if(session('success'))
        <div
            class="mt-3 flex items-center gap-2 bg-green-100 border border-green-300 text-green-700 px-4 py-2 rounded-lg text-sm">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-semibold">Nombre</label>
                <input type="text" name="name" required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-pink-400 focus:border-pink-400">
                @error('name')
                <div
                    class="mt-2 flex items-center gap-2 bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded-lg text-sm">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Correo Electrónico</label>
                <input type="email" name="email" required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-pink-400 focus:border-pink-400">
                @error('email')
                <div
                    class="mt-2 flex items-center gap-2 bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded-lg text-sm">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-pink-400 focus:border-pink-400">
                @error('password')
                <div
                    class="mt-2 flex items-center gap-2 bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded-lg text-sm">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-pink-400 focus:border-pink-400">
                @error('password_confirmation')
                <div
                    class="mt-2 flex items-center gap-2 bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded-lg text-sm">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            <button type="submit" class="w-full bg-pink-600 text-white py-2 rounded-lg hover:bg-pink-500">
                Registrarse
            </button>

            <div class="flex items-center my-2">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="px-2 text-gray-500 text-sm">o</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <a href="{{ route('google.login') }}"
                class="w-full flex items-center justify-center gap-2 bg-white text-black py-2 rounded-lg bg-gray-300 transition border hover:bg-gray-200">
                <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5" alt="Google">
                Accede con Google
            </a>
        </form>

        <!-- Cambio a login -->
        <p class="mt-4 text-center text-sm">
            ¿Ya tienes cuenta?
            <a href="#" onclick="switchModal('registerModal','loginModal')"
                class="text-pink-600 font-semibold hover:underline">
                Inicia sesión aquí
            </a>
        </p>
    </div>
</div>