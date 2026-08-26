@extends('layouts.app')
@section('title', 'Station Clerk Dashboard - Krude Gas')

@section('content')
<div class="flex h-screen overflow-hidden bg-gray-100">

    @include('layouts.sidebar', ['active' => 'clerk'])

    <div class="flex-1 flex flex-col h-screen overflow-hidden">

        <header class="flex-shrink-0 flex items-center justify-between px-6 py-4" style="background: #1E3A5F;">
            <div class="flex items-center gap-3">
                <button class="text-white/60 hover:text-white transition-colors mr-1">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
                <div>
                    <h1 class="text-white font-bold text-lg leading-tight">Station Clerk Dashboard</h1>
                    <p class="text-white/50 text-xs">Process orders and manage walk-ins</p>
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

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-5">
                    <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center py-7">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-3" style="background: #FEF3C7;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </div>
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Pending Orders</div>
                        <div class="text-4xl font-bold" style="color: #F59E0B;">{{ $pendingCount ?? 2 }}</div>
                    </div>
                    <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center py-7">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-3" style="background: #DBEAFE;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="2">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            </svg>
                        </div>
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Ready for Pickup</div>
                        <div class="text-4xl font-bold text-blue-800">{{ $readyCount ?? 2 }}</div>
                    </div>
                    <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center py-7">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-3" style="background: #D1FAE5;">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#065F46" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                        </div>
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Claimed Today</div>
                        <div class="text-4xl font-bold text-green-800">{{ $claimedCount ?? 1 }}</div>
                    </div>
                </div>

                {{-- Orders + Walk-In side by side --}}
                <div class="grid grid-cols-12 gap-5 items-start">

                    {{-- Manage Orders --}}
                    <div class="col-span-12 lg:col-span-8 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
                            <h2 class="text-base font-bold text-gray-900">Manage Orders</h2>
                            <div class="flex items-center gap-2">
                                <div class="relative">
                                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                    </svg>
                                    <input type="text" placeholder="Search orders..." class="pl-8 pr-3 py-2 text-xs border border-gray-200 rounded-lg w-36 focus:outline-none focus:border-amber-400">
                                </div>
                                <select class="px-3 py-2 text-xs border border-gray-200 rounded-lg focus:outline-none focus:border-amber-400 bg-white">
                                    <option>All Status</option>
                                    <option>Pending</option>
                                    <option>Ready</option>
                                    <option>Claimed</option>
                                </select>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Order ID</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer Name</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Fuel Type</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Liters</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Pickup Time</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @forelse($orders ?? [] as $order)
                                    <tr class="table-row">
                                        <td class="px-5 py-3.5 text-sm font-bold text-gray-900">{{ $order->order_id }}</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-700">{{ $order->customer_name }}</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">{{ $order->fuel_type }}</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">{{ $order->quantity }}L</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">{{ $order->pickup_slot }}</td>
                                        <td class="px-5 py-3.5">
                                            @if($order->status === 'Pending')
                                                <span class="badge-pending px-2.5 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Pending
                                                </span>
                                            @elseif($order->status === 'Ready')
                                                <span class="badge-ready px-2.5 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>Ready
                                                </span>
                                            @elseif($order->status === 'Claimed')
                                                <span class="badge-claimed px-2.5 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>Claimed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-3.5">
                                            @if($order->status === 'Pending')
                                                <form action="{{ route('clerk.orders.ready', $order->id) }}" method="POST" class="inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background: #1E3A5F;">Mark Ready</button>
                                                </form>
                                            @elseif($order->status === 'Ready')
                                                <form action="{{ route('clerk.orders.claimed', $order->id) }}" method="POST" class="inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-green-600 hover:bg-green-700">Mark Claimed</button>
                                                </form>
                                            @else
                                                <span class="text-xs text-gray-400 italic">Completed</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="table-row">
                                        <td class="px-5 py-3.5 text-sm font-bold text-gray-900">ORD-2024-001</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-700">Juan Dela Cruz</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">Krude-Premium</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">50L</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">10:00 AM - 11:00 AM</td>
                                        <td class="px-5 py-3.5"><span class="badge-pending px-2.5 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Pending</span></td>
                                        <td class="px-5 py-3.5"><button class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background: #1E3A5F;">Mark Ready</button></td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="px-5 py-3.5 text-sm font-bold text-gray-900">ORD-2024-002</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-700">Maria Santos</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">Krude-Regular</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">30L</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">11:00 AM - 12:00 PM</td>
                                        <td class="px-5 py-3.5"><span class="badge-ready px-2.5 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit"><span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>Ready</span></td>
                                        <td class="px-5 py-3.5"><button class="px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-green-600">Mark Claimed</button></td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="px-5 py-3.5 text-sm font-bold text-gray-900">ORD-2024-003</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-700">Pedro Reyes</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">Krude-Premium</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">40L</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">2:00 PM - 3:00 PM</td>
                                        <td class="px-5 py-3.5"><span class="badge-claimed px-2.5 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit"><span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>Claimed</span></td>
                                        <td class="px-5 py-3.5"><span class="text-xs text-gray-400 italic">Completed</span></td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="px-5 py-3.5 text-sm font-bold text-gray-900">ORD-2024-004</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-700">Ana Garcia</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">Krude-Regular</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">25L</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">3:00 PM - 4:00 PM</td>
                                        <td class="px-5 py-3.5"><span class="badge-pending px-2.5 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Pending</span></td>
                                        <td class="px-5 py-3.5"><button class="px-3 py-1.5 rounded-lg text-xs font-bold text-white" style="background: #1E3A5F;">Mark Ready</button></td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="px-5 py-3.5 text-sm font-bold text-gray-900">ORD-2024-005</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-700">Carlos Mendoza</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">Krude-Premium</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">60L</td>
                                        <td class="px-5 py-3.5 text-sm text-gray-600">4:00 PM - 5:00 PM</td>
                                        <td class="px-5 py-3.5"><span class="badge-ready px-2.5 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit"><span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>Ready</span></td>
                                        <td class="px-5 py-3.5"><button class="px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-green-600">Mark Claimed</button></td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Walk-In Order Form --}}
                    <div class="col-span-12 lg:col-span-4 bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-base font-bold text-gray-900">New Walk-In Order</h2>
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: #F59E0B;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                        </div>
                        <form action="{{ route('clerk.walkin.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="flex items-center gap-1.5 text-sm font-semibold text-gray-700 mb-2">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                    Customer Name
                                </label>
                                <input type="text" name="customer_name" placeholder="Enter name"
                                    class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 text-sm text-gray-800 placeholder-gray-400">
                            </div>
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
                            @if(session('walkin_success'))
                                <div class="p-3 rounded-xl bg-green-50 border border-green-200 text-sm text-green-700">{{ session('walkin_success') }}</div>
                            @endif
                            <button type="submit" class="btn-primary w-full py-3 rounded-xl text-white font-bold text-sm">Create Order</button>
                        </form>
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>
@endsection