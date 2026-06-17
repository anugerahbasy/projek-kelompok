<a href="{{ route('client.dashboard') }}" 
   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('client.dashboard') ? 'bg-gray-100' : '' }}">
    📊 Dashboard
</a>
<a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
    📋 My Stock
</a>
<a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
    👤 Profile
</a>
<a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
    💳 Payment
</a>