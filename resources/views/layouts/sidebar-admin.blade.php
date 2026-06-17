<a href="{{ route('admin.dashboard') }}" 
   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100' : '' }}">
    📊 Dashboard
</a>
<a href="{{ route('admin.users.index') }}" 
   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.users.*') ? 'bg-gray-100' : '' }}">
    👥 Users
</a>
<a href="{{ route('admin.products.index') }}" 
   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.products.*') ? 'bg-gray-100' : '' }}">
    📦 Products
</a>
<a href="{{ route('admin.orders.index') }}" 
   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.orders.*') ? 'bg-gray-100' : '' }}">
    📋 Orders
</a>