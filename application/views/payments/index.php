<?php

?>

<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA | Pembayaran Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-[#F8F9FA] text-[#2C3E50] antialiased">

    <nav class="h-16 bg-[#FFFFFF] border-b border-[#2C3E50]/10 flex items-center px-6 lg:px-20 justify-between shadow-sm">
        <div class="flex items-center gap-4">
            <h1 class="text-xl font-black text-[#2C3E50] tracking-tighter italic">E-PUSTAKA<span class="text-[#005B52]">.</span></h1>
        </div>
        <span class="text-[10px] font-black text-[#005B52] uppercase tracking-widest bg-[#005B52]/10 px-3 py-1 rounded-md">Secure Checkout</span>
    </nav>

    <main class="max-w-3xl mx-auto py-10 px-6 lg:px-0">
        <div class="space-y-6">

            <div class="bg-[#FFFFFF] border border-[#2C3E50]/10 rounded-2xl shadow-sm overflow-hidden">
                
                <div class="px-8 py-4 border-b border-[#2C3E50]/10 flex items-center justify-between bg-white">
                    <a href="javascript:history.back()" class="text-[11px] font-bold text-[#2C3E50]/70 hover:text-[#005B52] tracking-widest uppercase flex items-center gap-2 transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back
                    </a>
                    <span class="text-[11px] font-bold text-[#2C3E50]/50 tracking-widest uppercase">Transaction Details</span>
                </div>

                <div class="p-8 space-y-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-[#2C3E50] tracking-tight mb-2">Invoice Statement</h3>
                            <span class="px-2 py-1 bg-[#F1F3F5] text-[#2C3E50]/80 font-mono font-bold text-[11px] rounded tracking-wide uppercase">
                                TRX-<?= html_escape($transaction->kode_transaksi) ?>
                            </span>
                        </div>
                        <span class="px-3 py-1 bg-[#E67E22]/10 text-[#E67E22] border border-[#E67E22]/30 text-[10px] font-black uppercase rounded-lg tracking-wider">Awaiting Payment</span>
                    </div>

                    <div class="space-y-4 pt-4">
                        <?php foreach ($details as $detail): ?>
                            <div class="flex items-center justify-between py-4 border-b border-[#2C3E50]/5">
                                <div class="flex items-center gap-4">
                                    <div class="w-8 h-8 bg-[#EBF4F3] text-[#005B52] rounded flex items-center justify-center font-bold text-xs">
                                        #
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-[#2C3E50] tracking-tight"><?= $detail->judul_buku ?></h4>
                                        <p class="text-xs text-[#2C3E50]/60 font-medium mt-0.5">1 Unit × Rp <?= number_format($detail->harga_beli, 0, ',', '.') ?></p>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-[#2C3E50] font-mono">Rp <?= number_format($detail->harga_beli, 0, ',', '.') ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="pt-2 space-y-2 text-xs font-medium text-[#2C3E50]/80">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-bold text-[#2C3E50]">Rp <?= number_format($transaction->total_bayar, 0, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between pb-4 border-b border-dashed border-[#2C3E50]/20">
                            <span>Tax (0%)</span>
                            <span class="text-[#2C3E50]/50">Rp 0</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-baseline pt-2">
                        <span class="text-xs font-black uppercase tracking-wider text-[#2C3E50]">Total Amount</span>
                        <div class="text-[#E67E22] font-mono font-black flex items-baseline">
                            <span class="text-xs mr-0.5 font-bold">IDR</span>
                            <span class="text-2xl tracking-tight"><?= number_format($transaction->total_bayar, 0, ',', '.') ?></span>
                        </div>
                    </div>

                    <div class="pt-6">
                        <form action="<?= base_url('payments/execute_payment') ?>" method="POST">
                            <input type="hidden" name="order_id" value="<?= $transaction->kode_transaksi ?>">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            
                            <input type="hidden" name="method" value="gopay">

                            <button type="submit" class="w-full py-4 bg-[#005B52] hover:bg-[#00443d] text-white font-black text-sm rounded-xl transition-all shadow-lg shadow-[#005B52]/20 active:scale-[0.98] text-center tracking-wide uppercase">
                                Bayar Sekarang
                            </button>
                        </form>
                    </div>
                </div>

                <div class="py-4 bg-[#F8F9FA] border-t border-[#2C3E50]/10 text-center">
                    <p class="text-[10px] font-black tracking-widest text-[#2C3E50]/50 uppercase">Thank you for your business</p>
                </div>
            </div>

            <div class="bg-[#FFFFFF] border border-[#2C3E50]/10 rounded-2xl p-4 flex items-center justify-between shadow-sm px-8">
                <div class="flex items-center gap-3">
                    <div class="text-[#005B52]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-[#2C3E50]">Butuh bantuan transaksi?</p>
                        <p class="text-[10px] text-[#2C3E50]/60 font-semibold">Hubungi tim support E-PUSTAKA (24/7)</p>
                    </div>
                </div>
                <p class="text-[10px] text-[#2C3E50]/40 font-bold italic hidden sm:block">Secure Checkout System</p>
            </div>
        </div>
    </main>

</body>

</html>