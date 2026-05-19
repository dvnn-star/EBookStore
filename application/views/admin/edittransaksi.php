<?php
$master = $details[0];

// Mapping warna badge status secara dinamis
$status_color = [
    'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
    'success' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
    'failed'  => 'bg-rose-50 text-rose-700 border-rose-200',
    'expired' => 'bg-slate-100 text-slate-600 border-slate-200'
];
$badge_class = $status_color[$master->status] ?? 'bg-slate-50 text-slate-700 border-slate-200';
?>

<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Detail Transaksi <?= $master->kode_transaksi ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="text-slate-900 antialiased p-6 lg:p-12">

    <main class="max-w-4xl mx-auto space-y-6">

        <!-- Tombol Kembali / Breadcrumb -->
        <div class="flex items-center justify-between">
            <a href="<?= base_url('DaftarTransactions') ?>" class="text-xs font-semibold text-slate-500 hover:text-indigo-600 transition-all flex items-center gap-2">
                ← Kembali ke Daftar Transaksi
            </a>
            <span class="text-xs text-slate-400 font-medium">Waktu Transaksi: <?= date('d M Y H:i', strtotime($master->tanggal)) ?></span>
        </div>

        <!-- CARD 1: INFORMASI UTAMA (HEADER) -->
        <div class="bg-white border border-slate-200 rounded-3xl p-6 lg:p-8 shadow-sm flex flex-col md:flex-row justify-between gap-6">
            <div class="space-y-2">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">ID Transaksi / Invoice</span>
                <h1 class="text-2xl font-black text-slate-800 tracking-tight font-mono">#<?= $master->kode_transaksi ?></h1>

                <div class="flex items-center gap-6 pt-2">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nama Pelanggan</p>
                        <p class="text-sm font-bold text-slate-700 capitalize"><?= $master->name ?></p>
                    </div>
                    <div class="border-l border-slate-200 pl-6">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">User ID</p>
                        <p class="text-sm font-semibold font-mono text-slate-600">ID-<?= $master->user_id ?></p>
                    </div>
                </div>
            </div>

            <div class="md:text-right flex flex-col justify-between items-start md:items-end gap-4">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Status Pembayaran</p>
                    <span class="px-3 py-1.5 border rounded-full text-xs font-bold uppercase tracking-wide <?= $badge_class ?>">
                        <?= $master->status ?>
                    </span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Nilai Invoice</p>
                    <p class="text-2xl font-black text-indigo-600 tracking-tight">Rp <?= number_format($master->total_bayar, 0, ',', '.') ?></p>
                </div>
            </div>
        </div>

        <!-- CARD 2: DETAIL ITEM BUKU (LOOPING) -->
        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-slate-50/50 border-b border-slate-200">
                <h3 class="text-sm font-bold text-slate-700">Daftar Item Buku yang Dibeli</h3>
            </div>

            <div class="divide-y divide-slate-100">
                <?php foreach ($details as $item): ?>
                    <div class="p-6 flex items-center gap-4 hover:bg-slate-50/30 transition-all">
                        <!-- Cover Buku -->
                        <div class="w-16 h-20 bg-slate-100 rounded-xl border border-slate-200 flex-shrink-0 overflow-hidden shadow-sm">
                            <?php if ($item->gambar): ?>
                                <img src="<?= base_url('uploads/books/' . $item->gambar) ?>" alt="Cover" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-[10px] font-bold text-slate-400 uppercase">No Cover</div>
                            <?php endif; ?>
                        </div>

                        <!-- Informasi Buku -->
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-slate-800 truncate"><?= $item->judul_buku ?></h4>
                            <p class="text-xs text-slate-400 font-medium truncate">Oleh: <?= $item->penulis ?></p>
                            <p class="text-[11px] text-slate-400 font-mono mt-1">ID Buku: #<?= $item->id ?></p>
                        </div>

                        <!-- Kuantitas & Harga -->
                        <div class="text-right">
                            <p class="text-xs font-bold text-slate-400"><?= $item->qty ?> Unit</p>
                            <p class="text-sm font-black text-slate-800 mt-1">Rp <?= number_format($item->harga_beli, 0, ',', '.') ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Ringkasan Perhitungan Finansial -->
            <div class="p-6 bg-slate-50/50 border-t border-slate-200 space-y-2 text-right text-sm">
                <div class="flex justify-between max-w-xs ml-auto">
                    <span class="text-slate-400">Subtotal Produk:</span>
                    <span class="font-bold text-slate-700">Rp <?= number_format($master->total_bayar, 0, ',', '.') ?></span>
                </div>
                <div class="flex justify-between max-w-xs ml-auto">
                    <span class="text-slate-400">Pajak & Biaya (0%):</span>
                    <span class="font-bold text-slate-700">Rp 0</span>
                </div>
                <div class="flex justify-between max-w-xs ml-auto pt-2 border-t border-slate-200 text-base">
                    <span class="font-bold text-slate-800">Total Bersih:</span>
                    <span class="font-black text-indigo-600">Rp <?= number_format($master->total_bayar, 0, ',', '.') ?></span>
                </div>
            </div>
        </div>

        <?php if ($master->status === 'pending'): ?>
            <div class="flex gap-4 justify-end">
                <a href="<?= base_url('DaftarTransactions/update_status/' . $master->kode_transaksi . '/failed') ?>"
                    onclick="return confirm('Apakah Anda yakin ingin MENOLAK transaksi ini?')"
                    class="px-6 py-3 bg-rose-50 text-rose-600 border border-rose-200 font-bold text-xs rounded-xl hover:bg-rose-100 text-center transition-all active:scale-[0.98]">
                    Tolak & Batalkan
                </a>

                <a href="<?= base_url('DaftarTransactions/update_status/' . $master->kode_transaksi . '/success') ?>"
                    onclick="return confirm('Apakah Anda yakin ingin MENGONFIRMASI pembayaran ini?')"
                    class="px-6 py-3 bg-indigo-600 text-white font-bold text-xs rounded-xl hover:bg-indigo-700 text-center shadow-md shadow-indigo-500/10 transition-all active:scale-[0.98]">
                    Konfirmasi Pembayaran
                </a>
            </div>
        <?php endif; ?>

    </main>

</body>

</html>