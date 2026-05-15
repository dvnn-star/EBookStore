<?php
$sessions = $this->session->all_userdata();

?>
<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BookStore | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="h-full bg-[#fbfcfd] text-slate-900 antialiased">

    <div class="flex min-h-screen">

        <?php $this->load->view('components/sidebarAdmin', ['sessions' => $sessions]); ?>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200/60 flex items-center justify-between px-10 sticky top-0 z-10">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Dashboard Overview</h2>
                    <p class="text-xs text-slate-500 font-medium">Welcome back, <?= $sessions['username'] ?? 'User' ?>!</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="p-2 text-slate-400 hover:text-indigo-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <button onclick="window.location.href='<?= base_url('export_csv') ?>'" class="px-5 py-2.5 text-sm font-semibold text-white bg-slate-900 rounded-xl hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10">
                        Export Data
                    </button>
                </div>
            </header>

            <!-- Content Area -->
            <section class="p-10 space-y-10">

                <!-- KPI Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="group p-8 bg-white border border-slate-200/60 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300">
                        <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Revenue</p>
                        <p class="text-4xl font-black mt-2 text-slate-900 tracking-tight">Rp <?= number_format($data->total_sales ?? 0, 0, ',', '.') ?></p>
                    </div>

                    <div class="group p-8 bg-white border border-slate-200/60 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300">
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Active Users</p>
                        <p class="text-4xl font-black mt-2 text-slate-900 tracking-tight"><?= $data->total_users ?? 0 ?></p>
                    </div>

                    <div class="group p-8 bg-white border border-slate-200/60 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-amber-500/5 transition-all duration-300">
                        <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Buku</p>
                        <p class="text-4xl font-black mt-2 text-slate-900 tracking-tight"><?= $data->total_books ?? 0 ?></p>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="bg-white border border-slate-200/60 rounded-3xl shadow-sm overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                        <h3 class="font-bold text-slate-800 text-lg">Recent Transactions</h3>
                        <a href="<?= base_url('transactions') ?>" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 text-[11px] uppercase tracking-widest text-slate-400 font-bold">
                                    <th class="px-8 py-4">Customer & Date</th>
                                    <th class="px-8 py-4">Transaction Status</th>
                                    <th class="px-8 py-4 text-right">Revenue</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800/50">
                                <?php if (!empty($all_transactions)): ?>
                                    <?php foreach ($all_transactions as $tr): ?>
                                        <tr class="group hover:bg-slate-800/30 transition-all duration-300">
                                            <td class="px-8 py-5">
                                                <div class="flex flex-col">
                                                    <!-- Menampilkan Nama hasil JOIN, bukan sekadar ID -->
                                                    <span class="text-sm font-semibold text-slate-200 group-hover:text-white transition-colors">
                                                        <?= htmlspecialchars($tr->full_name ?? 'Guest User') ?>
                                                    </span>
                                                    <span class="text-[11px] text-slate-500 font-mono mt-1">
                                                        #<?= $tr->kode_transaksi ?> • <?= date('d M Y, H:i', strtotime($tr->tanggal)) ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5">
                                                <?php
                                                $status_map = [
                                                    'success' => 'border-emerald-500/30 bg-emerald-500/10 text-emerald-400',
                                                    'pending' => 'border-amber-500/30 bg-amber-500/10 text-amber-400',
                                                    'failed'  => 'border-rose-500/30 bg-rose-500/10 text-rose-400',
                                                    'expired' => 'border-slate-500/30 bg-slate-500/10 text-slate-400'
                                                ];
                                                $theme = $status_map[$tr->status] ?? $status_map['expired'];
                                                ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded border text-[10px] font-bold uppercase tracking-wider <?= $theme ?>">
                                                    <span class="w-1 h-1 rounded-full bg-current mr-1.5 animate-pulse"></span>
                                                    <?= $tr->status ?>
                                                </span>
                                            </td>
                                            <td class="px-8 py-5 text-right">
                                                <span class="text-sm font-mono font-bold text-slate-100">
                                                    Rp <?= number_format($tr->total_bayar, 0, ',', '.') ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="px-8 py-20 text-center">
                                            <div class="flex flex-col items-center justify-center space-y-2">
                                                <span class="text-slate-600 text-sm">No transaction records found in the vault.</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 flex justify-between items-center text-xs text-slate-500 px-2">
                        <p>Showing <span class="text-slate-300"><?= count($all_transactions) ?></span> of <span class="text-slate-300"><?= $total ?></span> transactions</p>
                        <div class="pagination-custom">
                            <?= $pagination ?>
                        </div>
                    </div>
            </section>
        </main>
    </div>

</body>

</html>