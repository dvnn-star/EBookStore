<?php
$this->load->view('templates/header');
$this->load->view('components/navbar');
// var_dump($details);
?>
<div class="min-h-screen bg-slate-50 p-8 text-slate-900 antialiased">
    <div class="max-w-2xl mx-auto bg-white shadow-[0_1px_3px_rgba(0,0,0,0.02),0_20px_25px_-5px_rgba(0,0,0,0.03)] rounded-3xl overflow-hidden border border-slate-100">

        <!-- Top Navigation Bar -->
        <div class="px-8 py-6 flex justify-between items-center border-b border-slate-50">
            <a href="<?= base_url('transaction') ?>" class="group flex items-center text-xs font-semibold tracking-widest uppercase text-slate-400 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
            <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-slate-300">Transaction Details</span>
        </div>

        <div class="p-10">
            <!-- Header Section -->
            <div class="mb-12">
                <h1 class="text-3xl font-bold tracking-tight text-slate-900 mb-2">Invoice Statement</h1>
                <div class="flex items-center space-x-2">
                    <p class="text-sm text-slate-400 font-medium italic"><?= $kode_transaksi ?></p>
                </div>
            </div>

            <!-- Items List -->
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
                            <!-- Subtle ID Badge -->
                            <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 font-mono text-sm group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800"><?= $item->judul_buku ?></h4>
                                <p class="text-xs text-slate-400 mt-0.5">
                                    <?= $qty ?> Unit &times; <span class="font-mono">Rp <?= number_format($item->harga_beli, 0, ',', '.') ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-slate-900 font-mono">
                                Rp <?= number_format($subtotal, 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Divider -->
            <div class="my-10 border-t border-slate-100"></div>

            <!-- Calculation -->
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-slate-400">Subtotal</span>
                    <span class="text-slate-600 font-mono">Rp <?= number_format($grandTotal, 0, ',', '.') ?></span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-slate-400">Tax (0%)</span>
                    <span class="text-slate-600 font-mono">Rp 0</span>
                </div>
                <div class="flex justify-between items-center pt-4">
                    <span class="text-sm font-bold uppercase tracking-[0.1em] text-slate-900">Total Amount</span>
                    <div class="text-3xl font-black tracking-tighter text-indigo-600">
                        <span class="text-xs font-normal mr-1">IDR</span><?= number_format($grandTotal, 0, ',', '.') ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative Footer -->
        <div class="bg-slate-50 px-10 py-6">
            <p class="text-[10px] text-slate-400 text-center uppercase tracking-[0.3em]">
                Thank you for your business
            </p>
        </div>
    </div>
</div>
<?php
$this->load->view('components/Footer');

?>