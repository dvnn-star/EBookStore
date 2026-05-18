<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BookStore | Daftar Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-[#fbfcfd] text-slate-900 antialiased">

    <div class="flex min-h-screen">
        <!-- PANGGIL SIDEBAR PARTIAL -->
        <?php $this->load->view('components/sidebarAdmin'); ?>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200/60 flex items-center justify-between px-10 sticky top-0 z-10">
                <div>
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Riwayat Transaksi</h2>
                    <p class="text-xs text-slate-500 font-medium">Pantau arus kas, status pembayaran, dan riwayat pesanan.</p>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Tombol Export Laporan, bukan Tambah Transaksi -->
                    <a href="<?= base_url('export_csv') ?>" class="px-5 py-2.5 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-all shadow-sm flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export CSV
                    </a>
                </div>
            </header>

            <!-- Dashboard Content -->
            <section class="p-10 space-y-8">

                <!-- Table Container -->
                <div class="bg-white border border-slate-200/60 rounded-3xl shadow-sm overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/30 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800 text-lg italic">Semua Transaksi</h3>

                        <!-- Filter Visual (Implementasikan logikanya di Controller/JS jika diperlukan) -->
                        <select class="text-sm border-slate-200 rounded-lg text-slate-600 focus:ring-indigo-500 focus:border-indigo-500 py-2 px-3 bg-white border shadow-sm outline-none">
                            <option value="">Semua Status</option>
                            <option value="success">Success</option>
                            <option value="pending">Pending</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[11px] uppercase tracking-widest text-slate-400 font-bold border-b border-slate-100 bg-slate-50/50">
                                    <th class="px-8 py-4">ID & Waktu</th>
                                    <th class="px-8 py-4">Pelanggan</th>
                                    <th class="px-8 py-4 text-right">Total Bayar</th>
                                    <th class="px-8 py-4 text-center">Status</th>
                                    <th class="px-8 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                <?php if (!empty($transactions)): ?>
                                    <?php foreach ($transactions as $tr): ?>
                                        <tr class="group hover:bg-slate-50/80 transition-all">

                                            <!-- Kolom ID & Waktu -->
                                            <td class="px-8 py-5">
                                                <p class="text-sm font-bold text-slate-800">#<?= html_escape($tr->kode_transaksi) ?></p>
                                                <p class="text-[10px] text-slate-400 font-medium tracking-tight"><?= date('d M Y, H:i', strtotime($tr->tanggal)) ?></p>
                                            </td>

                                            <!-- Kolom Pelanggan -->
                                            <td class="px-8 py-5">
                                                <p class="text-sm font-bold text-slate-700"><?= html_escape($tr->full_name ?? 'Unknown User') ?></p>
                                                <p class="text-[10px] text-slate-400 uppercase tracking-tight"><?= html_escape($tr->payment_method ?? '') ?></p>
                                            </td>

                                            <!-- Kolom Total -->
                                            <td class="px-8 py-5 text-right font-black text-slate-900 text-sm">
                                                Rp <?= number_format($tr->total_bayar, 0, ',', '.') ?>
                                            </td>

                                            <!-- Kolom Status -->
                                            <td class="px-8 py-5 text-center">
                                                <?php
                                                // Mapping warna dinamis berdasarkan status
                                                $status_classes = [
                                                    'success' => 'bg-emerald-100 text-emerald-700',
                                                    'pending' => 'bg-amber-100 text-amber-700',
                                                    'failed'  => 'bg-rose-100 text-rose-700',
                                                    'expired' => 'bg-slate-100 text-slate-600'
                                                ];
                                                $statusKey = strtolower($tr->status);
                                                $class = $status_classes[$statusKey] ?? 'bg-slate-100 text-slate-600';
                                                ?>
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter <?= $class ?>">
                                                    <?= html_escape($tr->status) ?>
                                                </span>
                                            </td>

                                            <!-- Kolom Aksi -->
                                            <td class="px-8 py-5">
                                                <div class="flex items-center justify-center gap-2">
                                                    <!-- Tombol Detail -->
                                                    <a href="<?= base_url('DaftarTransactions/edit/' . $tr->kode_transaksi) ?>" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Lihat Detail">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    <!-- tombol success -->
                                                     <a href="<?= base_url('DaftarTransactions/update_status/' . $tr->kode_transaksi . '/success') ?>"
                                                        onclick="return confirm('Apakah Anda yakin ingin MENGONFIRMASI pembayaran ini?')" class=" rounded-lg transition-all" title="success">
                                                        <p class="font-bold text-md border bg-red-700 text-white p-2 rounded-xl  ">Ubah Menjadi Success</p>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="px-8 py-20 text-center italic text-slate-400 text-sm">Belum ada transaksi yang tercatat.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                            <p class="text-xs text-slate-500 font-medium">Menampilkan data ke-<?= ($start + 1) ?> sampai <?= count($transactions) + $start ?> dari <?= $total ?> entri</p>
                            <?= $pagination ?>
                        </div>
                    </div>
                </div>

            </section>
        </main>
    </div>

</body>

</html>