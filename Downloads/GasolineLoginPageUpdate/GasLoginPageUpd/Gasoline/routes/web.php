<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| LOGIN PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

/*
|--------------------------------------------------------------------------
| FAKE LOGIN (FRONTEND TEST ONLY)
|--------------------------------------------------------------------------
*/

Route::get('/login', function (Request $request) {
    $email = $request->email;

    if ($email === 'admin@gmail.com') {
        return redirect('/admin');
    } elseif ($email === 'clerk@gmail.com') {
        return redirect('/clerk');
    } else {
        return redirect('/customer');
    }
});

/*
|--------------------------------------------------------------------------
| DASHBOARDS
|--------------------------------------------------------------------------
*/

Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/clerk', function () {
    return view('clerk.dashboard');
});

Route::get('/customer', function () {
    return view('custmer.dashboard'); // keep typo if folder is "custmer"
});

/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD (DEMO ONLY)
|--------------------------------------------------------------------------
*/

Route::get('/forgot-password', function () {
    return "Forgot Password Page (Demo Only)";
});

/*
|--------------------------------------------------------------------------
| CUSTOMER ORDERS (DEMO ONLY)
|--------------------------------------------------------------------------
*/

Route::post('/customer/orders', function (Request $request) {
    return "Order submitted successfully (demo only)";
});