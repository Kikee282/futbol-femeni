{{-- Contingut per a: resources/views/partials/menu.blade.php --}}

<nav class="p-4 bg-gray-800 text-white mb-6">
  
  {{-- Enllaç a Equips --}}
  <a href="{{ route('equips.index') }}" 
     class="px-2 hover:text-gray-300 {{ request()->routeIs('equips.*') ? 'font-bold underline' : '' }}">
     Equips
  </a>

  {{-- Enllaç a Estadis --}}
  <a href="{{ route('estadis.index') }}" 
     class="px-2 hover:text-gray-300 {{ request()->routeIs('estadis.*') ? 'font-bold underline' : '' }}">
     Estadis
  </a>

  {{-- Enllaç a Jugadores --}}
  <a href="{{ route('jugadores.index') }}" 
     class="px-2 hover:text-gray-300 {{ request()->routeIs('jugadores.*') ? 'font-bold underline' : '' }}">
     Jugadores
  </a>

  {{-- Enllaç a Partits --}}
  <a href="{{ route('partits.index') }}" 
     class="px-2 hover:text-gray-300 {{ request()->routeIs('partits.*') ? 'font-bold underline' : '' }}">
     Partits
  </a>

</nav>