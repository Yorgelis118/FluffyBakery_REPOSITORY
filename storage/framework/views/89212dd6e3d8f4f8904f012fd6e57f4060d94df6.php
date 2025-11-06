<!-- Topbar Start -->
<div class="bg-pink-300 hidden md:block">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-2">
            
            <!-- Ayuda | Soporte -->
            <div class="flex items-center space-x-4">
                <a class="text-white hover:underline" href="#">Ayuda</a>
                <span class="text-white">|</span>
                <a class="text-white hover:underline" href="#">Soporte</a>
            </div>

            <!-- Iconos: Instagram + Usuario + Carrito -->
            <div class="flex items-center space-x-4">
                <!-- Instagram -->
                <a href="https://www.instagram.com/fluffybakeryshop" target="_blank" aria-label="Instagram"
                   class="flex items-center justify-center hover:text-pink-100 transition cursor-pointer">
                    <i class="fab fa-instagram text-white text-lg"></i>
                </a>

                <!-- Carrito -->
                <div class="relative">
                    <?php
                        $carrito = session('carrito', []);
                        $cantidadTotal = collect($carrito)->sum(function ($valor) {
                            return is_array($valor) ? (int)($valor['cantidad'] ?? 0) : (int)$valor;
                        });
                    ?>

                    <?php if(auth()->guard()->check()): ?>
                        <button onclick="toggleCarrito(true)"
                            class="flex items-center justify-center relative hover:text-pink-100 transition cursor-pointer">
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z" />
                            </svg>
                            <?php if($cantidadTotal > 0): ?>
                                <span
                                    class="absolute -top-1 -right-2 bg-pink-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                                    <?php echo e($cantidadTotal); ?>

                                </span>
                            <?php endif; ?>
                        </button>
                    <?php endif; ?>

                    <?php if(auth()->guard()->guest()): ?>
                        <button onclick="toggleModal('loginModal', true)"
                            class="flex items-center justify-center hover:text-pink-100 transition cursor-pointer">
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z" />
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
                <!-- FinCarrito -->

                <!-- User Dropdown -->
                <div class="relative inline-block text-left">
                    <button id="userDropdownButton" onclick="toggleDropdown()" type="button"
                        class="flex items-center justify-center hover:text-pink-100 transition cursor-pointer"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user text-white text-lg"></i>
                    </button>

                    <!-- Menú -->
                    <div id="userDropdownMenu"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden z-50" role="menu"
                        aria-orientation="vertical">
                        <?php if(auth()->guard()->guest()): ?>
                            <button onclick="toggleModal('loginModal', true)"
                                class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                Iniciar Sesión
                            </button>
                            <button onclick="toggleModal('registerModal', true)"
                                class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                Regístrate
                            </button>
                        <?php endif; ?>

                        <?php if(auth()->guard()->check()): ?>
                            <span class="block px-4 py-2 text-gray-600">Hola, <?php echo e(Auth::user()->name); ?></span>

                            <?php if(Auth::user()->role === 'admin'): ?>
                                <a href="<?php echo e(route('admin.index')); ?>"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Panel de Administración
                                </a>
                            <?php endif; ?>

                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Cerrar Sesión
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="bg-white shadow-lg sticky top-0 z-40">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Mobile menu button -->
            <button class="md:hidden text-gray-600 hover:text-gray-900 focus:outline-none" onclick="toggleMobileMenu()"
                aria-label="Abrir menú">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <!-- Left Nav -->
            <div class="hidden md:flex space-x-8">
                <a href="<?php echo e(route('inicio')); ?>" class="nav-link">Inicio</a>
                <a href="<?php echo e(route('users.productos')); ?>" class="nav-link">Productos</a>
            </div>

            <!-- Logo -->
            <a href="<?php echo e(route('inicio')); ?>"
                class="text-4xl font-bold text-primary hover:scale-105 transition-transform">
                FLUFFY
            </a>

            <!-- Right Nav -->
            <div class="hidden md:flex space-x-8">
                <a href="#" class="nav-link">¿Quiénes Somos?</a>
                <a href="#footer" class="nav-link">Contáctenos</a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden pb-4 transition-all">
            <div class="flex flex-col space-y-2">
                <a href="<?php echo e(route('inicio')); ?>" class="nav-link py-2">Inicio</a>
                <a href="<?php echo e(route('users.productos')); ?>" class="nav-link py-2">Productos</a>
                <a href="#" class="nav-link py-2">¿Quiénes Somos?</a>
                <a href="#footer" class="nav-link py-2">Contáctenos</a>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->

<!-- Modal LOGIN -->
<?php echo $__env->make('layouts.partials.loginModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!-- Modal REGISTRO -->
<?php echo $__env->make('layouts.partials.registerModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!-- Panel Carrito -->
<div id="carritoPanel" class="fixed inset-0 z-50 hidden bg-black/60 transition-opacity duration-300 ease-out opacity-0">
    <div
        class="absolute right-0 top-0 h-full w-full max-w-lg bg-white shadow-2xl flex flex-col transform translate-x-full transition-transform duration-300 ease-out">

        <!-- Header -->
        <div class="flex justify-between items-center border-b border-pink-200 px-6 py-4 bg-gradient-to-r from-pink-50 to-pink-100">
            <h5 class="text-xl font-bold text-pink-600 flex items-center">
                <i class="fas fa-shopping-cart mr-2"></i>
                Mi Carrito
            </h5>
            <button onclick="toggleCarrito(false)" class="text-pink-600 hover:text-pink-800 text-2xl transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="flex-1 overflow-y-auto p-6">
            <?php
            $productosCarrito = \App\Models\Producto::find(array_keys($carrito));
            $total = 0;
            ?>

            <?php if(count($carrito) > 0): ?>
            <div class="space-y-4 mb-6">
                <?php $__currentLoopData = $productosCarrito; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $keyProducto = $producto->product_code;
                $valorEnCarrito = $carrito[$keyProducto] ?? 0;
                $cantidad = is_array($valorEnCarrito) ? (int)($valorEnCarrito['cantidad'] ?? 0) : (int)$valorEnCarrito;
                $precio = (float)($producto->price ?? 0);
                $nombre = $producto->product_name ?? 'Producto';
                $imagen = $producto->image ?? null;
                $subtotal = $precio * $cantidad;
                $total += $subtotal;
                ?>
                <div class="bg-white border border-pink-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center space-x-4">
                        <!-- Imagen del producto -->
                        <div class="flex-shrink-0">
                            <?php if($imagen): ?>
                                <img src="<?php echo e(asset('storage/'.$imagen)); ?>" 
                                     alt="<?php echo e($nombre); ?>" 
                                     class="w-16 h-16 object-cover rounded-lg border border-pink-200">
                            <?php else: ?>
                                <div class="w-16 h-16 bg-pink-100 rounded-lg border border-pink-200 flex items-center justify-center">
                                    <i class="fas fa-image text-pink-400 text-xl"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Información del producto -->
                        <div class="flex-1 min-w-0">
                            <h6 class="text-sm font-semibold text-gray-900 truncate"><?php echo e($nombre); ?></h6>
                            <p class="text-sm text-pink-600 font-medium">$<?php echo e(number_format($precio, 2)); ?></p>
                        </div>
                        
                        <!-- Controles de cantidad -->
                        <div class="flex items-center space-x-2">
                            <button onclick="actualizarCantidad(<?php echo e($keyProducto); ?>, <?php echo e($cantidad - 1); ?>)" 
                                    class="w-8 h-8 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center hover:bg-pink-200 transition-colors">
                                <i class="fas fa-minus text-xs"></i>
                            </button>
                            <span class="w-8 text-center font-semibold text-gray-700"><?php echo e($cantidad); ?></span>
                            <button onclick="actualizarCantidad(<?php echo e($keyProducto); ?>, <?php echo e($cantidad + 1); ?>)" 
                                    class="w-8 h-8 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center hover:bg-pink-200 transition-colors">
                                <i class="fas fa-plus text-xs"></i>
                            </button>
                        </div>
                        
                        <!-- Subtotal -->
                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-900">$<?php echo e(number_format($subtotal, 2)); ?></p>
                        </div>
                        
                        <!-- Botón eliminar -->
                        <button onclick="eliminarDelCarrito(<?php echo e($keyProducto); ?>)" 
                                class="text-red-400 hover:text-red-600 transition-colors">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Resumen total -->
            <div class="border-t border-pink-200 pt-4 mb-6">
                <div class="flex justify-between items-center text-lg font-bold text-pink-800">
                    <span>Total:</span>
                    <span>$<?php echo e(number_format($total, 2)); ?></span>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="space-y-3">
                <a href="#"
                    class="w-full bg-gradient-to-r from-pink-500 to-pink-600 text-white py-3 rounded-lg text-center font-semibold hover:from-pink-600 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                    <i class="fas fa-credit-card mr-2"></i>
                    Finalizar Compra
                </a>
                <form action="<?php echo e(route('carrito.vaciar')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                        class="w-full border-2 border-pink-300 text-pink-600 py-3 rounded-lg font-semibold hover:bg-pink-50 transition-colors flex items-center justify-center cursor-pointer">
                        <i class="fas fa-trash mr-2"></i>
                        Vaciar Carrito
                    </button>
                </form>
            </div>
            <?php else: ?>
            <!-- Carrito vacío -->
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shopping-cart text-pink-400 text-3xl"></i>
                </div>
                <h6 class="text-lg font-semibold text-gray-700 mb-2">Tu carrito está vacío</h6>
                <p class="text-gray-500 mb-6">Agrega algunos productos deliciosos para comenzar</p>
                <button onclick="toggleCarrito(false)" 
                        class="bg-pink-500 text-white px-6 py-2 rounded-lg hover:bg-pink-600 transition-colors">
                    Continuar Comprando
                </button>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<script>
    function toggleCarrito(show) {
        const panel = document.getElementById('carritoPanel');
        const content = panel.querySelector("div");

        if (show === true) {
            panel.classList.remove("hidden");
            setTimeout(() => {
                panel.classList.remove("opacity-0");
                content.classList.remove("translate-x-full");
                content.classList.add("translate-x-0");
            }, 10);
        } else {
            panel.classList.add("opacity-0");
            content.classList.remove("translate-x-0");
            content.classList.add("translate-x-full");
            setTimeout(() => {
                panel.classList.add("hidden");
            }, 300);
        }
    }

    function actualizarCantidad(productId, nuevaCantidad) {
        if (nuevaCantidad < 0) return;
        
        // Crear formulario temporal para enviar la actualización
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/carrito/actualizar/${productId}`;
        
        // Añadir token CSRF
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                         document.querySelector('input[name="_token"]')?.value;
        form.appendChild(csrfToken);
        
        // Añadir campo de cantidad
        const cantidadInput = document.createElement('input');
        cantidadInput.type = 'hidden';
        cantidadInput.name = 'cantidad';
        cantidadInput.value = nuevaCantidad;
        form.appendChild(cantidadInput);
        
        // Añadir al DOM y enviar
        document.body.appendChild(form);
        form.submit();
    }

    function eliminarDelCarrito(productId) {
        if (confirm('¿Estás seguro de que quieres eliminar este producto del carrito?')) {
            // Crear formulario temporal para eliminar
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/carrito/eliminar/${productId}`;
            
            // Añadir token CSRF
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                             document.querySelector('input[name="_token"]')?.value;
            form.appendChild(csrfToken);
            
            // Añadir al DOM y enviar
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>



<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('userDropdownMenu');
        dropdown.classList.toggle('hidden');
    }

    window.addEventListener('click', function(e) {
        const button = document.getElementById('userDropdownButton');
        const menu = document.getElementById('userDropdownMenu');
        if (menu && !button.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });

    function toggleModal(id, show = null) {
        const modal = document.getElementById(id);
        if (!modal) return;

        const content = modal.querySelector("div");

        if (show === true) {
            modal.classList.remove("hidden");
            setTimeout(() => {
                modal.classList.add("flex");
                modal.classList.remove("opacity-0");
                content.classList.remove("scale-95");
                content.classList.add("scale-100");
            }, 10);
        } else if (show === false) {
            modal.classList.add("opacity-0");
            content.classList.remove("scale-100");
            content.classList.add("scale-95");
            setTimeout(() => {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
            }, 300);
        } else {
            if (modal.classList.contains("hidden")) {
                toggleModal(id, true);
            } else {
                toggleModal(id, false);
            }
        }
    }

    function switchModal(currentId, targetId) {
        toggleModal(currentId, false);
        setTimeout(() => {
            toggleModal(targetId, true);
        }, 300); // espera a que cierre el primero antes de abrir el otro
    }

    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }
</script>

<style>
    .nav-link {
        @apply text-gray-700 hover:text-primary transition-colors font-medium;
    }
</style><?php /**PATH C:\xampp\htdocs\FluffyBakery_REPOSITORY-main\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>