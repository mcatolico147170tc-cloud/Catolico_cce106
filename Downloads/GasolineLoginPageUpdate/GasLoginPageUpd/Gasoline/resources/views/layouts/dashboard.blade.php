<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Tailwind ALWAYS LOAD -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-1">
            @yield('page-title')
        </h1>

        <p class="text-gray-500 mb-6">
            @yield('page-subtitle')
        </p>

        {{-- MAIN CONTENT --}}
        @yield('dashboard-content')

    </div>

</body>
</html>