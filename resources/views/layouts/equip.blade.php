<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futbol Femení - @yield('title', 'Inici')</title>
    
    @vite(['resources/css/app.css','resources/js/app.js']) 
</head>

<body class="bg-gray-50 text-gray-800 antialiased">
    
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-3xl font-bold text-gray-900">Futbol Femení App</h1>
            
            @include('partials.menu')
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer>
        <div class="container mx-auto px-4 py-6 text-center text-gray-500 border-t border-gray-200 mt-8">
            <p>&copy; {{ date('Y') }} La Meva Aplicació. Tots els drets reservats.</p>
        </div>
    </footer>
</body>
</html>