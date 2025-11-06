<div id="loginModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 
            transition-opacity duration-300 ease-out opacity-0">
    <div class="bg-white w-full max-w-md p-6 rounded-2xl shadow-lg relative 
                transform scale-95 transition-all duration-300 ease-out">

        <!-- Botón cerrar -->
        <button onclick="toggleModal('loginModal', false)"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-3xl font-bold">&times;</button>

        <h2 class="text-2xl font-bold mb-4 text-center">Iniciar Sesión</h2>
        <?php if($errors->has('login')): ?>
        <div
            class="mt-3 flex items-center gap-2 bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded-lg text-sm">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo e($errors->first('login')); ?></span>
        </div>
        <?php endif; ?>
        <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block mb-1 font-semibold">Correo Electrónico</label>
                <input type="email" name="email" required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-pink-400 focus:border-pink-400">
            </div>
            <?php if($errors->has('email')): ?>
            <div
                class="mt-3 flex items-center gap-2 bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded-lg text-sm">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo e($errors->first('email')); ?></span>
            </div>
            <?php endif; ?>
            <div>
                <label class="block mb-1 font-semibold">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-pink-400 focus:border-pink-400">
            </div>
            <?php if($errors->has('password')): ?>
            <div
                class="mt-3 flex items-center gap-2 bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded-lg text-sm">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo e($errors->first('password')); ?></span>
            </div>
            <?php endif; ?>
            <button type="submit" class="w-full bg-pink-600 text-white py-2 rounded-lg hover:bg-pink-500 cursor-pointer">
                Entrar
            </button>

            <div class="flex items-center my-2">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="px-2 text-gray-500 text-sm">o</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <a href="<?php echo e(route('google.login')); ?>"
                class="w-full flex items-center justify-center gap-2 bg-white text-black py-2 rounded-lg bg-gray-300 transition border hover:bg-gray-200">
                <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5" alt="Google">
                Iniciar sesión con Google
            </a>

        </form>

        <!-- Cambio a registro -->
        <p class="mt-4 text-center text-sm">
            ¿No tienes cuenta?
            <a href="#" onclick="switchModal('loginModal','registerModal')"
                class="text-pink-600 font-semibold hover:underline">
                Regístrate aquí
            </a>
        </p>
    </div>
</div><?php /**PATH C:\xampp\htdocs\FluffyBakery_REPOSITORY-main\resources\views/layouts/partials/loginModal.blade.php ENDPATH**/ ?>