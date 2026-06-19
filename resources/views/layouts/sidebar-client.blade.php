<a href="{{ route('client.dashboard') }}" 
   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('client.dashboard') ? 'bg-gray-100' : '' }}">
    📊 Dashboard
</a>

<a href="{{ route('client.stock.index') }}" 
   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('client.stock.*') ? 'bg-gray-100' : '' }}">
    📦 My Stock
</a>

<a href="{{ route('client.profile') }}" 
   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('client.profile') ? 'bg-gray-100' : '' }}">
    👤 Profile
</a>

<a href="{{ route('client.payment') }}" 
   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('client.payment') ? 'bg-gray-100' : '' }}">
    💳 Payment
</a>