<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA | Daftar Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-[#F8F9FA] text-[#2C3E50] antialiased">

    <div class="flex min-h-screen">
        <?php $this->load->view('components/sidebarAdmin'); ?>

        <main class="flex-1 flex flex-col">
            <header class="h-20 bg-[#FFFFFF] border-b border-[#2C3E50]/20 flex items-center justify-between px-10 sticky top-0 z-10 shadow-sm">
                <div>
                    <h2 class="text-xl font-bold text-[#005B52] tracking-tight">Riwayat Transaksi</h2>
                    <p class="text-xs text-[#2C3E50] font-semibold opacity-90">Pantau arus kas, status pembayaran, dan riwayat pesanan.</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="<?= base_url('export_csv') ?>" class="px-5 py-2.5 text-sm font-bold text-[#E67E22] bg-[#FFFFFF] border border-[#E67E22]/30 rounded-xl hover:bg-[#E67E22]/10 transition-all shadow-sm flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export CSV
                    </a>
                </div>
            </header>

            <section class="p-10 space-y-8">

                <div class="bg-[#FFFFFF] border border-[#2C3E50]/20 rounded-3xl shadow-md overflow-hidden">
                    <div class="px-8 py-6 border-b border-[#2C3E50]/20 bg-[#F8F9FA] flex justify-between items-center">
                        <h3 class="font-bold text-[#005B52] text-lg">Semua Transaksi</h3>

                        <select class="text-sm border-[#2C3E50]/30 rounded-lg text-[#2C3E50] font-semibold focus:ring-2 focus:ring-[#005B52]/20 focus:border-[#005B52] py-2 px-3 bg-[#FFFFFF] border shadow-sm outline-none transition-all">
                            <option value="">Semua Status</option>
                            <option value="success">Success</option>
                            <option value="pending">Pending</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[11px] uppercase tracking-widest text-[#2C3E50] font-black border-b border-[#2C3E50]/20 bg-[#F8F9FA]">
                                    <th class="px-8 py-4">ID & Waktu</th>
                                    <th class="px-8 py-4">Pelanggan</th>
                                    <th class="px-8 py-4 text-right">Total Bayar</th>
                                    <th class="px-8 py-4 text-center">Status</th>
                                    <th class="px-8 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#2C3E50]/10">
                                <?php if (!empty($transactions)): ?>
                                    <?php foreach ($transactions as $tr): ?>
                                        <tr class="group hover:bg-[#F8F9FA] transition-all">

                                            <td class="px-8 py-5">
                                                <p class="text-sm font-bold text-[#2C3E50] group-hover:text-[#005B52] transition-colors">#<?= html_escape($tr->kode_transaksi) ?></p>
                                                <p class="text-[10px] text-[#2C3E50]/80 font-bold tracking-tight"><?= date('d M Y, H:i', strtotime($tr->tanggal)) ?></p>
                                            </td>

                                            <td class="px-8 py-5">
                                                <p class="text-sm font-bold text-[#2C3E50]"><?= html_escape($tr->full_name ?? 'Unknown User') ?></p>
                                                <p class="text-[10px] text-[#005B52] font-black uppercase tracking-wider"><?= html_escape($tr->payment_method ?? '') ?></p>
                                            </td>

                                            <td class="px-8 py-5 text-right font-black text-[#2C3E50] text-sm">
                                                Rp <?= number_format($tr->total_bayar, 0, ',', '.') ?>
                                            </td>

                                            <td class="px-8 py-5 text-center">
                                                <?php
                                                $status_classes = [
                                                    'success' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                                    'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                                    'failed'  => 'bg-rose-50 text-rose-700 border-rose-200',
                                                    'expired' => 'bg-slate-100 text-slate-600 border-slate-200'
                                                ];
                                                $statusKey = strtolower($tr->status);
                                                $class = $status_classes[$statusKey] ?? 'bg-slate-100 text-slate-600 border-slate-200';
                                                ?>
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border <?= $class ?>">
                                                    <?= html_escape($tr->status) ?>
                                                </span>
                                            </td>

                                            <td class="px-8 py-5">
                                                <div class="flex items-center justify-center gap-3">
                                                    <a href="<?= base_url('DaftarTransactions/edit/' . $tr->kode_transaksi) ?>" class="p-2 text-[#E67E22] hover:text-[#D35400] hover:bg-[#E67E22]/10 rounded-xl transition-all" title="Lihat Detail">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    
                                                    <a href="<?= base_url('DaftarTransactions/update_status/' . $tr->kode_transaksi . '/success') ?>"
                                                       onclick="return confirm('Apakah Anda yakin ingin MENGONFIRMASI pembayaran ini?')" 
                                                       class="bg-[#005B52] rounded-xl hover:bg-[#00443d] px-4 py-2 text-white text-xs font-bold transition-all shadow-md shadow-[#005B52]/10 active:scale-95 inline-block" 
                                                       title="Konfirmasi Berhasil">
                                                        Konfirmasi Success
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="px-8 py-20 text-center font-bold text-[#2C3E50]/60 italic text-sm">Belum ada transaksi yang tercatat dalam sistem database.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-8 py-6 bg-[#F8F9FA] border-t border-[#2C3E50]/20">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                            <p class="text-xs text-[#2C3E50] font-black uppercase tracking-wider">Menampilkan data ke-<?= ($start + 1) ?> sampai <?= count($transactions) + $start ?> dari <?= $total ?> entri</p>
                            <div class="pagination-wrapper">
                                <?= $pagination ?>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </main>
    </div>

</body>

</html>