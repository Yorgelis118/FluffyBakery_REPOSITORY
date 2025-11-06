@extends('layouts.main')
@section('title', 'Inicio')

@section('content')
    <!-- Carrousel -->
        
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
             <!-- Carousel wrapper -->
            <div class="relative h-96 overflow-hidden rounded-lg md:h-[60rem]">
               <!-- Item 1-->
                <div class="duration-700 ease-in-out h-full" data-carousel-item>
                    <div class="relative w-full h-full">
                        <img src="{{ asset('img/galletasyvelas.jpeg') }}" class="absolute inset-0 z-0 w-full h-full object-cover object-center" alt="...">
                        <div class="absolute inset-0 z-10 bg-gray-900/30 flex items-center justify-center">
                            <div class="max-w-3xl mx-auto w-full text-center px-6">
                                <h1 class="text-[5px] md:text-[4rem] font-bold text-white">Descubre el cataalogo de nuestras deliciosas galletas</h1>
                                <br><br>
                                <a href="{{ url('productos#galletas') }}" class="inline-block mt-4 md:mt-6 px-5 py-2 md:px-6 md:py-3 bg-pink-600 text-white rounded-lg shadow hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-400">
                                    Ver galletas
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
                    <div class="relative w-full h-full">
                        <img src="{{ asset('img/torta2-1.jpeg') }}" class="absolute inset-0 z-0 bg-cover w-full h-full object-center" alt="...">
                        <div class="absolute inset-0 z-10 bg-gray-900/30 flex items-center justify-center">
                            <div class="max-w-3xl mx-auto w-full text-center px-6">
                            <h1 class="text-[5px] md:text-[5rem] font-bold text-white">¡Déjate seducir por un sinfín de opciones! <br><br></h1>
                            <h3 class="text-2xl font-medium text-white">Sumérgete en nuestra gran variedad de tortas.</h3>
                                <a href="{{ url('productos#galletas') }}" class="inline-block mt-4 md:mt-6 px-5 py-2 md:px-6 md:py-3 bg-pink-600 text-white rounded-lg shadow hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-400">
                                    Ver tortas
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
                    <div class="relative w-full h-full">
                        <img src="{{ asset('img/brownieoscuro1.jpeg') }}" class="absolute inset-0 z-0 w-full h-full object-cover object-center" alt="...">
                        <div class="absolute inset-0 z-10 bg-gray-900/30 flex items-center justify-center">
                        <div class="max-w-3xl mx-auto w-full text-center px-6">
                            <h1 class="text-[5px] md:text-[5rem] font-bold text-white">La búsqueda del brownie perfecto termina aquí <br><br></h1>
                            <h3 class="text-2xl font-bold text-white">Prueba nuestra selección única y deliciosa</h3>
                                <a href="{{ url('productos#galletas') }}" class="inline-block mt-4 md:mt-6 px-5 py-2 md:px-6 md:py-3 bg-pink-600 text-white rounded-lg shadow hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-400">
                                    Ver brownies
                                </a>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
                    <div class="relative w-full h-full">
                        <img src="{{ asset('img/cupcakesx3.jpeg') }}" class="absolute inset-0 z-0 w-full h-full object-cover object-center" alt="...">
                        <div class="absolute inset-0 z-10 bg-gray-900/30 flex items-center justify-center">
                        <div class="max-w-3xl mx-auto w-full text-center px-6">
                            <h1 class="text-[50px] md:text-[5rem] font-bold text-white">Pequeños Placeres... <br> Grandes Sonrisas<br><br></h1>
                            <h3 class="text-2xl font-bold text-white">Explora nuestra variedad de cupcakes</h3>
                                <a href="{{ url('productos#galletas') }}" class="inline-block mt-4 md:mt-6 px-5 py-2 md:px-6 md:py-3 bg-pink-600 text-white rounded-lg shadow hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-400">
                                    Ver cupcakes
                                </a>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
                    <div class="relative w-full h-full">
                        <img src="{{ asset('img/alfajoresmodelo2.jpeg') }}" class="absolute inset-0 z-0 w-full h-full object-cover object-center" alt="...">
                        <div class="absolute inset-0 z-10 bg-gray-900/30 flex items-center justify-center">
                        <div class="max-w-3xl mx-auto w-full text-center px-6">
                            <h1 class="text-[50px] md:text-[5rem] font-bold text-white">Date un gusto y encuentra tu sabor favorito en nuestra selección<br><br></h1>
                            <h3 class="text-2xl font-bold text-white">Mira nuestros alfajores</h3>
                                <a href="{{ url('productos#galletas') }}" class="inline-block mt-4 md:mt-6 px-5 py-2 md:px-6 md:py-3 bg-pink-600 text-white rounded-lg shadow hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-400">
                                    Ver alfajores
                                </a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
            </div>

            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>

    <!-- Fin Carrousel -->

<!-- Producto destacado -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-6 flex flex-col md:flex-row items-center gap-4">

        <!-- Texto a la izquierda -->
        <div class="md:w-1/2 text-left">
            <h2 class="text-3xl font-bold mb-4">Galleta Pie de Limón</h2>
            <p class="text-gray-700">La favorita de la casa que siempre está en nuestro top 1, nuestra galleta pie de limón.</p>
        </div>

        <!-- Imagen a la derecha -->
        <div class="gap-10 flex justify-center md:justify-end">
            <img src="{{ asset('img/galletapiedelimon1.jpeg') }}" alt="Galleta Pie de Limón" class="rounded shadow-lg w-80 h-80 object-cover">
        </div>

    </div>
</section>
<!-- Fin producto destacado -->

    <!-- Reseña de quienes somos -->
        <!-- Quiénes Somos -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-6 md:mb-0">
                    <img src="{{ asset('img/todasgalletasgeneral.jpeg') }}" alt="Quiénes Somos" class="rounded shadow-lg mx-auto w-64 h-64 object-cover rounded">
                </div>
                <div class="md:w-1/2 md:pl-10">
                    <h2 class="text-3xl font-bold mb-4">¿Quiénes Somos?</h2>
                    <p class="text-gray-700 mb-6">Somos una reposteria que busca esparcir amor y felicidad a nuestros amigos y seres queridos por medio de tortas, galletas y postres que hagan nuestros días distintos.</p>
                    
                </div>
            </div>
        </section>


    <!-- Fin de reseña -->


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.getElementById('default-carousel');
        if (!carousel) return;

        const items = Array.from(carousel.querySelectorAll('[data-carousel-item]'));
        const indicators = Array.from(carousel.querySelectorAll('[data-carousel-slide-to]'));
        const prevBtn = carousel.querySelector('[data-carousel-prev]');
        const nextBtn = carousel.querySelector('[data-carousel-next]');

        let currentIndex = 0;
        let autoTimer = null;
        const autoIntervalMs = 5000;

        function updateIndicators(index) {
            indicators.forEach((btn, i) => {
                btn.setAttribute('aria-current', i === index ? 'true' : 'false');
                btn.classList.toggle('bg-white', i === index);
                btn.classList.toggle('bg-white/50', i !== index);
                btn.classList.toggle('ring-2', i === index);
                btn.classList.toggle('ring-white', i === index);
            });
        }

        function showSlide(index) {
            if (items.length === 0) return;
            const safeIndex = (index + items.length) % items.length;
            items.forEach((el, i) => {
                if (i === safeIndex) {
                    el.classList.remove('hidden');
                } else {
                    el.classList.add('hidden');
                }
            });
            currentIndex = safeIndex;
            updateIndicators(currentIndex);
        }

        function next() { showSlide(currentIndex + 1); }
        function prev() { showSlide(currentIndex - 1); }

        function startAuto() {
            stopAuto();
            autoTimer = setInterval(next, autoIntervalMs);
        }
        function stopAuto() {
            if (autoTimer) clearInterval(autoTimer);
            autoTimer = null;
        }

        indicators.forEach((btn) => {
            btn.addEventListener('click', () => {
                const to = parseInt(btn.getAttribute('data-carousel-slide-to')) || 0;
                showSlide(to);
            });
        });
        if (prevBtn) prevBtn.addEventListener('click', prev);
        if (nextBtn) nextBtn.addEventListener('click', next);

        carousel.addEventListener('mouseenter', stopAuto);
        carousel.addEventListener('mouseleave', startAuto);

        // Initialize
        showSlide(0);
        startAuto();
    });
    </script>
@endsection