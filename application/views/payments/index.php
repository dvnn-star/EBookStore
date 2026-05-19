    <?php

    ?>

    <!DOCTYPE html>
    <html lang="id" class="h-full">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-BookStore | Pembayaran Pesanan</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>

    <body class="h-full bg-slate-50 text-slate-900 antialiased">

        <!-- Simple Navbar -->
        <nav class="h-16 bg-white border-b border-slate-200 flex items-center px-6 lg:px-20 justify-between">
            <h1 class="text-xl font-black text-slate-800 tracking-tighter italic">E-Book<span class="text-indigo-600">Store.</span></h1>
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Secure Checkout</span>
        </nav>

        <main class="max-w-6xl mx-auto py-10 px-6 lg:px-0">
            <div class="flex flex-col lg:flex-row gap-8">

                <div class="flex-1 space-y-6">
                    <div class="bg-white border border-slate-200 rounded-[2rem] p-8 shadow-sm">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-slate-800">Detail Pesanan</h3>
                                <p class="text-xs text-slate-400 font-mono">Invoice: #<?= $transaction->kode_transaksi ?></p>
                            </div>
                            <span class="px-3 py-1 bg-amber-50 text-amber-600 border border-amber-100 text-[10px] font-black uppercase rounded-lg">Awaiting Payment</span>
                        </div>

                        <!-- Book Items (Loop if multiple, here assuming single) -->
                        <?php foreach ($details as $detail): ?>
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">

                                    <div class="flex-1">
                                        <h4 class="text-sm font-bold text-slate-800"><?= $detail->judul_buku ?></h4>
                                        <p class="text-[11px] text-slate-400 uppercase font-medium tracking-tight"><?= $detail->penulis ?></p>
                                        <div class="flex justify-between items-center mt-2">
                                            <span class="text-xs font-bold text-indigo-600">1 unit</span>
                                            <span class="text-sm font-black text-slate-800">Rp <?= number_format($detail->harga_beli, 0, ',', '.') ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- Total Calculation -->
                        <div class="mt-8 pt-6 border-t border-dashed border-slate-200 space-y-3">

                            <div class="flex justify-between text-sm">
                                <span class="text-slate-400">Pajak (0%)</span>
                                <span class="font-bold text-slate-700">Rp 0</span>
                            </div>
                            <div class="flex justify-between items-center pt-3">
                                <span class="text-base font-bold text-slate-800">Total Bayar</span>
                                <span class="text-xl font-black text-indigo-600 tracking-tight">Rp <?= number_format($transaction->total_bayar, 0, ',', '.') ?></span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="w-full lg:w-[400px] space-y-6">
                    <div class="bg-slate-900 rounded-[2rem] p-8 text-white shadow-2xl shadow-slate-200">
                        <h3 class="text-lg font-bold mb-6">Pilih Pembayaran</h3>

                        <form action="<?= base_url('payments/execute_payment') ?>" method="POST" class="space-y-4">
                            <input type="hidden" name="order_id" value="<?= $transaction->kode_transaksi ?>">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                            <!-- Bank Transfer -->
                            <label class="block relative group cursor-pointer">
                                <input type="radio" name="method" value="bca" class="peer hidden" checked>
                                <div class="p-4 bg-slate-800 border border-slate-700 rounded-2xl transition-all peer-checked:border-indigo-500 peer-checked:bg-slate-800/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-bold text-indigo-600 text-xs italic">BCA</div>
                                        <div>
                                            <p class="text-sm font-bold">Transfer Bank BCA</p>
                                            <p class="text-[10px] text-slate-400">Konfirmasi Otomatis</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <!-- E-Wallet -->
                            <label class="block relative group cursor-pointer">
                                <input type="radio" name="method" value="gopay" class="peer hidden">
                                <div class="p-4 bg-slate-800 border border-slate-700 rounded-2xl transition-all peer-checked:border-indigo-500 peer-checked:bg-slate-800/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center font-bold text-white text-xs">GO</div>
                                        <div>
                                            <p class="text-sm font-bold">GoPay / QRIS</p>
                                            <p class="text-[10px] text-slate-400">Pembayaran Instan</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <button type="submit" class="w-full py-4 mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl transition-all shadow-lg shadow-indigo-500/20 active:scale-[0.98]">
                                Bayar Sekarang
                            </button>
                        </form>

                        <p class="mt-6 text-[10px] text-slate-500 text-center italic">
                            Dengan melanjutkan, Anda menyetujui Ketentuan Layanan kami.
                        </p>
                    </div>

                    <!-- Assistance Card -->
                    <div class="bg-white border border-slate-200 rounded-3xl p-6 flex items-center gap-4">
                        <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-700">Butuh bantuan?</p>
                            <p class="text-[10px] text-slate-400">Hubungi tim support kami (24/7)</p>
                        </div>
                    </div>
                </div>

            </div>
        </main>

    </body>

    </html>