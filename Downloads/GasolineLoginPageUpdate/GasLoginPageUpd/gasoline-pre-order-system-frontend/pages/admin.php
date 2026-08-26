<?php

$prices = json_decode(file_get_contents(__DIR__ . '/../fuel_prices.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['premium'])) {
    $data = [
        'premium' => $_POST['premium'],
        'regular' => $_POST['regular']
    ];

    file_put_contents(__DIR__ . '/../fuel_prices.json', json_encode($data));
}

$total_reservations = 142;
$total_revenue      = 28400;
$low_stock          = 2;
$stock_premium      = 8500;
$stock_regular      = 2300;

$daily_data = [
    'Mon' => ['premium' => 18, 'regular' => 12],
    'Tue' => ['premium' => 22, 'regular' => 15],
    'Wed' => ['premium' => 15, 'regular' => 10],
    'Thu' => ['premium' => 28, 'regular' => 20],
    'Fri' => ['premium' => 35, 'regular' => 25],
    'Sat' => ['premium' => 42, 'regular' => 30],
    'Sun' => ['premium' => 20, 'regular' => 14],
];

$max_val = 42;

/* SAVE ANNOUNCEMENT */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['announcement'])) {
    file_put_contents('announcement.txt', trim($_POST['announcement']));
}

/* FETCH ANNOUNCEMENT */
$announcement = file_exists('announcement.txt')
    ? trim(file_get_contents('announcement.txt'))
    : '';

?>

<!-- ANNOUNCEMENT CARD -->
<div class="card p-6 mb-6">
    <h2 class="text-xl font-bold mb-4">📢 Announcement</h2>

    <form method="POST" class="card p-4 space-y-3">

    <h2 class="text-xl font-bold">Update Fuel Price</h2>

    <!-- PREMIUM -->
    <div>
        <label class="text-sm font-semibold text-gray-600">
            Premium Fuel (₱/L)
        </label>
        <input type="number" step="0.01" name="premium"
            value="<?= $prices['premium'] ?>"
            class="input-field">
    </div>

    <!-- REGULAR -->
    <div>
        <label class="text-sm font-semibold text-gray-600">
            Regular Fuel (₱/L)
        </label>
        <input type="number" step="0.01" name="regular"
            value="<?= $prices['regular'] ?>"
            class="input-field">
    </div>

    <button type="submit" class="btn-orange w-full py-2">
        Save Price
    </button>

</form> 
<!-- STATS ROW -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 fade-in">

    <div class="card p-6 stat-card-orange">
        <div class="flex justify-between">
            <div class="icon-box icon-box-orange">
                <i class="fas fa-chart-line text-white"></i>
            </div>
            <div class="text-right">
                <div class="text-xs"><?= $t['today'] ?></div>
                <div class="text-emerald-500 font-bold">+12%</div>
            </div>
        </div>
        <div class="text-xs mt-3"><?= $t['total_reservations'] ?></div>
        <div class="text-5xl font-extrabold text-brand-orange">
            <?= number_format($total_reservations) ?>
        </div>
    </div>

    <div class="card p-6 stat-card-blue">
        <div class="flex justify-between">
            <div class="icon-box icon-box-navy">
                <i class="fas fa-dollar-sign text-white"></i>
            </div>
            <div class="text-right">
                <div class="text-xs"><?= $t['this_week'] ?></div>
                <div class="text-emerald-500 font-bold">+8%</div>
            </div>
        </div>
        <div class="text-xs mt-3"><?= $t['total_revenue'] ?></div>
        <div class="text-5xl font-extrabold text-brand-navy">
            ₱<?= number_format($total_revenue / 1000, 1) ?>K
        </div>
    </div>

    <div class="card p-6 stat-card-red">
        <div class="flex justify-between">
            <div class="icon-box icon-box-red">
                <i class="fas fa-exclamation-triangle text-white"></i>
            </div>
            <div class="text-right">
                <div class="text-xs"><?= $t['critical'] ?></div>
                <div class="text-red-500 font-bold"><?= $t['action_needed'] ?></div>
            </div>
        </div>
        <div class="text-xs mt-3"><?= $t['low_stock_alerts'] ?></div>
        <div class="text-5xl font-extrabold text-red-500">
            <?= $low_stock ?>
        </div>
    </div>

</div>

<!-- CHART + INVENTORY -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6 fade-in">

    <div class="card p-6">
        <h2 class="text-xl font-bold mb-4"><?= $t['daily_reservations'] ?></h2>

        <div class="flex items-end gap-3 h-40 px-2 mb-3">
            <?php foreach ($daily_data as $day => $vals): ?>
            <div class="flex-1 flex flex-col items-center gap-1">
                <div class="w-full flex gap-1 items-end h-32">
                    <div class="flex-1 bg-brand-orange"
                         style="height:<?= ($vals['premium'] / $max_val * 100) ?>%"></div>
                    <div class="flex-1 bg-brand-navy"
                         style="height:<?= ($vals['regular'] / $max_val * 100) ?>%"></div>
                </div>
                <span class="text-xs"><?= $day ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<!-- USER TABLE  -->
<div class="card p-6 fade-in">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-xl font-bold text-gray-800"><?= $t['user_management'] ?></h2>
            <p class="text-sm text-gray-500 mt-0.5"><?= $t['manage_users'] ?></p>
        </div>
        <button onclick="openModal('addUserModal')" class="btn-green flex items-center gap-2 px-5 py-3">
            <i class="fas fa-user-plus"></i><?= $t['add_user'] ?>
        </button>
    </div>
    <div class="flex items-center gap-3 mb-5">
        <div class="relative flex-1">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" placeholder="<?= $t['search_users'] ?>" oninput="filterUsers(this.value)" class="search-bar text-sm w-full">
        </div>
        <div class="relative">
            <i class="fas fa-filter absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <select onchange="filterUserRole(this.value)" class="select-field text-sm pl-9 py-2" style="min-width:130px;">
                <option value="all"><?= $t['all_roles'] ?></option>
                <option value="customer">Customer</option>
                <option value="clerk">Clerk</option>
                <option value="driver">Driver</option>
                <option value="admin">Admin</option>
            </select>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['name'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['email'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['role'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['status'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['actions'] ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <?php
                $role_colors = [
                    'customer' => 'bg-blue-900 text-white',
                    'clerk'    => 'bg-amber-500 text-white',
                    'driver'   => 'bg-emerald-600 text-white',
                    'admin'    => 'bg-purple-600 text-white',
                ];
                $rc = $role_colors[$user['role']] ?? 'bg-gray-200 text-gray-700';
                ?>
                <tr class="user-row table-row border-b border-gray-50" data-role="<?= $user['role'] ?>">
                    <td class="py-4 px-2 font-bold text-gray-800"><?= $user['name'] ?></td>
                    <td class="py-4 px-2 text-gray-600"><?= $user['email'] ?></td>
                    <td class="py-4 px-2"><span class="chip <?= $rc ?> text-xs capitalize"><?= ucfirst($user['role']) ?></span></td>
                    <td class="py-4 px-2">
                        <?php if ($user['status'] === 'active'): ?>
                            <span class="chip status-claimed"><span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span><?= $t['active'] ?></span>
                        <?php else: ?>
                            <span class="chip bg-gray-100 text-gray-500"><span class="w-2 h-2 rounded-full bg-gray-400 inline-block"></span><?= $t['inactive'] ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-2">
                        <div class="flex items-center gap-2">
                            <button onclick="showToast('Editing <?= addslashes($user['name']) ?>...', '')" class="btn-navy text-sm px-4 py-2"><?= $t['edit'] ?></button>
                            <?php if ($user['status'] === 'active'): ?>
                                <button onclick="showToast('<?= addslashes($user['name']) ?> deactivated.', '')" class="btn-red text-sm px-4 py-2"><?= $t['deactivate'] ?></button>
                            <?php else: ?>
                                <button onclick="showToast('<?= addslashes($user['name']) ?> activated.', 'success')" class="btn-green text-sm px-4 py-2">Activate</button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>