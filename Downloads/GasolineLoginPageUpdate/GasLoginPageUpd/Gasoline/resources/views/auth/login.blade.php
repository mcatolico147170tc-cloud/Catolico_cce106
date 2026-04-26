@extends('layouts.app')
@section('title', 'Sign In - Krude Gas')

@section('content')
<div class="min-h-screen flex flex-col" style="background: linear-gradient(135deg, #1E3A5F 0%, #2D4A6E 50%, #1E3A5F 100%);">

    <div class="flex-1 flex items-center justify-center px-6 py-10">
        <div class="w-full max-w-6xl flex gap-0 items-center">

            {{-- Left Panel --}}
            <div class="hidden lg:flex flex-col flex-1 pr-16 text-white">
                <div class="flex items-center gap-4 mb-12">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background: #F59E0B;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 22V8l9-6 9 6v14"/>
                            <path d="M10 22V12h4v10"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold tracking-tight">Krude Gas</div>
                        <div class="text-sm opacity-70">Pre-Order System</div>
                    </div>
                </div>

                <h1 class="text-4xl font-bold mb-4 leading-tight">Welcome Back!</h1>
                <p class="text-lg opacity-80 mb-10 leading-relaxed">
                    Streamline your fuel ordering process with our advanced pre-order management system.
                </p>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5" style="background: #F59E0B;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-base">Real-Time Order Tracking</div>
                            <div class="text-sm opacity-70 mt-0.5">Monitor your orders from placement to pickup</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5" style="background: #F59E0B;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                                <rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-base">Smart Inventory Management</div>
                            <div class="text-sm opacity-70 mt-0.5">Automated stock alerts and analytics</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5" style="background: #F59E0B;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                                <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-base">Secure & Reliable</div>
                            <div class="text-sm opacity-70 mt-0.5">Enterprise-grade security for your data</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Panel --}}
            <div class="w-full lg:w-[440px] bg-white rounded-3xl p-8 shadow-2xl">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Sign In</h2>
                    <p class="text-sm text-gray-500 mt-1">Select your role and enter your credentials</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Select Your Role</label>
                    <div class="space-y-2.5">

                        <label class="role-option flex items-center gap-3 p-3.5 rounded-xl border-2 cursor-pointer transition-all duration-200 border-amber-400 bg-amber-50" data-role="customer">
                            <input type="radio" name="role" value="customer" class="hidden" checked>
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: #F59E0B;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900 text-sm">Customer</div>
                                <div class="text-xs text-gray-500">Place and manage your fuel pre-orders</div>
                            </div>
                            <div class="check-icon w-5 h-5 rounded-full flex items-center justify-center" style="background: #10B981;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                            </div>
                        </label>

                        <label class="role-option flex items-center gap-3 p-3.5 rounded-xl border-2 cursor-pointer transition-all duration-200 border-gray-200 bg-white" data-role="clerk">
                            <input type="radio" name="role" value="clerk" class="hidden">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 bg-gray-100">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900 text-sm">Station Clerk</div>
                                <div class="text-xs text-gray-500">Manage orders and walk-in customers</div>
                            </div>
                            <div class="check-icon w-5 h-5 rounded-full hidden"></div>
                        </label>

                        <label class="role-option flex items-center gap-3 p-3.5 rounded-xl border-2 cursor-pointer transition-all duration-200 border-gray-200 bg-white" data-role="admin">
                            <input type="radio" name="role" value="admin" class="hidden">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 bg-gray-100">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2">
                                    <circle cx="12" cy="12" r="3"/>
                                    <path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2M12 20v2M2 12h2M20 12h2M19.07 19.07l-1.41-1.41M4.93 19.07l1.41-1.41"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900 text-sm">Administrator</div>
                                <div class="text-xs text-gray-500">Full system access and management</div>
                            </div>
                            <div class="check-icon w-5 h-5 rounded-full hidden"></div>
                        </label>

                    </div>
                </div>

                <form action="/login" method="GET">
                    @csrf

                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-semibold text-gray-700 mb-1.5">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            Email Address
                        </label>
                        <input type="email" name="email" placeholder="Enter your email"
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 text-sm text-gray-800 placeholder-gray-400 transition-all duration-200" required>
                        @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-semibold text-gray-700 mb-1.5">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            Password
                        </label>
                        <input type="password" name="password" placeholder="Enter your password"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 text-sm text-gray-800 placeholder-gray-400 transition-all duration-200" required>
                        @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 accent-amber-500">
                            <span class="text-sm text-gray-600">Remember me</span>
                        </label>
                        <a href="#" class="text-sm font-semibold" style="color: #F59E0B;">
                            Forgot Password?
                        </a>
                    </div>

                    <input type="hidden" name="role" id="selectedRole" value="customer">

                    <button type="submit" class="btn-primary w-full py-3.5 rounded-xl text-white font-bold text-sm flex items-center justify-center gap-2">
                        Sign In
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>

                    @if(session('error'))
                        <div class="p-3 rounded-xl bg-red-50 border border-red-200 text-sm text-red-600">{{ session('error') }}</div>
                    @endif

                    <p class="text-center text-sm text-gray-500">
                        Don't have an account?
                        <a href="mailto:admin@krudegas.com" class="font-bold" style="color: #F59E0B;">Contact Administrator</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <div class="text-center py-4 text-white/50 text-xs">
        © 2024 Krude Gas Pre-Order System. All rights reserved.
    </div>
</div>

@push('scripts')
<script>
    const roleOptions = document.querySelectorAll('.role-option');
    const selectedRoleInput = document.getElementById('selectedRole');

    roleOptions.forEach(option => {
        option.addEventListener('click', () => {
            roleOptions.forEach(o => {
                o.classList.remove('border-amber-400', 'bg-amber-50');
                o.classList.add('border-gray-200', 'bg-white');
                o.querySelector('.check-icon').classList.add('hidden');
            });
            option.classList.add('border-amber-400', 'bg-amber-50');
            option.classList.remove('border-gray-200', 'bg-white');
            option.querySelector('.check-icon').classList.remove('hidden');
            selectedRoleInput.value = option.dataset.role;
        });
    });
</script>
@endpush
@endsection