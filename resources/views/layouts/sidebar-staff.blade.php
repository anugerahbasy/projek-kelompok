<a href="{{ route('staff.dashboard') }}" 
   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('staff.dashboard') ? 'bg-gray-100' : '' }}">
    📊 Dashboard
</a>
<a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
    📋 Orders
</a>
<a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
    📦 Inventory
</a>
<a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
    👥 Customers
</a>