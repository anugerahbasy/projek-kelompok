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

<a href="{{ route('kurir.dashboard') }}" 
   class="sidebar-link {{ request()->routeIs('kurir.dashboard') ? 'active' : '' }}">
    <span class="icon">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
        </svg>
    </span>
    Dashboard
</a>

<a href="{{ route('kurir.deliveries.index') }}" 
   class="sidebar-link {{ request()->routeIs('kurir.deliveries.*') ? 'active' : '' }}">
    <span class="icon">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
        </svg>
    </span>
    Pengiriman
    <span class="badge">{{ \App\Models\Delivery::where('kurir_id', auth()->id())->where('status', 'pending')->count() }}</span>
</a>

<a href="{{ route('kurir.ratings.index') }}" 
   class="sidebar-link {{ request()->routeIs('kurir.ratings.*') ? 'active' : '' }}">
    <span class="icon">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
        </svg>
    </span>
    Rating
</a>