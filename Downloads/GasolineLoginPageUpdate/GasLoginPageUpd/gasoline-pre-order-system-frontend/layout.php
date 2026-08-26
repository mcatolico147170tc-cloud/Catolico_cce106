<?php
$announcement = file_exists('announcement.txt')
    ? trim(file_get_contents('announcement.txt'))
    : '';
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <link rel="icon" type="image/png" href="public/images/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Krude Gas - Pre-Order System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            navy: '#1e3a5f',
                            'navy-dark': '#152d4a',
                            'navy-light': '#254a7a',
                            orange: '#f5a623',
                            'orange-dark': '#e09010',
                            'orange-light': '#fbb040',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f0f2f5;
        }

        .sidebar {
            background: #1e3a5f;
            min-height: 100vh;
        }

        .nav-item {
            transition: all 0.2s ease;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active {
            background: #f5a623;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .btn-orange {
            background: #f5a623;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .btn-orange:hover {
            background: #e09010;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(245, 166, 35, 0.4);
        }

        .btn-navy {
            background: #1e3a5f;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-navy:hover {
            background: #152d4a;
        }

        .btn-green {
            background: #10b981;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-green:hover {
            background: #059669;
        }

        .btn-red {
            background: #ef4444;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-red:hover {
            background: #dc2626;
        }

        .status-pending {
            background: #fef3c7;
            color: #f5a623;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-ready {
            background: #e0e7ff;
            color: #1e3a5f;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-claimed {
            background: #d1fae5;
            color: #10b981;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .input-field {
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 16px;
            width: 100%;
            outline: none;
            transition: border 0.2s;
            color: #374151;
        }

        .input-field:focus {
            border-color: #f5a623;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.1);
        }

        .select-field {
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 16px;
            width: 100%;
            outline: none;
            transition: border 0.2s;
            color: #374151;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236b7280' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
        }

        .select-field:focus {
            border-color: #f5a623;
        }

        .stat-card-orange {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            border: 1px solid #fde68a;
        }

        .stat-card-blue {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: 1px solid #bfdbfe;
        }

        .stat-card-red {
            background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%);
            border: 1px solid #fecdd3;
        }

        .stat-card-green {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 1px solid #bbf7d0;
        }

        .table-row {
            transition: background 0.15s;
        }

        .table-row:hover {
            background: #f9fafb;
        }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 50;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #1e3a5f;
            color: #fff;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 500;
            z-index: 100;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast.success {
            background: #10b981;
        }

        .search-bar {
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 9px 14px 9px 38px;
            outline: none;
            transition: border 0.2s;
        }

        .search-bar:focus {
            border-color: #f5a623;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .lang-btn {
            padding: 6px 10px;
            font-weight: 700;
            font-size: 13px;
            transition: color 0.2s;
        }

        .lang-btn.active {
            color: #f5a623;
        }

        .lang-btn:hover {
            color: #fbb040;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease forwards;
        }

        .icon-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-box-orange {
            background: #f5a623;
        }

        .icon-box-navy {
            background: #1e3a5f;
        }

        .icon-box-green {
            background: #10b981;
        }

        .icon-box-red {
            background: #ef4444;
        }

        .header-top {
            background: #1e3a5f;
            color: #fff;
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .price-tag {
            font-size: 22px;
            font-weight: 800;
        }

        .price-premium {
            color: #f5a623;
        }

        .price-regular {
            color: #1e3a5f;
        }

        .sidebar-logo {
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 12px;
        }
        @keyframes marquee {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(-100%);
            }
        }
        .animate-marquee {
            animation: marquee 12s linear infinite;
        }
        </style>
</head>



<body class="flex">



    <!-- Sidebar -->
    <aside class="sidebar w-72 flex flex-col fixed left-0 top-0 h-full z-30" style="width:280px;">
        <div class="sidebar-logo flex items-center gap-3">
            <div class="icon-box icon-box-orange" style="width:44px;height:44px;border-radius:12px;">
                <i class="fas fa-gas-pump text-white text-xl"></i>
            </div>
            <div>
                <div class="text-white font-bold text-lg leading-tight">Krude Gas</div>
                <div class="text-blue-300 text-xs">Pre-Order System</div>
            </div>
        </div>

        <nav class="flex-1 px-3 py-2 space-y-1">


            <a href="<?= $currentPageUrl ?>?lang=<?= $lang ?>" class="nav-item active flex items-center gap-3 px-4 py-3 rounded-xl text-white">
                <?php if ($page === 'customer'): ?>
                    <i class="fas fa-th-large w-5 text-center"></i>
                    <span class="font-medium"><?= $t['customer_dashboard'] ?></span>
                <?php elseif ($page === 'clerk'): ?>
                    <i class="fas fa-user-tie w-5 text-center"></i>
                    <span class="font-medium"><?= $t['station_clerk'] ?></span>
                <?php else: ?>
                    <i class="fas fa-cog w-5 text-center"></i>
                    <span class="font-medium"><?= $t['admin_dashboard'] ?></span>
                <?php endif; ?>
            </a>
        </nav>

        <div class="px-4 pb-6 pt-2 border-t border-white/10 mt-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-brand-orange flex items-center justify-center text-white font-bold text-sm">
                        <?= $_SESSION['user']['initials'] ?>
                    </div>
                    <div>
                        <div class="text-white font-semibold text-sm"><?= $_SESSION['user']['name'] ?></div>
                        <div class="text-blue-300 text-xs capitalize"><?= $_SESSION['user']['role'] ?></div>
                    </div>
                </div>
                <a href="<?= $currentPageUrl ?>?logout=1" class="text-blue-300 hover:text-white transition-colors">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col" style="margin-left:280px;">
        <!-- Top Header -->
        <div class="header-top">
           
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="text-white/60 hover:text-white transition-colors mr-1">
                    <i class="fas fa-times text-lg"></i>
                </button>
                <h1 class="font-bold text-lg">
                    <?php if ($page === 'customer'): ?><?= $t['customer_dashboard'] ?>
                    <?php elseif ($page === 'clerk'): ?>Station Clerk Dashboard
                    <?php else: ?><?= $t['admin_dashboard'] ?>
                <?php endif; ?>
                </h1>
            </div>
            <div class="flex items-center gap-1 bg-white/10 rounded-lg px-2 py-1">
                <a href="<?= $currentPageUrl ?>?lang=en" class="lang-btn <?= $lang === 'en' ? 'active' : 'text-white/60' ?>">EN</a>
                <span class="text-white/40">|</span>
                <a href="<?= $currentPageUrl ?>?lang=fil" class="lang-btn <?= $lang === 'fil' ? 'active' : 'text-white/60' ?>">FIL</a>
            </div>
        </div>
        
 
        
        <?php if (!empty($announcement)): ?>
    <div class="bg-yellow-200 border-b border-yellow-300 overflow-hidden">
        <div class="whitespace-nowrap animate-marquee text-yellow-900 font-semibold py-2 flex items-center gap-2">
            <i class="fas fa-bullhorn text-orange-600"></i>
            <span><?= htmlspecialchars($announcement) ?></span>
    </div>

    <style>
        @keyframes marquee {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}

.animate-marquee {
    display: inline-block;
    white-space: nowrap;
    animation: marquee 12s linear infinite;
}
    </style>
</div>
<?php endif; ?>
        <!-- Page Content -->
        <main class="flex-1 p-6 overflow-auto">
            <?php if ($page === 'customer'): ?>
                <?php include 'pages/customer.php'; ?>
            <?php elseif ($page === 'clerk'): ?>
                <?php include 'pages/clerk.php'; ?>
            <?php else: ?>
                <?php include 'pages/admin.php'; ?>
            <?php endif; ?>
        </main>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast"></div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="modal">
        <div class="card p-6 w-full max-w-md mx-4 fade-in">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-xl text-gray-800"><?= $t['add_user'] ?></h3>
                <button onclick="closeModal('addUserModal')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1"><?= $t['name'] ?></label>
                    <input type="text" class="input-field" placeholder="Full name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1"><?= $t['email'] ?></label>
                    <input type="email" class="input-field" placeholder="Email address">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1"><?= $t['role'] ?></label>
                    <select class="select-field">
                        <option>Customer</option>
                        <option>Clerk</option>
                        <option>Driver</option>
                        <option>Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" class="input-field" placeholder="Set password">
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button onclick="closeModal('addUserModal')" class="flex-1 py-3 border-2 border-gray-200 rounded-xl font-semibold text-gray-600 hover:bg-gray-50 transition">Cancel</button>
                <button onclick="saveUser()" class="flex-1 py-3 btn-orange"><?= $t['add_user'] ?></button>
            </div>
        </div>
    </div>

    <script>
        function showToast(msg, type = '') {
            const t = document.getElementById('toast');
            t.textContent = msg;
            t.className = 'toast ' + type;
            setTimeout(() => t.classList.add('show'), 10);
            setTimeout(() => t.classList.remove('show'), 3000);
        }

        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function saveUser() {
            closeModal('addUserModal');
            showToast('User added successfully!', 'success');
        }

        function toggleSidebar() {
            document.querySelector('aside').classList.toggle('hidden');
        }

        function markReady(orderId) {
            showToast('Order ' + orderId + ' marked as Ready!', 'success');
            setTimeout(() => location.reload(), 1500);
        }

        function markClaimed(orderId) {
            showToast('Order ' + orderId + ' marked as Claimed!', 'success');
            setTimeout(() => location.reload(), 1500);
        }

        function submitPreorder() {
            const qty = document.getElementById('quantity')?.value;
            const slot = document.getElementById('timeSlot')?.value;
            if (!qty || qty <= 0 || !slot) {
                showToast('Please fill in all fields.', '');
                return;
            }
            showToast('Pre-order submitted successfully!', 'success');
        }

        function submitWalkIn() {
            const name = document.getElementById('walkInName')?.value;
            const qty = document.getElementById('walkInQty')?.value;
            if (!name || !qty || qty <= 0) {
                showToast('Please fill in all fields.', '');
                return;
            }
            showToast('Walk-in order created!', 'success');
        }

        function addStock() {
            const qty = document.getElementById('stockQty')?.value;
            if (!qty || qty <= 0) {
                showToast('Please enter a valid quantity.', '');
                return;
            }
            showToast('Stock added successfully!', 'success');
        }

        function filterOrders(val) {
            document.querySelectorAll('.order-row').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(val.toLowerCase()) ? '' : 'none';
            });
        }

        function filterByStatus(val) {
            document.querySelectorAll('.order-row').forEach(row => {
                if (!val || val === 'all') {
                    row.style.display = '';
                    return;
                }
                row.style.display = row.dataset.status === val ? '' : 'none';
            });
        }
        document.querySelectorAll('.modal').forEach(m => {
            m.addEventListener('click', function(e) {
                if (e.target === this) this.classList.remove('active');
            });
        });
    </script>
</body>

</html>
