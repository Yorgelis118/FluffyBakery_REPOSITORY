<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('img/logo.jpeg') }}" rel="icon">
    <title>@yield('title', 'Fluffy Bakery')</title>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- Fin Navbar -->

    <!-- Contenido Principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.footer')
    <!-- Fin Footer -->

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
