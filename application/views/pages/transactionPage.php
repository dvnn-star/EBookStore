<?php $this->load->view('components/navbar'); ?>
<?php

// var_dump($data);
$i = 0 ;

?>
<!-- Main Content Area: Background abu-abu sangat muda untuk kontras dengan kartu putih -->
<main class="min-h-screen bg-gray-50 text-gray-800 py-12 px-4 md:px-8">
    <div class="max-w-6xl mx-auto">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 pb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">
                    Riwayat <span class="text-[#0E6D64]">Transaksi</span>
                </h1>
                <p class="text-gray-500 mt-1">Kelola dan pantau seluruh pesanan Anda.</p>
            </div>
            
            <!-- Filter -->
            <div class="mt-4 md:mt-0">
                <select class="bg-white border border-gray-200 text-sm rounded-xl focus:ring-[#0E6D64] focus:border-[#0E6D64] block w-full p-3 shadow-sm outline-none transition-all">
                    <option selected>Semua Status</option>
                    <option value="success">Berhasil</option>
                    <option value="pending">Menunggu Pembayaran</option>
                    <option value="failed">Dibatalkan</option>
                </select>   
            </div>
        </div>

        <!-- Transaction List -->
        <div class="space-y-4">
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $row): ?>
                    <!-- Card: Putih Bersih dengan Border Halus -->
                    <div class="bg-white border border-gray-100 p-5 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col md:flex-row md:items-center justify-between gap-6">
                        
                        <div class="flex items-center space-x-5">
                            <!-- Icon Container -->
                            <div class="p-4 bg-teal-50 rounded-2xl">
                                <svg class="w-7 h-7 text-[#0E6D64]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    #<?= $i +=1 ?>
                                </h3>
                                <div class="flex items-center text-sm text-gray-500 mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <?= date('d F Y', strtotime($row->tanggal)); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Status & Price -->
                        <div class="flex flex-row md:flex-col justify-between items-center md:items-end gap-2">
                            <span class="text-lg font-bold text-[#0E6D64]">
                                Rp <?= number_format($row->total_bayar, 0, ',', '.'); ?>
                            </span>
                            
                            <?php 
                                // Mapping warna status untuk tema terang
                                $status_class = [
                                    'success' => 'bg-green-100 text-green-700',
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'failed'  => 'bg-red-100 text-red-700'
                            ];
                                $label = ['success' => 'Berhasil', 'pending' => 'Menunggu', 'failed' => 'Gagal'];
                                
                                $current_status = $row->status;
                                $class = $status_class[$current_status] ?? 'bg-gray-100 text-gray-700';
                                $text = $label[$current_status] ?? $current_status;
                            ?>
                            
                            <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $class; ?>">
                                <?= $text; ?>
                            </span>
                        </div>

                        <!-- Action -->
                        <div class="md:ml-4 border-t md:border-t-0 pt-4 md:pt-0">
                            <a href="<?= base_url('transaction/' . $row->kode_transaksi); ?>" class="block w-full text-center px-6 py-2.5 bg-[#0E6D64] text-white font-semibold rounded-xl hover:bg-[#0a5a52] transition-colors shadow-sm active:scale-95 transform">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty State -->
                <div class="bg-white text-center py-24 rounded-3xl border border-gray-100 shadow-sm">
                    <div class="inline-flex p-5 bg-gray-50 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Belum Ada Transaksi</h2>
                    <p class="text-gray-500 mt-2">Sepertinya Anda belum melakukan pemesanan apa pun.</p>
                    <a href="<?= base_url('kategori'); ?>" class="mt-6 inline-block text-[#0E6D64] font-bold hover:underline">Jelajahi Buku  Sekarang →</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php $this->load->view('components/Footer'); ?>