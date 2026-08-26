<?php
session_start();

$role_routes = [
    'customer' => 'customer.php',
    'clerk' => 'clerk.php',
    'admin' => 'admin.php',
];

if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$requested_page = $forced_page ?? ($_GET['page'] ?? $_SESSION['user']['role']);
$page = array_key_exists($requested_page, $role_routes) ? $requested_page : $_SESSION['user']['role'];

if ($_SESSION['user']['role'] !== $page) {
    $user_role = $_SESSION['user']['role'];
    header('Location: ' . ($role_routes[$user_role] ?? 'index.php'));
    exit;
}

$currentPageUrl = $role_routes[$page];

// Demo data
$fuel_prices = [
    'premium' => 68.50,
    'regular' => 62.00
];

$orders = [
    ['id' => 'ORD-2024-010', 'customer' => 'Juan Dela Cruz', 'fuel' => 'Krude-Premium', 'liters' => 45, 'pickup' => '1:00 PM - 2:00 PM', 'status' => 'pending', 'date' => '2024-01-16'],
    ['id' => 'ORD-2024-008', 'customer' => 'Juan Dela Cruz', 'fuel' => 'Krude-Regular', 'liters' => 35, 'pickup' => '10:00 AM - 11:00 AM', 'status' => 'ready', 'date' => '2024-01-15'],
    ['id' => 'ORD-2024-005', 'customer' => 'Juan Dela Cruz', 'fuel' => 'Krude-Premium', 'liters' => 50, 'pickup' => '3:00 PM - 4:00 PM', 'status' => 'claimed', 'date' => '2024-01-14'],
];

$all_orders = [
    ['id' => 'ORD-2024-001', 'customer' => 'Juan Dela Cruz', 'fuel' => 'Krude-Premium', 'liters' => 50, 'pickup' => '10:00 AM - 11:00 AM', 'status' => 'pending', 'date' => '2024-01-16'],
    ['id' => 'ORD-2024-002', 'customer' => 'Maria Santos', 'fuel' => 'Krude-Regular', 'liters' => 30, 'pickup' => '11:00 AM - 12:00 PM', 'status' => 'ready', 'date' => '2024-01-16'],
    ['id' => 'ORD-2024-003', 'customer' => 'Pedro Reyes', 'fuel' => 'Krude-Premium', 'liters' => 40, 'pickup' => '2:00 PM - 3:00 PM', 'status' => 'claimed', 'date' => '2024-01-16'],
    ['id' => 'ORD-2024-004', 'customer' => 'Ana Garcia', 'fuel' => 'Krude-Regular', 'liters' => 25, 'pickup' => '3:00 PM - 4:00 PM', 'status' => 'pending', 'date' => '2024-01-16'],
    ['id' => 'ORD-2024-005', 'customer' => 'Carlos Mendoza', 'fuel' => 'Krude-Premium', 'liters' => 60, 'pickup' => '4:00 PM - 5:00 PM', 'status' => 'ready', 'date' => '2024-01-16'],
];

$users = [
    ['name' => 'Juan Dela Cruz', 'email' => 'juan.delacruz@email.com', 'role' => 'customer', 'status' => 'active'],
    ['name' => 'Maria Santos', 'email' => 'maria.santos@email.com', 'role' => 'customer', 'status' => 'active'],
    ['name' => 'Pedro Reyes', 'email' => 'pedro.reyes@email.com', 'role' => 'clerk', 'status' => 'active'],
    ['name' => 'Ana Garcia', 'email' => 'ana.garcia@email.com', 'role' => 'driver', 'status' => 'active'],
    ['name' => 'Carlos Mendoza', 'email' => 'carlos.mendoza@email.com', 'role' => 'customer', 'status' => 'inactive'],
];

$lang = $_GET['lang'] ?? 'en';
$lang = in_array($lang, ['en', 'fil'], true) ? $lang : 'en';

$translations = [
        'en' => [
        'update_fuel_price' => 'Update Fuel Price',
        'premium_fuel' => 'Premium Fuel (₱/L)',
        'regular_fuel' => 'Regular Fuel (₱/L)',
        'save_price' => 'Save Price',
        'customer_dashboard' => 'Customer Dashboard',
        'station_clerk' => 'Station Clerk',
        'admin_dashboard' => 'Admin Dashboard',
        'new_preorder' => 'New Pre-Order',
        'fuel_type' => 'Fuel Type',
        'quantity_liters' => 'Quantity (Liters)',
        'pickup_time_slot' => 'Pickup Time Slot',
        'select_time_slot' => 'Select time slot',
        'submit_preorder' => 'Submit Pre-Order',
        'quick_info' => 'Quick Info',
        'station_hours' => 'Station Hours',
        'my_orders' => 'My Orders',
        'search_orders' => 'Search orders...',
        'all_status' => 'All Status',
        'order_id' => 'Order ID',
        'customer_name' => 'Customer Name',
        'liters' => 'Liters',
        'pickup_time' => 'Pickup Time',
        'status' => 'Status',
        'date' => 'Date',
        'actions' => 'Actions',
        'pending' => 'Pending',
        'ready_pickup' => 'Ready for Pickup',
        'claimed' => 'Claimed',
        'mark_ready' => 'Mark Ready',
        'mark_claimed' => 'Mark Claimed',
        'completed' => 'Completed',
        'manage_orders' => 'Manage Orders',
        'new_walkin' => 'New Walk-In Order',
        'enter_name' => 'Enter name',
        'create_order' => 'Create Order',
        'pending_orders' => 'PENDING ORDERS',
        'ready_for_pickup' => 'READY FOR PICKUP',
        'claimed_today' => 'CLAIMED TODAY',
        'total_reservations' => 'TOTAL RESERVATIONS',
        'total_revenue' => 'TOTAL REVENUE',
        'low_stock_alerts' => 'LOW STOCK ALERTS',
        'daily_reservations' => 'Daily Reservations',
        'last_7_days' => 'Last 7 days performance',
        'inventory_restock' => 'Inventory Restock',
        'current_stock' => 'CURRENT STOCK LEVELS',
        'add_stock' => 'Add Stock',
        'user_management' => 'User Management',
        'manage_users' => 'Manage system users and permissions',
        'search_users' => 'Search users...',
        'all_roles' => 'All Roles',
        'name' => 'Name',
        'email' => 'Email',
        'role' => 'Role',
        'add_user' => 'Add User',
        'edit' => 'Edit',
        'deactivate' => 'Deactivate',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'important_note' => 'Important: Pre-orders must be placed at least 2 hours before pickup time.',
        'today' => 'TODAY',
        'this_week' => 'THIS WEEK',
        'critical' => 'CRITICAL',
        'action_needed' => 'Action Needed',
    ],
    'fil' => [
    'update_fuel_price' => 'I-update ang Presyo sa Gasolina',
    'premium_fuel' => 'Premium na Gasolina (₱/L)',
    'regular_fuel' => 'Regular na Gasolina (₱/L)',
    'save_price' => 'I-save ang Presyo',
    'customer_dashboard' => 'Dashboard ng Customer',
    'station_clerk' => 'Clerk ng Istasyon',
    'admin_dashboard' => 'Dashboard ng Admin',
    'new_preorder' => 'Bagong Pre-Order',
    'fuel_type' => 'Uri ng Gasolina',
    'quantity_liters' => 'Dami (Litro)',
    'pickup_time_slot' => 'Oras ng Pagkuha',
    'select_time_slot' => 'Pumili ng oras',
    'submit_preorder' => 'Isumite ang Pre-Order',
    'quick_info' => 'Mabilis na Impormasyon',
    'station_hours' => 'Oras ng Istasyon',
    'my_orders' => 'Aking mga Order',
    'search_orders' => 'Maghanap ng order...',
    'all_status' => 'Lahat ng Status',
    'order_id' => 'ID ng Order',
    'customer_name' => 'Pangalan ng Customer',
    'liters' => 'Litro',
    'pickup_time' => 'Oras ng Pagkuha',
    'status' => 'Status',
    'date' => 'Petsa',
    'actions' => 'Aksyon',
    'pending' => 'Nakabinbin',
    'ready_pickup' => 'Handa na para Kunin',
    'claimed' => 'Nakuha na',
    'mark_ready' => 'Markahan Bilang Handa',
    'mark_claimed' => 'Markahan Bilang Nakuha',
    'completed' => 'Tapos na',
    'manage_orders' => 'Pamahalaan ang mga Order',
    'new_walkin' => 'Bagong Walk-In na Order',
    'enter_name' => 'Ilagay ang pangalan',
    'create_order' => 'Gumawa ng Order',
    'pending_orders' => 'MGA NAKABINBING ORDER',
    'ready_for_pickup' => 'HANDA NA PARA KUNIN',
    'claimed_today' => 'NAKUHA NGAYON',
    'total_reservations' => 'KABUUANG RESERVASYON',
    'total_revenue' => 'KABUUANG KITA',
    'low_stock_alerts' => 'BABALA SA MABABANG STOCK',
    'daily_reservations' => 'Araw-araw na Reservasyon',
    'last_7_days' => 'Performance ng nakaraang 7 araw',
    'inventory_restock' => 'Dagdag ng Imbentaryo',
    'current_stock' => 'KASALUKUYANG ANTAS NG STOCK',
    'add_stock' => 'Magdagdag ng Stock',
    'user_management' => 'Pamamahala ng User',
    'manage_users' => 'Pamahalaan ang mga user at kanilang pahintulot',
    'search_users' => 'Maghanap ng user...',
    'all_roles' => 'Lahat ng Role',
    'name' => 'Pangalan',
    'email' => 'Email',
    'role' => 'Role',
    'add_user' => 'Magdagdag ng User',
    'edit' => 'I-edit',
    'deactivate' => 'I-deactivate',
    'active' => 'Aktibo',
    'inactive' => 'Hindi Aktibo',
    'important_note' => 'Tandaan: Ang mga pre-order ay dapat gawin nang hindi bababa sa 2 oras bago ang oras ng pagkuha.',
    'today' => 'NGAYON',
    'this_week' => 'NGAYONG LINGGO',
    'critical' => 'KRITIKAL',
    'action_needed' => 'Kailangan ng Aksyon'
    ]
];

$t = $translations[$lang];

include __DIR__ . '/layout.php';
?>
