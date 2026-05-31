<?php
$this->load->view('templates/header');
$this->load->view('components/navbar');

// var_dump($status); // Bisa dihapus atau dikomentari jika sudah tidak digunakan untuk debugging
?>
<div class="min-h-screen bg-[#F8F9FA] p-8 text-[#2C3E50] antialiased">
    <div class="max-w-2xl mx-auto bg-white shadow-[0_4px_20px_rgba(0,0,0,0.03)] rounded-3xl overflow-hidden border border-[#2C3E50]/10">

        <div class="px-8 py-4 flex justify-between items-center border-b border-[#2C3E50]/10 bg-white">
            <a href="<?= base_url('transaction') ?>" class="group flex items-center text-xs font-bold tracking-widest uppercase text-[#2C3E50]/70 hover:text-[#005B52] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
            <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-[#2C3E50]/50">Transaction Details</span>
        </div>

        <div class="p-10">
            <div class="mb-12">
                <h1 class="text-3xl font-black tracking-tight text-[#2C3E50] mb-2">Invoice Statement</h1>
                <div class="flex items-center space-x-2">
                    <p class="text-sm text-[#2C3E50] font-bold bg-[#F1F3F5] px-2.5 py-1 rounded font-mono">TRX-<?= $kode_transaksi ?></p>
                </div>
            </div>

            <div class="space-y-6">
                <?php
                $grandTotal = 0;
                $qty = 1;
                foreach ($details as $item):
                    
                    $subtotal = $item->harga_beli * 1;
                    $grandTotal += $subtotal;
                ?>
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center gap-5">
                            <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-[#005B52]/10 text-[#005B52] font-mono text-sm font-bold">
                                #
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-[#2C3E50]"><?= $item->judul_buku ?></h4>
                                <p class="text-xs text-[#2C3E50]/70 mt-0.5 font-bold">
                                    <?= $qty ?> Unit &times; <span class="font-mono text-[#2C3E50]">Rp <?= number_format($item->harga_beli, 0, ',', '.') ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-[#2C3E50] font-mono">
                                Rp <?= number_format($subtotal, 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="my-10 border-t border-[#2C3E50]/10"></div>

            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-[#2C3E50]/80 font-bold">Subtotal</span>
                    <span class="text-[#2C3E50] font-black font-mono">Rp <?= number_format($grandTotal, 0, ',', '.') ?></span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-[#2C3E50]/60 font-semibold">Tax (0%)</span>
                    <span class="text-[#2C3E50]/40 font-mono">Rp 0</span>
                </div>
                
                <div class="flex justify-between items-center pt-4 border-t border-dashed border-[#2C3E50]/20 mt-4">
                    <span class="text-xs font-black uppercase tracking-[0.1em] text-[#2C3E50]">Total Amount</span>
                    <div class="text-3xl font-black tracking-tighter text-[#E67E22]">
                        <span class="text-xs font-bold mr-1 text-[#2C3E50]">IDR</span><?= number_format($grandTotal, 0, ',', '.') ?>
                    </div>
                </div>
            </div>

            <?php if (strtolower($status) !== 'success'): ?>
                <div class="pt-10">
                    <form action="<?= base_url('payments/execute_payment') ?>" method="POST">
                        <input type="hidden" name="order_id" value="<?= $kode_transaksi ?>">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="method" value="gopay">

                        <button type="submit" class="w-full py-4 bg-[#005B52] hover:bg-[#00443d] text-white font-black text-sm rounded-xl transition-all shadow-lg shadow-[#005B52]/20 active:scale-[0.98] text-center tracking-wide uppercase">
                            Bayar Sekarang
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <div class="pt-10">
                    <div class="w-full py-4 bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold text-sm rounded-xl text-center tracking-wide uppercase">
                        ✓ Transaksi Selesai
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="bg-[#F8F9FA] px-10 py-6 border-t border-[#2C3E50]/10">
            <p class="text-[10px] text-[#2C3E50]/50 font-black text-center uppercase tracking-[0.2em]">
                Thank you for your business
            </p>
        </div>
    </div>
</div>
<?php
$this->load->view('components/Footer');
?>