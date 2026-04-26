<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Krude Gas Pre-Order System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            orange: '#F59E0B',
                            'orange-dark': '#D97706',
                            'orange-light': '#FEF3C7',
                            navy: '#1E3A5F',
                            'navy-dark': '#152A47',
                            'navy-mid': '#2D4A6E',
                            'navy-light': '#3D5A80',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover { background: rgba(245,158,11,0.15); }
        .sidebar-link.active { background: #F59E0B; color: white; }
        .sidebar-link.active svg { color: white; }
        .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
        .btn-primary { background: #F59E0B; transition: background 0.2s ease, transform 0.1s ease; }
        .btn-primary:hover { background: #D97706; transform: translateY(-1px); }
        .btn-primary:active { transform: translateY(0); }
        input:focus, select:focus { outline: none; border-color: #F59E0B; box-shadow: 0 0 0 3px rgba(245,158,11,0.15); }
        .badge-pending { background: #FEF3C7; color: #D97706; border: 1px solid #FCD34D; }
        .badge-ready { background: #DBEAFE; color: #1E40AF; border: 1px solid #93C5FD; }
        .badge-claimed { background: #D1FAE5; color: #065F46; border: 1px solid #6EE7B7; }
        .badge-inactive { background: #FEE2E2; color: #991B1B; border: 1px solid #FCA5A5; }
        .table-row { transition: background 0.15s ease; }
        .table-row:hover { background: #FAFAFA; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800">
    @yield('content')
    @stack('scripts')
</body>
</html>