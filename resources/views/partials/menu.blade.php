<nav class="mt-4">
    {{-- La ruta 'home' ha d'existir a routes/web.php --}}
    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 font-medium mr-4">Inici</a>
    
    {{-- RUTES DE LLISTAT (FASES 1, 2, 3) --}}
    <a href="{{ route('equips.index') }}" class="text-blue-600 hover:text-blue-800 font-medium mr-4">Llistat d'Equips</a>
    <a href="{{ route('estadis.index') }}" class="text-blue-600 hover:text-blue-800 font-medium mr-4">Llistat d'Estadis</a>
    <a href="{{ route('jugadores.index') }}" class="text-blue-600 hover:text-blue-800 font-medium mr-4">Llistat de Jugadores</a>
    <a href="{{ route('partits.index') }}" class="text-blue-600 hover:text-blue-800 font-medium mr-4">Llistat de Partits</a>
    
    {{-- Altres rutes, com Contacte o Productes, mantingudes comentades --}}
    <!-- <a href="{{-- route('contacte.create') --}}" class="text-blue-600 hover:text-blue-800 mr-4">Contacte</a> -->
    <!-- <a href="{{-- route('productes.index') --}}" class="text-blue-600 hover:text-blue-800 mr-4">Productes</a> -->
</nav>