<?php $this->load->view('components/navbar'); ?>


<main class="min-h-screen bg-[#F8FAFC] text-slate-800 py-12 px-4 md:px-8">
    <div class="max-w-5xl mx-auto">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">
                    Riwayat <span class="text-[#0E6D64]">Transaksi</span>
                </h1>
                <p class="text-slate-500 mt-1 text-sm font-medium">Pantau status pesanan dan unduh e-book Anda.</p>
            </div>
            
            <!-- Filter Ringkas -->
            <div class="inline-flex bg-white p-1 rounded-xl border border-slate-200 shadow-sm">
                <button class="px-4 py-2 text-xs font-bold bg-slate-100 text-slate-900 rounded-lg">Semua</button>
                <button class="px-4 py-2 text-xs font-bold text-slate-500 hover:text-[#0E6D64]">Pending</button>
                <button class="px-4 py-2 text-xs font-bold text-slate-500 hover:text-[#0E6D64]">Berhasil</button>
            </div>
        </div>

        <!-- Transaction List -->
        <div class="space-y-4">
            <?php if (!empty($transaction)): ?>
                <?php foreach ($transaction as $row): ?>
                    <!-- Card Item -->
                    <div class="bg-white border border-slate-200/60 p-6 rounded-2xl shadow-sm hover:shadow-md hover:border-[#0E6D64]/20 transition-all duration-300">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                            
                            <div class="flex items-center space-x-5">
                                <!-- Status Icon -->
                                <div class="w-12 h-12 flex items-center justify-center bg-slate-50 rounded-xl border border-slate-100">
                                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-mono font-bold text-slate-400 uppercase">#<?= $row->kode_transaksi ?></span>
                                        <span class="text-[10px] text-slate-300">•</span>
                                        <span class="text-xs font-medium text-slate-500"><?= date('d M Y', strtotime($row->tanggal)); ?></span>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-900 mt-0.5">
                                        Pembelian E-Book
                                    </h3>
                                </div>
                            </div>

                            <!-- Price & Status Badge -->
                            <div class="flex items-center md:flex-col md:items-end justify-between gap-2">
                                <span class="text-lg font-black text-slate-900">
                                    Rp <?= number_format($row->total_bayar, 0, ',', '.'); ?>
                                </span>
                                
                                <?php 
                                    $status = strtolower($row->status);
                                    $styles = [
                                        'success' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                        'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                        'failed'  => 'bg-red-50 text-red-600 border-red-100'
                                    ];
                                    $labels = ['success' => 'Berhasil', 'pending' => 'Menunggu', 'failed' => 'Gagal'];
                                    
                                    $current_style = $styles[$status] ?? 'bg-slate-50 text-slate-500 border-slate-100';
                                    $current_label = $labels[$status] ?? $status;
                                ?>
                                
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border <?= $current_style; ?>">
                                    <?= $current_label; ?>
                                </span>
                            </div>

                            <!-- CTA Button -->
                            <div class="border-t border-slate-50 md:border-t-0 pt-4 md:pt-0">
                                <a href="<?= base_url('transactions/index/' . $row->kode_transaksi); ?>" 
                                   class="inline-flex items-center justify-center px-6 py-2.5 bg-[#0E6D64] text-white text-xs font-bold rounded-xl hover:bg-[#0a5a52] transition-all shadow-lg shadow-[#0E6D64]/10 active:scale-95">
                                    Detail Transaksi
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Pagination Area -->
                <div class="mt-12 flex justify-center">
                    <div class="pagination-wrapper">
                        <?= $pagination; ?>
                    </div>
                </div>

            <?php else: ?>
                <!-- Empty State -->
                <div class="bg-white text-center py-24 rounded-[2.5rem] border border-slate-200/60 shadow-sm px-6">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900">Belum Ada Riwayat</h2>
                    <p class="text-slate-400 mt-2 max-w-xs mx-auto text-sm">Jelajahi koleksi e-book kami dan mulailah membaca hari ini.</p>
                    <a href="<?= base_url('kategori'); ?>" class="mt-8 inline-flex px-8 py-3 bg-[#0E6D64] text-white font-bold rounded-xl hover:shadow-xl hover:shadow-[#0E6D64]/20 transition-all">Mulai Belanja</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php $this->load->view('components/Footer'); ?>