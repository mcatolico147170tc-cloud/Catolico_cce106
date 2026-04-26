<?php
session_start();

$role_routes = [
    'customer' => 'customer.php',
    'clerk' => 'clerk.php',
    'admin' => 'admin.php',
];

$role_profiles = [
    'customer' => [
        'id' => 1,
        'name' => 'Juan Dela Cruz',
        'initials' => 'JD',
        'role' => 'customer',
        'email' => 'juan.delacruz@email.com',
    ],
    'clerk' => [
        'id' => 2,
        'name' => 'Pedro Reyes',
        'initials' => 'PR',
        'role' => 'clerk',
        'email' => 'pedro.reyes@email.com',
    ],
    'admin' => [
        'id' => 3,
        'name' => 'Admin User',
        'initials' => 'AU',
        'role' => 'admin',
        'email' => 'admin@krudegas.com',
    ],
];

if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
}

$selected_role = $_POST['role'] ?? ($_GET['role'] ?? 'customer');
$selected_role = array_key_exists($selected_role, $role_routes) ? $selected_role : 'customer';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['user'] = $role_profiles[$selected_role];
    header('Location: ' . $role_routes[$selected_role]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="public/images/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krude Gas - Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #3e6598 0%, #1f3958 100%);
            color: #1f2937;
        }

        .login-shell {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 48px 20px;
        }

        .login-panel {
            width: min(1280px, 100%);
            min-height: 720px;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            overflow: hidden;
            border-radius: 28px;
            background: #fff;
            box-shadow: 0 28px 80px rgba(9, 30, 56, 0.26);
        }

        .brand-side {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 64px 60px;
            color: #fff;
            background: linear-gradient(135deg, #41679a 0%, #294c78 100%);
        }

        .logo-box,
        .feature-dot,
        .role-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .logo-box {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: #f5a623;
            font-size: 38px;
            box-shadow: 0 14px 24px rgba(245, 166, 35, 0.25);
        }

        .feature-dot {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.14);
            color: #fbb040;
        }

        .form-side {
            padding: 64px 60px;
            display: flex;
            align-items: center;
        }

        .form-wrap {
            width: 100%;
            max-width: 520px;
        }

        .role-card {
            width: 100%;
            border: 2px solid #e5e7eb;
            border-radius: 18px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 18px;
            text-align: left;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s, transform 0.2s;
        }

        .role-card:hover,
        .role-card.active {
            border-color: #facf8b;
            background: #fff7eb;
            box-shadow: 0 14px 28px rgba(245, 166, 35, 0.16);
            transform: translateY(-1px);
        }

        .role-icon {
            width: 62px;
            height: 62px;
            flex: 0 0 62px;
            border-radius: 16px;
            background: #f3f4f6;
            color: #5d6673;
            font-size: 25px;
            box-shadow: 0 8px 18px rgba(31, 41, 55, 0.12);
        }

        .role-card.active .role-icon {
            color: #fff;
            background: #f5a623;
        }

        .check-mark {
            margin-left: auto;
            width: 30px;
            height: 30px;
            border-radius: 999px;
            display: none;
            align-items: center;
            justify-content: center;
            background: #2f9b78;
            color: #fff;
        }

        .role-card.active .check-mark {
            display: inline-flex;
        }

        .input-field {
            width: 100%;
            border: 2px solid #d1d5db;
            border-radius: 16px;
            padding: 18px 20px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-field:focus {
            border-color: #f5a623;
            box-shadow: 0 0 0 4px rgba(245, 166, 35, 0.13);
        }

        .signin-btn {
            width: 100%;
            border-radius: 16px;
            padding: 18px 24px;
            background: linear-gradient(135deg, #f8aa24 0%, #e59508 100%);
            color: #fff;
            font-weight: 800;
            box-shadow: 0 16px 28px rgba(229, 149, 8, 0.25);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .signin-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 20px 34px rgba(229, 149, 8, 0.32);
        }

        @media (max-width: 960px) {
            .login-panel {
                grid-template-columns: 1fr;
            }

            .brand-side {
                padding: 40px 28px;
            }

            .form-side {
                padding: 40px 28px;
            }
        }
    </style>
</head>

<body>
    <main class="login-shell">
        <section class="login-panel">
            <div class="brand-side">
                <div class="flex items-center gap-5 mb-12">
                    <div class="logo-box">
                        <i class="fas fa-gas-pump"></i>
                    </div>
                    <div>
                        <h1 class="text-5xl font-extrabold leading-none">Krude Gas</h1>
                        <p class="text-blue-100 text-lg mt-2">Pre-Order System</p>
                    </div>
                </div>

                <h2 class="text-4xl font-extrabold mb-8">Welcome Back!</h2>
                <p class="text-blue-100 text-2xl leading-relaxed max-w-xl mb-12">
                    Streamline your fuel ordering process with our advanced pre-order management system.
                </p>

                <div class="space-y-8">
                    <div class="flex gap-4">
                        <div class="feature-dot"><i class="fas fa-circle text-xs"></i></div>
                        <div>
                            <h3 class="text-xl font-bold">Real-Time Order Tracking</h3>
                            <p class="text-blue-100 mt-2">Monitor orders from placement to pickup</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="feature-dot"><i class="fas fa-circle text-xs"></i></div>
                        <div>
                            <h3 class="text-xl font-bold">Smart Inventory Management</h3>
                            <p class="text-blue-100 mt-2">Automated stock alerts and analytics</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="feature-dot"><i class="fas fa-circle text-xs"></i></div>
                        <div>
                            <h3 class="text-xl font-bold">Secure & Reliable</h3>
                            <p class="text-blue-100 mt-2">Enterprise-grade security for your data</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-side">
                <form method="POST" class="form-wrap">
                    <h2 class="text-4xl font-extrabold text-gray-900">Sign In</h2>
                    <p class="text-gray-500 text-lg mt-4 mb-10">Select your role and enter your credentials</p>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-900 mb-5">Select Your Role</label>
                        <input type="hidden" id="roleInput" name="role" value="<?= htmlspecialchars($selected_role) ?>">

                        <div class="space-y-4">
                            <button type="button" class="role-card <?= $selected_role === 'customer' ? 'active' : '' ?>" data-role="customer">
                                <span class="role-icon"><i class="fas fa-table-cells-large"></i></span>
                                <span>
                                    <span class="block text-2xl font-extrabold text-gray-800">Customer</span>
                                    <span class="block text-sm font-semibold text-gray-500 mt-1">Place and manage your fuel pre-orders</span>
                                </span>
                                <span class="check-mark"><i class="fas fa-check"></i></span>
                            </button>

                            <button type="button" class="role-card <?= $selected_role === 'clerk' ? 'active' : '' ?>" data-role="clerk">
                                <span class="role-icon"><i class="fas fa-users"></i></span>
                                <span>
                                    <span class="block text-2xl font-extrabold text-gray-800">Station Clerk</span>
                                    <span class="block text-sm font-semibold text-gray-500 mt-1">Manage orders and walk-in customers</span>
                                </span>
                                <span class="check-mark"><i class="fas fa-check"></i></span>
                            </button>

                            <button type="button" class="role-card <?= $selected_role === 'admin' ? 'active' : '' ?>" data-role="admin">
                                <span class="role-icon"><i class="fas fa-gear"></i></span>
                                <span>
                                    <span class="block text-2xl font-extrabold text-gray-800">Administrator</span>
                                    <span class="block text-sm font-semibold text-gray-500 mt-1">Full system access and management</span>
                                </span>
                                <span class="check-mark"><i class="fas fa-check"></i></span>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="flex items-center gap-3 text-base font-bold text-gray-900 mb-3">
                                <i class="far fa-user text-orange-500"></i>
                                Email Address
                            </label>
                            <input type="email" name="email" class="input-field" placeholder="Enter your email">
                        </div>

                        <div>
                            <label class="flex items-center gap-3 text-base font-bold text-gray-900 mb-3">
                                <i class="fas fa-lock text-orange-500"></i>
                                Password
                            </label>
                            <input type="password" name="password" class="input-field" placeholder="Enter your password">
                        </div>
                    </div>

                    <div class="flex items-center justify-between my-8">
                        <label class="flex items-center gap-3 text-gray-600 font-semibold">
                            <input type="checkbox" name="remember" class="w-5 h-5 rounded border-gray-300">
                            Remember me
                        </label>
                        <a href="#" class="text-orange-500 font-bold">Forgot Password?</a>
                    </div>

                    <button type="submit" class="signin-btn">
                        Sign In <i class="fas fa-arrow-right ml-3"></i>
                    </button>

                    <p class="text-center text-gray-500 mt-9">
                        Don't have an account?
                        <span class="text-orange-500 font-bold">Contact Administrator</span>
                    </p>
                </form>
            </div>
        </section>

        <p class="text-blue-100 mt-9">&copy; 2026 Krude Gas Pre-Order System. LedesmaQT.</p>
    </main>

    <script>
        document.querySelectorAll('.role-card').forEach((card) => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.role-card').forEach((item) => item.classList.remove('active'));
                card.classList.add('active');
                document.getElementById('roleInput').value = card.dataset.role;
            });
        });
    </script>
</body>

</html>
