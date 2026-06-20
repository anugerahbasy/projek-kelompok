<style>
    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 16px;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #6b7280;
        transition: all 0.2s ease;
        text-decoration: none;
        position: relative;
    }
    .sidebar-link:hover {
        background: #f3f4f6;
        color: #1f2937;
    }
    .sidebar-link.active {
        background: #ecfdf5;
        color: #059669;
        font-weight: 600;
    }
    .sidebar-link.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 24px;
        background: #059669;
        border-radius: 0 4px 4px 0;
    }
    .sidebar-link .icon {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .sidebar-link .badge {
        margin-left: auto;
        background: #e5e7eb;
        color: #4b5563;
        font-size: 0.65rem;
        padding: 2px 10px;
        border-radius: 20px;
        font-weight: 600;
    }
    .sidebar-link.active .badge {
        background: #d1fae5;
        color: #059669;
    }
</style>

<a href="{{ route('admin.dashboard') }}" 
   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <span class="icon">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
        </svg>
    </span>
    Dashboard
</a>

<a href="{{ route('admin.users.index') }}" 
   class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
    <span class="icon">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
    </span>
    Users
    <span class="badge">{{ \App\Models\User::count() }}</span>
</a>

<a href="{{ route('admin.products.index') }}" 
   class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
    <span class="icon">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
        </svg>
    </span>
    Products
    <span class="badge">{{ \App\Models\Product::count() }}</span>
</a>

<a href="{{ route('admin.orders.index') }}" 
   class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
    <span class="icon">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
        </svg>
    </span>
    Orders
    <span class="badge">{{ \App\Models\Order::count() }}</span>
</a>