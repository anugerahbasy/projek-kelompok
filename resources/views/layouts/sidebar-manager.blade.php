<a href="{{ route('manager.dashboard') }}" 
   class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('manager.dashboard') ? 'bg-gray-100' : '' }}">
    📊 Dashboard
</a>
<a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
    👥 Team
</a>
<a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
    📋 Reports
</a>
<a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
    ⚙️ Settings
</a>