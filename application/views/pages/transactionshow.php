<?php
$this->load->view('templates/header');
$this->load->view('components/navbar');
?>
<div class="min-h-screen bg-neutral-100 p-8 text-[#1F2937] antialiased">
    <div class="max-w-2xl mx-auto bg-white shadow-[0_4px_20px_rgba(0,0,0,0.05)] rounded-3xl overflow-hidden border border-neutral-200">

        <div class="px-8 py-6 flex justify-between items-center border-b border-neutral-200">
            <a href="<?= base_url('transaction') ?>" class="group flex items-center text-xs font-bold tracking-widest uppercase text-neutral-600 hover:text-[#005B52] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
            <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-neutral-500">Transaction Details</span>
        </div>

        <div class="p-10">
            <div class="mb-12">
                <h1 class="text-3xl font-extrabold tracking-tight text-[#1F2937] mb-2">Invoice Statement</h1>
                <div class="flex items-center space-x-2">
                    <p class="text-sm text-neutral-600 font-semibold bg-neutral-100 px-2 py-0.5 rounded font-mono"><?= $kode_transaksi ?></p>
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
                                <h4 class="text-sm font-bold text-[#1F2937]"><?= $item->judul_buku ?></h4>
                                <p class="text-xs text-neutral-600 mt-0.5 font-medium">
                                    <?= $qty ?> Unit &times; <span class="font-mono text-[#1F2937] font-semibold">Rp <?= number_format($item->harga_beli, 0, ',', '.') ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-[#1F2937] font-mono">
                                Rp <?= number_format($subtotal, 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="my-10 border-t border-neutral-200"></div>

            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-neutral-600 font-medium">Subtotal</span>
                    <span class="text-[#1F2937] font-bold font-mono">Rp <?= number_format($grandTotal, 0, ',', '.') ?></span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-neutral-600 font-medium">Tax (0%)</span>
                    <span class="text-neutral-500 font-mono">Rp 0</span>
                </div>
                <div class="flex justify-between items-center pt-4 border-t border-dashed border-neutral-200 mt-4">
                    <span class="text-sm font-bold uppercase tracking-[0.1em] text-[#1F2937]">Total Amount</span>
                    <div class="text-3xl font-black tracking-tighter text-[#FF8A00]">
                        <span class="text-xs font-bold mr-1 text-[#1F2937]">IDR</span><?= number_format($grandTotal, 0, ',', '.') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-neutral-100 px-10 py-6 border-t border-neutral-200">
            <p class="text-[11px] text-neutral-600 font-bold text-center uppercase tracking-[0.2em]">
                Thank you for your business
            </p>
        </div>
    </div>
</div>
<?php
$this->load->view('components/Footer');
?>