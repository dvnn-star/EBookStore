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

<body class="h-full bg-[#FFFFFF] text-[#1F2937] antialiased">

    <div class="flex min-h-screen bg-neutral-50/50">

        <?php $this->load->view('components/sidebarAdmin', ['sessions' => $sessions]); ?>

        <main class="flex-1 flex flex-col">
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-neutral-200 flex items-center justify-between px-10 sticky top-0 z-10">
                <div>
                    <h2 class="text-xl font-bold text-[#1F2937]">Dashboard Overview</h2>
                    <p class="text-xs text-neutral-600 font-semibold">Welcome back, <?= $sessions['username'] ?? 'User' ?>!</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="p-2 text-neutral-500 hover:text-[#005B52] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <button onclick="window.location.href='<?= base_url('export_csv') ?>'" class="px-5 py-2.5 text-sm font-semibold text-white bg-[#005B52] rounded-xl hover:bg-[#00443d] transition-all shadow-lg shadow-[#005B52]/10">
                        Export Data
                    </button>
                </div>
            </header>

            <section class="p-10 space-y-10">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="group p-8 bg-white border border-neutral-200 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-[#005B52]/5 transition-all duration-300">
                        <div class="w-12 h-12 bg-[#005B52]/10 rounded-2xl flex items-center justify-center text-[#005B52] mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-neutral-600 uppercase tracking-wider">Total Revenue</p>
                        <p class="text-4xl font-black mt-2 text-[#FF8A00] tracking-tight">Rp <?= number_format($data->total_sales ?? 0, 0, ',', '.') ?></p>
                    </div>

                    <div class="group p-8 bg-white border border-neutral-200 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-[#005B52]/5 transition-all duration-300">
                        <div class="w-12 h-12 bg-[#005B52]/10 rounded-2xl flex items-center justify-center text-[#005B52] mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-neutral-600 uppercase tracking-wider">Active Users</p>
                        <p class="text-4xl font-black mt-2 text-[#1F2937] tracking-tight"><?= $data->total_users ?? 0 ?></p>
                    </div>

                    <div class="group p-8 bg-white border border-neutral-200 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-[#005B52]/5 transition-all duration-300">
                        <div class="w-12 h-12 bg-[#005B52]/10 rounded-2xl flex items-center justify-center text-[#005B52] mb-6 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-neutral-600 uppercase tracking-wider">Total Buku</p>
                        <p class="text-4xl font-black mt-2 text-[#1F2937] tracking-tight"><?= $data->total_books ?? 0 ?></p>
                    </div>
                </div>

                <div class="bg-white border border-neutral-200 rounded-3xl shadow-sm overflow-hidden">
                    <div class="px-8 py-6 border-b border-neutral-100 flex items-center justify-between">
                        <h3 class="font-bold text-[#1F2937] text-lg">Recent Transactions</h3>
                        <a href="<?= base_url('DaftarTransactions') ?>" class="text-sm font-bold text-[#005B52] hover:text-[#00443d]">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-neutral-50 text-[11px] uppercase tracking-widest text-neutral-500 font-bold border-b border-neutral-100">
                                    <th class="px-8 py-4">Customer & Date</th>
                                    <th class="px-8 py-4">Transaction Status</th>
                                    <th class="px-8 py-4 text-right">Revenue</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-100">
                                <?php if (!empty($all_transactions)): ?>
                                    <?php foreach ($all_transactions as $tr): ?>
                                        <tr class="group hover:bg-neutral-50 transition-all duration-300">
                                            <td class="px-8 py-5">
                                                <div class="flex flex-col">
                                                    <span class="text-sm font-bold text-[#1F2937]">
                                                        <?= htmlspecialchars($tr->full_name ?? 'Guest User') ?>
                                                    </span>
                                                    <span class="text-[11px] text-neutral-500 font-mono mt-1 font-semibold">
                                                        #<?= $tr->kode_transaksi ?> • <?= date('d M Y, H:i', strtotime($tr->tanggal)) ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5">
                                                <?php
                                                // Pemetaan status warna disesuaikan agar kontras tinggi di atas bg-white
                                                $status_map = [
                                                    'success' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                                                    'pending' => 'border-amber-200 bg-amber-50 text-amber-700',
                                                    'failed'  => 'border-rose-200 bg-rose-50 text-rose-700',
                                                    'expired' => 'border-neutral-200 bg-neutral-100 text-neutral-600'
                                                ];
                                                $theme = $status_map[$tr->status] ?? $status_map['expired'];
                                                ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded border text-[10px] font-bold uppercase tracking-wider <?= $theme ?>">
                                                    <span class="w-1 h-1 rounded-full bg-current mr-1.5 animate-pulse"></span>
                                                    <?= $tr->status ?>
                                                </span>
                                            </td>
                                            <td class="px-8 py-5 text-right">
                                                <span class="text-sm font-mono font-bold text-[#1F2937]">
                                                    Rp <?= number_format($tr->total_bayar, 0, ',', '.') ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="px-8 py-20 text-center">
                                            <div class="flex flex-col items-center justify-center space-y-2">
                                                <span class="text-neutral-500 font-medium text-sm">No transaction records found in the vault.</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="mt-4 flex justify-between items-center text-xs text-neutral-600 font-medium px-2">
                    <p>Showing <span class="text-[#1F2937] font-bold"><?= count($all_transactions) ?></span> of <span class="text-[#1F2937] font-bold"><?= $total ?></span> transactions</p>
                    <div class="pagination-custom text-[#005B52] font-bold">
                        <?= $pagination ?>
                    </div>
                </div>
            </section>
        </main>
    </div>

</body>

</html>