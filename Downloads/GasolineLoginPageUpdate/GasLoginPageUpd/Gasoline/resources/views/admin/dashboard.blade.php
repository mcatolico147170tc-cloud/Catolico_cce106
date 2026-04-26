@extends('layouts.app')
@section('title', 'Admin Dashboard - Krude Gas')

@section('content')
<div class="flex h-screen overflow-hidden bg-gray-100">

    @include('layouts.sidebar', ['active' => 'admin'])

    <div class="flex-1 flex flex-col h-screen overflow-hidden">

        <header class="flex-shrink-0 flex items-center justify-between px-6 py-4" style="background: #1E3A5F;">
            <div class="flex items-center gap-3">
                <button class="text-white/60 hover:text-white transition-colors mr-1">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
                <div>
                    <h1 class="text-white font-bold text-lg leading-tight">Admin Dashboard</h1>
                    <p class="text-white/50 text-xs">System administration and analytics</p>
                </div>
            </div>
            <div class="flex items-center gap-1 bg-white/10 rounded-lg px-3 py-1.5 text-white text-sm font-semibold">
                <a href="?lang=en" class="text-white">EN</a>
                <span class="text-white/30">|</span>
                <a href="?lang=fil" class="text-white/50 hover:text-white">FIL</a>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto">
            <div class="p-5 space-y-5">

                {{-- Stat Cards --}}
                <div class="grid grid-cols-3 gap-5">
                    <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: #FEF3C7;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2">
                                    <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">TODAY +12%</span>
                        </div>
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Reservations</div>
                        <div class="text-3xl font-bold" style="color: #F59E0B;">{{ $totalReservations ?? 142 }}</div>
                    </div>
                    <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: #1E3A5F;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                    <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">THIS WEEK +8%</span>
                        </div>
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Revenue</div>
                        <div class="text-3xl font-bold text-gray-900">₱{{ number_format($totalRevenue ?? 28400) }}</div>
                    </div>
                    <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-red-100">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2">
                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                                    <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-red-600 bg-red-50 px-2 py-0.5 rounded-full">CRITICAL Action Needed</span>
                        </div>
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Low Stock Alerts</div>
                        <div class="text-3xl font-bold text-red-600">{{ $lowStockAlerts ?? 2 }}</div>
                    </div>
                </div>

                {{-- Chart + Restock --}}
                <div class="grid grid-cols-12 gap-5">
                    <div class="col-span-12 lg:col-span-7 bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <h2 class="text-base font-bold text-gray-900">Daily Reservations</h2>
                                <p class="text-xs text-gray-400 mt-0.5">Last 7 days performance</p>
                            </div>
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: #1E3A5F;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                    <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
                                    <polyline points="16 7 22 7 22 13"/>
                                </svg>
                            </div>
                        </div>
                        <div class="relative h-44">
                            <canvas id="reservationsChart"></canvas>
                        </div>
                        <div class="flex items-center gap-5 mt-4 pt-3 border-t border-gray-100">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full" style="background: #F59E0B;"></div>
                                <span class="text-xs text-gray-600 font-medium">Krude-Premium</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full" style="background: #1E3A5F;"></div>
                                <span class="text-xs text-gray-600 font-medium">Krude-Regular</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-5 bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-base font-bold text-gray-900">Inventory Restock</h2>
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: #F59E0B;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                                </svg>
                            </div>
                        </div>
                        <form action="{{ route('admin.inventory.restock') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Fuel Type</label>
                                <select name="fuel_type" class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 text-sm text-gray-800 bg-white appearance-none cursor-pointer">
                                    <option value="Krude-Premium">Krude-Premium</option>
                                    <option value="Krude-Regular">Krude-Regular</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Quantity (Liters)</label>
                                <input type="number" name="quantity" placeholder="0" min="1"
                                    class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 text-sm text-gray-800 placeholder-gray-400">
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Current Stock Levels</div>
                                <div class="space-y-2.5">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-700 font-medium">Krude-Premium</span>
                                        <span class="text-sm font-bold" style="color: #F59E0B;">{{ number_format($premiumStock ?? 8500) }}L</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-700 font-medium">Krude-Regular</span>
                                        <span class="text-sm font-bold text-red-500">{{ number_format($regularStock ?? 2300) }}L</span>
                                    </div>
                                </div>
                            </div>
                            @if(session('restock_success'))
                                <div class="p-3 rounded-xl bg-green-50 border border-green-200 text-sm text-green-700">{{ session('restock_success') }}</div>
                            @endif
                            <button type="submit" class="btn-primary w-full py-3 rounded-xl text-white font-bold text-sm">Add Stock</button>
                        </form>
                    </div>
                </div>

                {{-- User Management --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
                        <div>
                            <h2 class="text-base font-bold text-gray-900">User Management</h2>
                            <p class="text-xs text-gray-400 mt-0.5">Manage system users and permissions</p>
                        </div>
                        <a href="{{ route('admin.users.create') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl text-white text-sm font-bold" style="background: #1E3A5F;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="8.5" cy="7" r="4"/>
                                <line x1="20" y1="8" x2="20" y2="14"/>
                                <line x1="23" y1="11" x2="17" y2="11"/>
                            </svg>
                            Add User
                        </a>
                    </div>
                    <div class="px-6 py-3 flex items-center gap-3 bg-gray-50/50 border-b border-gray-100">
                        <div class="relative flex-1 max-w-sm">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                            <input type="text" placeholder="Search users..." class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-amber-400 bg-white">
                        </div>
                        <select class="px-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-amber-400 bg-white">
                            <option>All Roles</option>
                            <option>Customer</option>
                            <option>Clerk</option>
                            <option>Driver</option>
                            <option>Admin</option>
                        </select>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($users ?? [] as $user)
                                <tr class="table-row">
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @php $roleColors = ['Customer'=>'bg-blue-800','Clerk'=>'bg-amber-500','Driver'=>'bg-teal-600','Admin'=>'bg-purple-600']; @endphp
                                        <span class="px-2.5 py-1 rounded-lg text-xs font-bold text-white {{ $roleColors[$user->role] ?? 'bg-gray-400' }}">{{ $user->role }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($user->is_active)
                                            <span class="flex items-center gap-1.5 text-xs font-semibold text-green-700"><span class="w-2 h-2 rounded-full bg-green-500"></span>Active</span>
                                        @else
                                            <span class="flex items-center gap-1.5 text-xs font-semibold text-red-600"><span class="w-2 h-2 rounded-full bg-red-500"></span>Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="px-3 py-1.5 text-xs font-bold text-white rounded-lg" style="background: #1E3A5F;">Edit</a>
                                            @if($user->is_active)
                                                <form action="{{ route('admin.users.deactivate', $user->id) }}" method="POST" class="inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="px-3 py-1.5 text-xs font-bold text-white rounded-lg bg-red-500">Deactivate</button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.users.activate', $user->id) }}" method="POST" class="inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="px-3 py-1.5 text-xs font-bold text-white rounded-lg bg-green-600">Activate</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                @php $sampleUsers = [
                                    ['name'=>'Juan Dela Cruz','email'=>'juan.delacruz@email.com','role'=>'Customer','color'=>'bg-blue-800','active'=>true],
                                    ['name'=>'Maria Santos','email'=>'maria.santos@email.com','role'=>'Customer','color'=>'bg-blue-800','active'=>true],
                                    ['name'=>'Pedro Reyes','email'=>'pedro.reyes@email.com','role'=>'Clerk','color'=>'bg-amber-500','active'=>true],
                                    ['name'=>'Ana Garcia','email'=>'ana.garcia@email.com','role'=>'Driver','color'=>'bg-teal-600','active'=>true],
                                    ['name'=>'Carlos Mendoza','email'=>'carlos.mendoza@email.com','role'=>'Customer','color'=>'bg-blue-800','active'=>false],
                                ]; @endphp
                                @foreach($sampleUsers as $u)
                                <tr class="table-row">
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $u['name'] }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $u['email'] }}</td>
                                    <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-lg text-xs font-bold text-white {{ $u['color'] }}">{{ $u['role'] }}</span></td>
                                    <td class="px-6 py-4">
                                        @if($u['active'])
                                            <span class="flex items-center gap-1.5 text-xs font-semibold text-green-700"><span class="w-2 h-2 rounded-full bg-green-500"></span>Active</span>
                                        @else
                                            <span class="flex items-center gap-1.5 text-xs font-semibold text-red-600"><span class="w-2 h-2 rounded-full bg-red-500"></span>Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <button class="px-3 py-1.5 text-xs font-bold text-white rounded-lg" style="background: #1E3A5F;">Edit</button>
                                            @if($u['active'])
                                                <button class="px-3 py-1.5 text-xs font-bold text-white rounded-lg bg-red-500">Deactivate</button>
                                            @else
                                                <button class="px-3 py-1.5 text-xs font-bold text-white rounded-lg bg-green-600">Activate</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('reservationsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [
                {
                    label: 'Krude-Premium',
                    data: [18, 25, 20, 30, 28, 35, 22],
                    borderColor: '#F59E0B',
                    backgroundColor: 'rgba(245,158,11,0.08)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#F59E0B',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true,
                },
                {
                    label: 'Krude-Regular',
                    data: [12, 18, 15, 22, 20, 25, 16],
                    borderColor: '#1E3A5F',
                    backgroundColor: 'rgba(30,58,95,0.06)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#1E3A5F',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1E3A5F',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 10,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { font: { size: 11, family: 'Plus Jakarta Sans' }, color: '#9CA3AF' }
                },
                y: {
                    grid: { color: '#F3F4F6' },
                    border: { display: false },
                    ticks: { font: { size: 11, family: 'Plus Jakarta Sans' }, color: '#9CA3AF', maxTicksLimit: 5 }
                }
            }
        }
    });
</script>
@endpush
@endsection