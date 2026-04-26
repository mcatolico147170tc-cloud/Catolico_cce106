<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Krude Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-900 text-white min-h-screen p-5">
        <h2 class="text-2xl font-bold mb-6">Krude Gas</h2>
        <ul class="space-y-3">
            <li class="bg-orange-500 p-2 rounded">Dashboard</li>
            <li class="hover:bg-blue-700 p-2 rounded">Orders</li>
            <li class="hover:bg-blue-700 p-2 rounded">Inventory</li>
            <li class="hover:bg-blue-700 p-2 rounded">Users</li>
        </ul>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-semibold">Admin Dashboard</h1>
            <button class="bg-orange-500 text-white px-4 py-2 rounded">
                + Add Order
            </button>
        </div>

        <!-- CARDS -->
        <div class="grid grid-cols-3 gap-4 mb-6">

            <div class="bg-white p-4 rounded shadow">
                <p class="text-gray-500">Total Orders</p>
                <h2 class="text-2xl font-bold">142</h2>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <p class="text-gray-500">Revenue</p>
                <h2 class="text-2xl font-bold">₱28.4K</h2>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <p class="text-gray-500">Alerts</p>
                <h2 class="text-2xl font-bold text-red-500">2</h2>
            </div>

        </div>

        <!-- TABLE -->
        <div class="bg-white p-4 rounded shadow">
            <h2 class="mb-4 font-semibold">Manage Orders</h2>

            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="p-2">Customer</th>
                        <th class="p-2">Fuel</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="border-b">
                        <td class="p-2">Juan Dela Cruz</td>
                        <td class="p-2">Premium</td>
                        <td class="p-2 text-green-500">Completed</td>
                        <td class="p-2">
                            <button class="bg-blue-500 text-white px-2 py-1 rounded">
                                View
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>
</div>

</body>
</html>