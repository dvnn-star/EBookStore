<?php
$data = $this->session->all_userdata();
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full font-sans antialiased text-slate-900">

    <div class="flex min-h-screen">
        <!-- Sidebar: Navigasi yang Konsisten -->
        <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col">
            <div class="p-6">
                <h1 class="text-xl font-bold tracking-tight text-indigo-600">CORE SYSTEM</h1>
            </div>
            <nav class="flex-1 px-4 space-y-1">
                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium bg-indigo-50 text-indigo-700 rounded-lg">
                    Dashboard
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-lg transition">
                    Analytics
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-lg transition">
                    Projects
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-lg transition">
                    Settings
                </a>
            </nav>
            <div class="p-4 border-t border-slate-200">
                <div class="flex items-center gap-3 px-2">
                    <div class="w-8 h-8 rounded-full bg-slate-300"></div>
                    <div class="text-xs">
                        <p class="font-semibold text-black capitalize"><?= $data['username'] ?></p>
                        <p class="text-slate-500"><?= $data['role'] ?></p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col">
            <!-- Header/Navbar -->
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8">
                <h2 class="text-lg font-semibold">Overview</h2>
                <div class="flex items-center gap-4">
                    <button class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">
                        Generate Report
                    </button>
                </div>
            </header>

            <!-- Dashboard Content -->
            <section class="p-8 space-y-8">
                
                <!-- Stats Grid: Indikator Kinerja Utama (KPI) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-sm">
                        <p class="text-sm font-medium text-slate-500">Total Revenue</p>
                        <p class="text-3xl font-bold mt-1">$45,231.89</p>
                        <p class="text-xs text-emerald-600 font-medium mt-2">↑ 12% vs last month</p>
                    </div>
                    <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-sm">
                        <p class="text-sm font-medium text-slate-500">Active Users</p>
                        <p class="text-3xl font-bold mt-1">2,340</p>
                        <p class="text-xs text-rose-600 font-medium mt-2">↓ 3% vs last month</p>
                    </div>
                    <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-sm">
                        <p class="text-sm font-medium text-slate-500">Conversion Rate</p>
                        <p class="text-3xl font-bold mt-1">4.2%</p>
                        <p class="text-xs text-emerald-600 font-medium mt-2">↑ 0.4% vs last month</p>
                    </div>
                </div>

                <!-- Main Section: Data Kompleks -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Table: Informasi Detail -->
                    <div class="lg:col-span-2 bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-200">
                            <h3 class="font-semibold text-slate-800">Recent Transactions</h3>
                        </div>
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-xs uppercase text-slate-500 font-semibold">
                                    <th class="px-6 py-3">Client</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3 text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4 text-sm">TechFlow Inc.</td>
                                    <td class="px-6 py-4 italic text-sm">
                                        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded text-xs">Success</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-right font-medium">$1,200.00</td>
                                </tr>
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4 text-sm">Acme Corp.</td>
                                    <td class="px-6 py-4 italic text-sm">
                                        <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded text-xs">Pending</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-right font-medium">$850.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Side Card: Insight Tambahan -->
                    <div class="bg-indigo-900 text-white p-8 rounded-xl shadow-lg flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold mb-2">System Health</h3>
                            <p class="text-indigo-200 text-sm">All services are operating normally. No outages reported in the last 24 hours.</p>
                        </div>
                        <div class="mt-8">
                            <div class="flex justify-between text-xs mb-1">
                                <span>Storage Limit</span>
                                <span>85%</span>
                            </div>
                            <div class="w-full bg-indigo-700 h-2 rounded-full overflow-hidden">
                                <div class="bg-white h-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </main>
    </div>

</body>
</html>