<?php $this->load->view('components/navbar');
?>


<main class="min-h-screen bg-[#F8F9FA] text-[#2C3E50] py-12 px-4 md:px-8">
    <div class="max-w-5xl mx-auto">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-black text-[#2C3E50] tracking-tight">
                    Riwayat <span class="text-[#005B52]">Transaksi</span>
                </h1>
                <p class="text-[#2C3E50]/70 mt-1 text-sm font-medium">Pantau status pesanan dan unduh e-book Anda.</p>
            </div>

            <div class="inline-flex bg-white p-1 rounded-xl border border-[#2C3E50]/10 shadow-sm">
                <button class="px-4 py-2 text-xs font-bold bg-[#F8F9FA] text-[#005B52] rounded-lg">Semua</button>
                <button class="px-4 py-2 text-xs font-bold text-[#2C3E50]/60 hover:text-[#005B52]">Pending</button>
                <button class="px-4 py-2 text-xs font-bold text-[#2C3E50]/60 hover:text-[#005B52]">Berhasil</button>
            </div>
        </div>

        <div id="transaction-container" class="space-y-4">
            <?php if (!empty($transaction)): ?>
                <?php foreach ($transaction as $row): ?>
                    <?php
                    $status = strtolower($row->status);
                    $styles = [
                        'success' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                        'pending' => 'bg-[#E67E22]/10 text-[#E67E22] border-[#E67E22]/20',
                        'failed'  => 'bg-red-50 text-red-600 border-red-100'
                    ];
                    $labels = ['success' => 'Berhasil', 'pending' => 'Menunggu', 'failed' => 'Gagal'];

                    $current_style = $styles[$status] ?? 'bg-[#F8F9FA] text-[#2C3E50]/50 border-[#2C3E50]/10';
                    $current_label = $labels[$status] ?? $status;
                    ?>

                    <div id="card-trx-<?= $row->kode_transaksi ?>" class="transaction-card bg-white border border-[#2C3E50]/10 p-6 rounded-2xl shadow-sm hover:shadow-md hover:border-[#005B52]/20 transition-all duration-500">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                            <div class="flex items-center space-x-5">
                                <div class="w-12 h-12 flex items-center justify-center bg-[#F8F9FA] rounded-xl border border-[#2C3E50]/5">
                                    <svg class="w-6 h-6 text-[#2C3E50]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>

                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-mono font-bold text-[#2C3E50]/40 uppercase">#<?= $row->kode_transaksi ?></span>
                                        <span class="text-[10px] text-[#2C3E50]/30">•</span>
                                        <span class="text-xs font-medium text-[#2C3E50]/60"><?= date('d M Y', strtotime($row->tanggal)); ?></span>
                                    </div>
                                    <h3 class="text-base font-bold text-[#2C3E50] mt-0.5">
                                        Pembelian E-Book
                                    </h3>
                                </div>
                            </div>

                            <div class="flex items-center md:flex-col md:items-end justify-between gap-2">
                                <span class="text-lg font-black text-[#2C3E50]">
                                    Rp <?= number_format($row->total_bayar, 0, ',', '.'); ?>
                                </span>

                                <span id="badge-<?= $row->kode_transaksi ?>" class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border transition-all duration-500 <?= $current_style; ?>">
                                    <?= $current_label; ?>
                                </span>
                            </div>

                            <div class="border-t border-[#F8F9FA] md:border-t-0 pt-4 md:pt-0 flex items-center gap-3 justify-end">

                                <div id="action-buttons-<?= $row->kode_transaksi ?>" class="flex items-center gap-3">
                                    <?php if ($status === 'pending'): ?>
                                        <button onclick="openCancelModal('<?= $row->kode_transaksi ?>')"
                                            class="inline-flex items-center justify-center px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl transition-all shadow-md shadow-red-600/10 active:scale-95 whitespace-nowrap">
                                            Batalkan Pembelian
                                        </button>
                                    <?php endif; ?>
                                </div>

                                <button onclick="goToDetail('<?= $row->kode_transaksi ?>', '<?= $status ?>')"
                                    class="inline-flex items-center justify-center px-6 py-2.5 bg-[#005B52] rounded-xl hover:bg-[#00443d] text-white text-xs font-bold transition-all shadow-md shadow-[#005B52]/10 active:scale-95 whitespace-nowrap">
                                    Detail Transaksi
                                </button>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

                <div id="pagination-section" class="mt-12 flex justify-center">
                    <div class="pagination-wrapper">
                        <?= $pagination; ?>
                    </div>
                </div>

            <?php else: ?>
                <div class="bg-white text-center py-24 rounded-[2.5rem] border border-[#2C3E50]/10 shadow-sm px-6">
                    <div class="w-20 h-20 bg-[#F8F9FA] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-[#2C3E50]/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-[#2C3E50]">Belum Ada Riwayat</h2>
                    <p class="text-[#2C3E50]/50 mt-2 max-w-xs mx-auto text-sm">Jelajahi koleksi e-book kami dan mulailah membaca hari ini.</p>
                    <a href="<?= base_url('kategori'); ?>" class="mt-8 inline-flex px-8 py-3 bg-[#005B52] rounded-xl hover:bg-[#00443d] text-white font-bold transition-all shadow-md shadow-[#005B52]/10">Mulai Belanja</a>
                </div>
            <?php endif; ?>
        </div>

        <div id="toast-container" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

    </div>
</main>

<div id="cancel-modal" onclick="closeCancelModalOverlay(event)" class="hidden fixed inset-0 z-[999] items-center justify-center bg-slate-950/40 backdrop-blur-sm p-4 transition-all duration-300 opacity-0">
    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-2xl max-w-md w-full p-7 transform scale-95 transition-all duration-300">
        <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center mb-5 border border-red-100">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <h3 class="text-xl font-black text-[#2C3E50]">Batalkan Pesanan?</h3>
        <p class="text-slate-500 text-sm mt-2 leading-relaxed">Tindakan ini akan mengubah status pesanan menjadi gagal. Apakah Anda yakin ingin membatalkan transaksi <span id="modal-target-code" class="font-mono font-bold text-slate-800">#000</span>?</p>
        <div class="flex items-center gap-3 mt-8">
            <button onclick="closeCancelModal()" class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-all active:scale-95">
                Kembali
            </button>
            <button id="modal-confirm-btn" class="flex-1 py-3 bg-red-600 hover:bg-red-700 text-white font-bold text-xs rounded-xl transition-all shadow-lg shadow-red-600/10 active:scale-95">
                Ya, Batalkan
            </button>
        </div>
    </div>
</div>

<?php $this->load->view('components/Footer'); ?>

<script>
    let activeCancelTrxCode = null;

    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toastId = 'toast-' + Date.now();
        const colorClass = type === 'success' ? 'border-red-600 text-red-600' : 'border-slate-400 text-slate-500';
        const iconClass = type === 'success' ? 'fa-minus-circle' : 'fa-info-circle';

        const toastHTML = `
            <div id="${toastId}" class="pointer-events-auto flex items-center gap-4 bg-white border-l-4 ${colorClass} p-5 pr-10 rounded-2xl shadow-2xl shadow-slate-200/50 transition-all duration-500 transform translate-x-0 overflow-hidden min-w-[320px]">
                <div class="flex-none w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center">
                    <i class="fas ${iconClass}"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">E-Pustaka System</p>
                    <p class="text-sm font-bold text-slate-700">${message}</p>
                </div>
                <div class="absolute bottom-0 left-0 h-1 bg-slate-100 w-full">
                    <div class="h-full bg-current opacity-20 transition-all duration-[3000ms] ease-linear w-full" id="progress-${toastId}"></div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', toastHTML);
        const toastElement = document.getElementById(toastId);

        setTimeout(() => {
            const progressBar = document.getElementById(`progress-${toastId}`);
            if (progressBar) progressBar.style.width = '0%';
        }, 10);

        setTimeout(() => {
            if (toastElement) {
                toastElement.classList.add('opacity-0', 'translate-x-10');
                setTimeout(() => toastElement.remove(), 500);
            }
        }, 3000);
    }

    function openCancelModal(kodeTransaksi) {
        activeCancelTrxCode = kodeTransaksi;
        const modal = document.getElementById('cancel-modal');
        const modalBox = modal.querySelector('div');
        document.getElementById('modal-target-code').innerText = '#' + kodeTransaksi;

        document.getElementById('modal-confirm-btn').onclick = function() {
            executeCancel(activeCancelTrxCode);
        };

        modal.classList.replace('hidden', 'flex');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalBox.classList.replace('scale-95', 'scale-100');
        }, 10);
    }

    function closeCancelModal() {
        const modal = document.getElementById('cancel-modal');
        const modalBox = modal.querySelector('div');
        modal.classList.remove('opacity-100');
        modalBox.classList.replace('scale-100', 'scale-95');
        setTimeout(() => {
            modal.classList.replace('flex', 'hidden');
            document.body.style.overflow = 'auto';
            activeCancelTrxCode = null;
        }, 300);
    }

    function closeCancelModalOverlay(e) {
        if (e.target.id === 'cancel-modal') closeCancelModal();
    }

    // EXECUTE CANCEL: Mengubah status menjadi 'Gagal' tanpa opsi menghapus card
    function executeCancel(kodeTransaksi) {
        closeCancelModal();

        const targetUrl = "<?= base_url('transaction/updatestatusfailed') ?>";
        const formData = new FormData();
        formData.append('kode_transaksi', kodeTransaksi);

        fetch(targetUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) throw new Error('HTTP error');
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    showToast(`Pesanan #${kodeTransaksi} telah dibatalkan.`, 'success');

                    // Ubah gaya visual Badge status secara realtime menjadi 'Gagal'
                    const badge = document.getElementById('badge-' + kodeTransaksi);
                    if (badge) {
                        badge.className = "px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border transition-all duration-500 bg-red-50 text-red-600 border-red-100";
                        badge.innerText = "Gagal";
                    }

                    // Kosongkan pembungkus aksi agar tombol "Batalkan Pembelian" hilang sepenuhnya
                    const btnWrapper = document.getElementById('action-buttons-' + kodeTransaksi);
                    if (btnWrapper) {
                        btnWrapper.innerHTML = '';
                    }
                } else {
                    showToast(data.message || 'Gagal merubah status.', 'info');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Sistem gagal memproses pembatalan.', 'info');
            });
    }

    function goToDetail(kodeTransaksi, statusTransaksi) {
        // 1. Buat elemen form dinamis
        const form = document.createElement('form');
        form.method = 'POST';

        // SUNTIKKAN KODE TRANSAKSI SEBAGAI SLUG DI URL ACTION
        form.action = "<?= base_url('transactions/index/') ?>" + kodeTransaksi;

        // 2. Tambahkan input hidden HANYA untuk 'status'
        const inputStatus = document.createElement('input');
        inputStatus.type = 'hidden';
        inputStatus.name = 'status'; // Namanya tetap 'status'
        inputStatus.value = statusTransaksi; // Berisi 'pending'/'success'/'failed'
        form.appendChild(inputStatus);

        // 3. Submit form ke backend
        document.body.appendChild(form);
        form.submit();
    }
</script>