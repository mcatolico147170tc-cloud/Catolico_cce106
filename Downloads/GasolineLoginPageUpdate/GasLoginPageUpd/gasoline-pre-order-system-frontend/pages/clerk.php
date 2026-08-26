<?php
$pending_count = count(array_filter($all_orders, fn($o) => $o['status'] === 'pending'));
$ready_count   = count(array_filter($all_orders, fn($o) => $o['status'] === 'ready'));
$claimed_count = count(array_filter($all_orders, fn($o) => $o['status'] === 'claimed'));
?>

<!-- Stats Row -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 fade-in">
    <div class="card p-6 stat-card-orange">
        <div class="flex items-center justify-between mb-4">
            <div class="icon-box icon-box-orange"><i class="far fa-clock text-white text-xl"></i></div>
        </div>
        <div class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1"><?= $t['pending_orders'] ?></div>
        <div class="text-5xl font-extrabold text-brand-orange"><?= $pending_count ?></div>
    </div>
    <div class="card p-6 stat-card-blue">
        <div class="flex items-center justify-between mb-4">
            <div class="icon-box icon-box-navy"><i class="fas fa-box text-white text-xl"></i></div>
        </div>
        <div class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1"><?= $t['ready_for_pickup'] ?></div>
        <div class="text-5xl font-extrabold text-brand-navy"><?= $ready_count ?></div>
    </div>
    <div class="card p-6 stat-card-green">
        <div class="flex items-center justify-between mb-4">
            <div class="icon-box icon-box-green"><i class="fas fa-check-circle text-white text-xl"></i></div>
        </div>
        <div class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1"><?= $t['claimed_today'] ?></div>
        <div class="text-5xl font-extrabold text-emerald-600"><?= $claimed_count ?></div>
    </div>
</div>

<!-- Manage Orders -->
<div class="card p-6 mb-6 fade-in">
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-xl font-bold text-gray-800"><?= $t['manage_orders'] ?></h2>
        <div class="flex items-center gap-3">
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" placeholder="<?= $t['search_orders'] ?>" oninput="filterOrders(this.value)" class="search-bar text-sm" style="min-width:200px;">
            </div>
            <div class="relative">
                <i class="fas fa-filter absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <select onchange="filterByStatus(this.value)" class="select-field text-sm pl-9 py-2" style="min-width:130px;">
                    <option value="all"><?= $t['all_status'] ?></option>
                    <option value="pending"><?= $t['pending'] ?></option>
                    <option value="ready"><?= $t['ready_pickup'] ?></option>
                    <option value="claimed"><?= $t['claimed'] ?></option>
                </select>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['order_id'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['customer_name'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['fuel_type'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['liters'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['pickup_time'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['status'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['actions'] ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_orders as $order): ?>
                <tr class="order-row table-row border-b border-gray-50" data-status="<?= $order['status'] ?>">
                    <td class="py-4 px-2 font-bold text-gray-800"><?= $order['id'] ?></td>
                    <td class="py-4 px-2 text-gray-700 font-medium"><?= $order['customer'] ?></td>
                    <td class="py-4 px-2 text-gray-600"><?= $order['fuel'] ?></td>
                    <td class="py-4 px-2 text-gray-600"><?= $order['liters'] ?>L</td>
                    <td class="py-4 px-2 text-gray-600"><?= $order['pickup'] ?></td>
                    <td class="py-4 px-2">
                        <?php if ($order['status'] === 'pending'): ?>
                            <span class="chip status-pending"><span class="w-2 h-2 rounded-full bg-amber-400 inline-block"></span><?= $t['pending'] ?></span>
                        <?php elseif ($order['status'] === 'ready'): ?>
                            <span class="chip status-ready"><span class="w-2 h-2 rounded-full bg-blue-600 inline-block"></span>Ready</span>
                        <?php else: ?>
                            <span class="chip status-claimed"><span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span><?= $t['claimed'] ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-2">
                        <?php if ($order['status'] === 'pending'): ?>
                            <button onclick="markReady('<?= $order['id'] ?>')" class="btn-navy text-sm px-4 py-2"><?= $t['mark_ready'] ?></button>
                        <?php elseif ($order['status'] === 'ready'): ?>
                            <button onclick="markClaimed('<?= $order['id'] ?>')" class="btn-green text-sm px-4 py-2"><?= $t['mark_claimed'] ?></button>
                        <?php else: ?>
                            <span class="text-gray-400 text-sm italic"><?= $t['completed'] ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- New Walk-In Order -->
<div class="card p-6 fade-in" style="max-width:100%;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800"><?= $t['new_walkin'] ?></h2>
        <div class="icon-box icon-box-orange"><i class="fas fa-user text-white text-xl"></i></div>
    </div>
    <div class="space-y-4">
        <div>
            <label class="flex items-center gap-2 text-sm font-semibold text-gray-600 mb-2">
                <i class="fas fa-user text-brand-orange text-sm"></i>
                <?= $t['customer_name'] ?>
            </label>
            <input id="walkInName" type="text" placeholder="<?= $t['enter_name'] ?>" class="input-field">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2"><?= $t['fuel_type'] ?></label>
            <select id="walkInFuel" class="select-field">
                <option>Krude-Premium</option>
                <option>Krude-Regular</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2"><?= $t['quantity_liters'] ?></label>
            <input id="walkInQty" type="number" min="1" placeholder="0" class="input-field">
        </div>
        <button onclick="submitWalkIn()" class="btn-orange w-full py-4 text-base"><?= $t['create_order'] ?></button>
    </div>
</div>