<aside class="w-[200px] flex-shrink-0 flex flex-col h-screen sticky top-0" style="background: #1E3A5F;">

    {{-- Logo --}}
    <div class="px-5 py-5 border-b border-white/10">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background: #F59E0B;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 22V8l9-6 9 6v14"/>
                    <path d="M10 22V12h4v10"/>
                </svg>
            </div>
            <div>
                <div class="text-white font-bold text-sm leading-tight">Krude Gas</div>
                <div class="text-white/50 text-xs leading-tight">Pre-Order System</div>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-4 space-y-1">
        <a href="{{ route('customer.dashboard') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl {{ ($active ?? '') === 'customer' ? 'active' : 'text-white/70' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
            </svg>
            <span class="text-sm font-medium">Customer Dashboard</span>
        </a>

        <a href="{{ route('clerk.dashboard') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl {{ ($active ?? '') === 'clerk' ? 'active' : 'text-white/70' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            <span class="text-sm font-medium">Station Clerk</span>
        </a>

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl {{ ($active ?? '') === 'admin' ? 'active' : 'text-white/70' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2M12 20v2M2 12h2M20 12h2M19.07 19.07l-1.41-1.41M4.93 19.07l1.41-1.41"/>
            </svg>
            <span class="text-sm font-medium">Admin Dashboard</span>
        </a>
    </nav>

    {{-- User Profile --}}
    <div class="px-3 py-4 border-t border-white/10">
        <div class="flex items-center gap-3 px-2">
            <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold text-white" style="background: #F59E0B;">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="text-white text-sm font-semibold truncate">{{ auth()->user()->name ?? 'User' }}</div>
                <div class="text-white/50 text-xs truncate capitalize">{{ auth()->user()->role ?? 'user' }}</div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-white/50 hover:text-white transition-colors p-1" title="Logout">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

</aside>