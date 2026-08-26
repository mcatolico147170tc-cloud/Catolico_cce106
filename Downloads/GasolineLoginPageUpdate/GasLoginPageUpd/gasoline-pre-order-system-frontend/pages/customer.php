<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$prices = json_decode(file_get_contents(__DIR__ . '/../fuel_prices.json'), true);
?>

<?php
$fuel_prices = json_decode(file_get_contents(__DIR__ . '/../fuel_prices.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['premium']) && isset($_POST['regular'])) {
        $data = [
            'premium' => (float) $_POST['premium'],
            'regular' => (float) $_POST['regular']
        ];

        file_put_contents(__DIR__ . '/../fuel_prices.json', json_encode($data, JSON_PRETTY_PRINT));
    }

    if (isset($_POST['announcement'])) {
        file_put_contents(__DIR__ . '/../announcement.txt', trim($_POST['announcement']));
    }
}
?>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6 fade-in">

    <!-- New Pre-Order Card -->
    <div class="card p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800"><?= $t['new_preorder'] ?></h2>
        <div class="icon-box icon-box-orange">
            <i class="fas fa-calendar-alt text-white text-xl"></i>
        </div>
    </div>

    <!-- 👇 IREPLACE NI NIMO -->
    <div class="space-y-4">

        <!-- USER NAME -->
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">
                Full Name
            </label>
            <input id="userName" type="text" placeholder="Enter your name" class="input-field">
        </div>

        <!-- Fuel Type -->
        <div>
            <label class="flex items-center gap-2 text-sm font-semibold text-gray-600 mb-2">
                <i class="fas fa-dollar-sign text-brand-orange"></i>
                <?= $t['fuel_type'] ?>
            </label>
            <select id="fuelType" class="select-field">
                <option value="premium">Krude-Premium</option>
                <option value="regular">Krude-Regular</option>
            </select>
        </div>

        <!-- Quantity -->
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">
                <?= $t['quantity_liters'] ?>
            </label>
            <input id="quantity" type="number" min="1" placeholder="0" class="input-field">
        </div>

        <!-- Time Slot -->
        <div>
            <label class="flex items-center gap-2 text-sm font-semibold text-gray-600 mb-2">
                <i class="far fa-clock text-brand-orange"></i>
                <?= $t['pickup_time_slot'] ?>
            </label>
            <select id="timeSlot" class="select-field">
                <option value=""><?= $t['select_time_slot'] ?></option>
                <option>8:00 AM - 9:00 AM</option>
                <option>9:00 AM - 10:00 AM</option>
                <option>10:00 AM - 11:00 AM</option>
                <option>11:00 AM - 12:00 PM</option>
                <option>1:00 PM - 2:00 PM</option>
                <option>2:00 PM - 3:00 PM</option>
                <option>3:00 PM - 4:00 PM</option>
                <option>4:00 PM - 5:00 PM</option>
                <option>5:00 PM - 6:00 PM</option>
            </select>
        </div>

        <!-- Submit -->
        <button onclick="submitPreorder()" class="btn-orange w-full py-4 text-base mt-2">
            <?= $t['submit_preorder'] ?>
        </button>

    </div>
</div>

    <!-- Quick Info Card -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800"><?= $t['quick_info'] ?></h2>
            <div class="icon-box icon-box-navy">
                <i class="fas fa-info-circle text-white text-xl"></i>
            </div>
        </div>
        <div class="space-y-3">
            <div class="rounded-xl border border-gray-100 p-4 stat-card-orange">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">PREMIUM FUEL</div>
                <div class="flex items-center justify-between">
                    <div class="font-semibold text-gray-700">Krude-Premium Price</div>
                    <div class="price-tag price-premium">₱<?= number_format($fuel_prices['premium'], 2) ?>/L</div>
                </div>
            </div>
            <div class="rounded-xl border border-gray-100 p-4 stat-card-blue">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">REGULAR FUEL</div>
                <div class="flex items-center justify-between">
                    <div class="font-semibold text-gray-700">Krude-Regular Price</div>
                    <div class="price-tag price-regular">₱<?= number_format($fuel_prices['regular'], 2) ?>/L</div>
                </div>
            </div>
            <div class="rounded-xl border border-gray-100 p-4 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-gray-600 font-medium">
                        <i class="far fa-clock"></i>
                        <?= $t['station_hours'] ?>
                    </div>
                </div>
            </div>
            <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">
                <div class="flex items-start gap-2">
                    <i class="fas fa-exclamation-circle text-amber-500 mt-0.5 flex-shrink-0"></i>
                    <p class="text-sm text-gray-700">
                        <strong><?= $lang === 'en' ? 'Important' : 'Mahalaga' ?>:</strong>
                        <?= $lang === 'en' ? 'Pre-orders must be placed at least 2 hours before pickup time.' : 'Ang mga pre-order ay dapat ilagay nang hindi bababa sa 2 oras bago ang oras ng pagkuha.' ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- My Orders -->
<div class="card p-6 fade-in">
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-xl font-bold text-gray-800"><?= $t['my_orders'] ?></h2>
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
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['fuel_type'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['liters'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['pickup_time'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['status'] ?></th>
                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wide"><?= $t['date'] ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr class="order-row table-row border-b border-gray-50" data-status="<?= $order['status'] ?>">
                        <td class="py-4 px-2 font-bold text-gray-800"><?= $order['id'] ?></td>
                        <td class="py-4 px-2 text-gray-600"><?= $order['fuel'] ?></td>
                        <td class="py-4 px-2 text-gray-600"><?= $order['liters'] ?>L</td>
                        <td class="py-4 px-2 text-gray-600"><?= $order['pickup'] ?></td>
                        <td class="py-4 px-2">
                            <?php if ($order['status'] === 'pending'): ?>
                                <span class="chip status-pending"><span class="w-2 h-2 rounded-full bg-amber-400 inline-block"></span><?= $t['pending'] ?></span>
                            <?php elseif ($order['status'] === 'ready'): ?>
                                <span class="chip status-ready"><span class="w-2 h-2 rounded-full bg-blue-600 inline-block"></span><?= $t['ready_pickup'] ?></span>
                            <?php else: ?>
                                <span class="chip status-claimed"><span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span><?= $t['claimed'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="py-4 px-2 text-gray-500"><?= $order['date'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>