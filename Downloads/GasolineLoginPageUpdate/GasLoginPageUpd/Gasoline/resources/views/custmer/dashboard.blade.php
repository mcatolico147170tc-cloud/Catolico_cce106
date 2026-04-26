@extends('layouts.dashboard')

@section('title', 'Customer Dashboard - Krude Gas')
@section('page-title', 'Customer Dashboard')
@section('page-subtitle', 'Manage your fuel pre-orders')

@section('dashboard-content')

<div class="grid grid-cols-12 gap-5">

    {{-- LEFT --}}
    <div class="col-span-12 lg:col-span-7 space-y-5">

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

            <h2 class="text-lg font-bold mb-4">New Pre-Order</h2>

            <form action="/customer/orders" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="text-sm font-semibold">Fuel Type</label>
                    <select name="fuel_type" class="w-full p-3 border rounded-xl">
                        <option>Krude-Premium</option>
                        <option>Krude-Regular</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Quantity</label>
                    <input type="number" name="quantity" class="w-full p-3 border rounded-xl">
                </div>

                <button class="w-full bg-amber-500 text-white py-3 rounded-xl font-bold">
                    Submit Order
                </button>

            </form>
        </div>

    </div>

    {{-- RIGHT --}}
    <div class="col-span-12 lg:col-span-5">

        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <h2 class="font-bold mb-2">Quick Info</h2>
            <p class="text-gray-500 text-sm">System is running normally</p>
        </div>

    </div>

</div>

@endsection