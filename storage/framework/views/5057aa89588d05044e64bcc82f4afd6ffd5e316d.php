<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      .notification-dot { position: absolute; top: -2px; right: -2px; width: 8px; height: 8px; background: #ef4444; border-radius: 9999px; }
      .sidebar-item.active { background: #fef2f2; color: #b91c1c; }
    </style>
  </head>
  <body class="flex min-h-screen bg-gray-50 text-gray-900">
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed md:static top-0 left-0 h-full w-64 bg-white/90 backdrop-blur-sm shadow-lg flex flex-col transform -translate-x-full md:translate-x-0 transition-all duration-300 z-50 border-r border-gray-100">
      <!-- Logo -->
      <div class="p-5 flex items-center justify-between border-b border-gray-100">
        <div class="flex items-center">
          <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-pink-300 to-pink-500 flex items-center justify-center shadow">
            <img src="<?php echo e(asset('img/logo.jpeg')); ?>" alt="Logo" class="w-10 h-10 rounded-full shadow">
          </div>
          <div class="ml-3 leading-tight">
            <span class="block text-lg font-extrabold text-gray-800 tracking-tight">FluffyBakery</span>
            <span class="block text-xs text-gray-500">Panel de administración</span>
          </div>
        </div>
      </div>

      <!-- User Profile -->
      <div class="px-5 py-4 flex items-center border-b border-gray-100">
        <img src="<?php echo e(Auth::user()->avatar ?? 'https://via.placeholder.com/64'); ?>" alt="User" class="w-10 h-10 rounded-full ring-2 ring-pink-200 object-cover">
        <div class="ml-3 min-w-0">
          <p class="font-semibold text-gray-800 truncate"><?php echo e(Auth::user()->name); ?></p>
          <p class="text-xs text-gray-500 truncate"><?php echo e(ucfirst(Auth::user()->role ?? 'admin')); ?></p>
        </div>
      </div>

      <!-- Menu -->
      <nav class="flex-1 overflow-y-auto">
        <ul class="py-3 space-y-1">
          <li>
            <a href="#" class="sidebar-item group flex items-center px-4 py-2.5 text-gray-700 hover:bg-pink-50 rounded-lg mx-2">
              <span class="h-8 w-8 rounded-md bg-pink-100 text-pink-600 grid place-items-center mr-3">
                <i class="fas fa-shopping-bag"></i>
              </span>
              <span class="font-medium">Ventas</span>
              <span class="ml-auto bg-red-100 text-red-700 text-[10px] px-2 py-0.5 rounded-full">5 nuevas</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="sidebar-item group flex items-center px-4 py-2.5 text-gray-700 hover:bg-pink-50 rounded-lg mx-2 <?php echo e(request()->routeIs('admin.index') || request()->routeIs('productos.*') ? 'active' : ''); ?>">
              <span class="h-8 w-8 rounded-md bg-pink-100 text-pink-600 grid place-items-center mr-3">
                <i class="fas fa-cookie"></i>
              </span>
              <span class="font-medium">Productos</span>
            </a>
          </li>
          <li>
            <a href="#" class="sidebar-item group flex items-center px-4 py-2.5 text-gray-700 hover:bg-pink-50 rounded-lg mx-2">
              <span class="h-8 w-8 rounded-md bg-pink-100 text-pink-600 grid place-items-center mr-3">
                <i class="fas fa-images"></i>
              </span>
              <span class="font-medium">Galería</span>
            </a>
          </li>
          <li>
            <a href="#" class="sidebar-item group flex items-center px-4 py-2.5 text-gray-700 hover:bg-pink-50 rounded-lg mx-2">
              <span class="h-8 w-8 rounded-md bg-pink-100 text-pink-600 grid place-items-center mr-3">
                <i class="fas fa-users"></i>
              </span>
              <span class="font-medium">Clientes</span>
            </a>
          </li>
          <li>
            <a href="#" class="sidebar-item group flex items-center px-4 py-2.5 text-gray-700 hover:bg-pink-50 rounded-lg mx-2">
              <span class="h-8 w-8 rounded-md bg-pink-100 text-pink-600 grid place-items-center mr-3">
                <i class="fas fa-chart-line"></i>
              </span>
              <span class="font-medium">Reportes</span>
            </a>
          </li>
          <li>
            <a href="#" class="sidebar-item group flex items-center px-4 py-2.5 text-gray-700 hover:bg-gray-50 rounded-lg mx-2">
              <span class="h-8 w-8 rounded-md bg-pink-600 text-indigo-600 grid place-items-center mr-3">
                <i class="fas fa-cog"></i>
              </span>
              <span class="font-medium">Configuración</span>
            </a>
          </li>
        </ul>
      </nav>
      <?php if(auth()->guard()->check()): ?>
        <!-- Logout -->
       <form method="POST" action="<?php echo e(route('logout')); ?>" class="px-4 py-4 border-t border-gray-100">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full flex items-center justify-center gap-2 text-gray-700 hover:text-red-600 hover:bg-red-50 px-4 py-2 rounded-lg transition">
                  <i class="fas fa-sign-out-alt"></i>
                  <span class="font-medium">Cerrar Sesión</span>
                </button>
            </form>
      <?php endif; ?>
      
    </aside>
   

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Top Navigation -->
      <header class="bg-white/90 backdrop-blur-sm shadow-sm z-10 border-b border-gray-100">
        <div class="flex items-center justify-between px-6 py-3">
          <!-- Mobile menu button -->
          <button class="md:hidden text-gray-600 focus:outline-none" id="toggleSidebar">
            <i class="fas fa-bars text-xl"></i>
          </button>

          <!-- Search -->
          <form action="<?php echo e(route('admin.index')); ?>" method="GET" class="relative mx-4 flex-1 max-w-md">
            <input type="hidden" name="category" value="<?php echo e(request('category','todos')); ?>">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Buscar productos..." class="w-full pl-10 pr-12 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-200 focus:border-transparent">
            <button type="submit" class="absolute right-1 top-1 bottom-1 px-3 rounded-md bg-pink-500 text-white hover:bg-pink-600 active:bg-pink-700 transition">
              Buscar
            </button>
          </form>

          <!-- Right side icons -->
          <div class="flex items-center space-x-4">
            <button class="relative text-gray-600 hover:text-gray-800">
              <i class="fas fa-bell text-xl"></i>
              <span class="notification-dot"></span>
            </button>
            <button class="relative text-gray-600 hover:text-gray-800">
              <i class="fas fa-envelope text-xl"></i>
              <span class="notification-dot"></span>
            </button>
            <div class="h-8 w-8 rounded-full bg-pink-200 flex items-center justify-center">
              <span class="text-pink-700 font-medium">LR</span>
            </div>
          </div>
        </div>
      </header>

      <!-- Main content -->
      <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
        <?php echo $__env->yieldContent('content'); ?>
      </main>
    </div>

    <!-- Script para sidebar responsivo -->
    <script>
      const btn = document.getElementById('toggleSidebar');
      const sidebar = document.getElementById('sidebar');
      btn?.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
      });
    </script>
  </body>
</html>
<?php /**PATH C:\xampp\htdocs\FluffyBakery\resources\views/layouts/app.blade.php ENDPATH**/ ?>