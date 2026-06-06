<?php $this->load->view('components/navbar'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($buku->judul_buku); ?> - Detail Buku</title>
</head>
<body class="bg-[#F8F9FA] text-[#2C3E50] font-sans antialiased">

<main class="min-h-screen bg-gradient-to-b from-slate-50 via-white to-slate-100 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <a href="<?= base_url(); ?>"
            class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-[#0E6D64] mb-8">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali ke Katalog
        </a>

        <div class="grid lg:grid-cols-12 gap-10">

            <!-- Cover -->
            <div class="lg:col-span-4">

                <div class="sticky top-24">

                    <div
                        class="bg-white rounded-3xl shadow-2xl shadow-slate-200 overflow-hidden border border-slate-100">

                        <img src="<?= base_url('assets/images/Buku/' . htmlspecialchars($buku->gambar)); ?>"
                            class="w-full aspect-[3/4] object-cover hover:scale-105 transition duration-500">

                    </div>

                    <div class="mt-6 bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">

                        <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">
                            Digital License
                        </p>

                        <h2 class="text-4xl font-black text-[#0E6D64] mt-2">
                            Rp<?= number_format($buku->harga,0,',','.'); ?>
                        </h2>

                        <div class="mt-5 space-y-3">

                            <div class="flex items-center gap-2 text-sm">
                                <i class="fa-solid fa-circle-check text-green-500"></i>
                                Akses Selamanya
                            </div>

                            <div class="flex items-center gap-2 text-sm">
                                <i class="fa-solid fa-download text-green-500"></i>
                                Download Kapan Saja
                            </div>

                            <div class="flex items-center gap-2 text-sm">
                                <i class="fa-solid fa-mobile-screen text-green-500"></i>
                                Multi Device
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Content -->
            <div class="lg:col-span-8">

                <div class="bg-white rounded-3xl border border-slate-100 p-8 lg:p-10 shadow-sm">

                    <div class="flex flex-wrap gap-2 mb-4">

                        <span
                            class="px-3 py-1 bg-[#0E6D64]/10 text-[#0E6D64] rounded-full text-xs font-bold">
                            <?= str_replace(['_', '&'], [' ', ' & '], $buku->kategori); ?>
                        </span>

                        <div class="flex items-center gap-1 ml-auto text-[#FF8C00]">

                            <?php for($i=1;$i<=5;$i++): ?>
                                <i class="<?= ($i <= $buku->rating ? 'fas' : 'far') ?> fa-star"></i>
                            <?php endfor; ?>

                        </div>

                    </div>

                    <h1
                        class="text-3xl lg:text-5xl font-black text-slate-800 leading-tight mb-4">
                        <?= htmlspecialchars($buku->judul_buku); ?>
                    </h1>

                    <p class="text-lg text-slate-500 mb-8">
                        Ditulis oleh
                        <span class="font-bold text-slate-700">
                            <?= htmlspecialchars($buku->penulis); ?>
                        </span>
                    </p>

                    <!-- CTA -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-10">

                        <button
                            onclick="executeDetailCartAction(true)"
                            class="flex-1 bg-[#FF8C00] hover:bg-[#e67e00] text-white py-4 rounded-2xl font-bold text-sm uppercase tracking-wider shadow-lg">
                            Beli Sekarang
                        </button>

                        <button
                            onclick="executeDetailCartAction(false)"
                            class="flex-1 border border-slate-200 hover:border-[#0E6D64] hover:text-[#0E6D64] py-4 rounded-2xl font-bold text-sm uppercase tracking-wider">
                            <i class="fa-solid fa-cart-plus mr-2"></i>
                            Tambah Keranjang
                        </button>

                    </div>

                    <!-- Bento Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-10">

                        <div
                            class="bg-slate-50 rounded-2xl p-5 border border-slate-100">

                            <p class="text-xs uppercase text-slate-400 font-bold">
                                Halaman
                            </p>

                            <h3 class="text-3xl font-black text-slate-800 mt-2">
                                <?= $buku->halaman; ?>
                            </h3>

                        </div>

                        <div
                            class="bg-slate-50 rounded-2xl p-5 border border-slate-100">

                            <p class="text-xs uppercase text-slate-400 font-bold">
                                Terjual
                            </p>

                            <h3 class="text-3xl font-black text-slate-800 mt-2">
                                <?= $buku->total_terjual; ?>
                            </h3>

                        </div>

                        <div
                            class="bg-slate-50 rounded-2xl p-5 border border-slate-100 col-span-2">

                            <p class="text-xs uppercase text-slate-400 font-bold">
                                Penerbit
                            </p>

                            <h3 class="text-lg font-bold text-slate-800 mt-2">
                                <?= htmlspecialchars($buku->penerbit); ?>
                            </h3>

                        </div>

                    </div>

                    <!-- Description -->
                    <div>

                        <h2
                            class="text-xl font-black text-slate-800 mb-4">
                            Tentang Buku Ini
                        </h2>

                        <div
                            class="prose prose-sm max-w-none text-slate-600 leading-relaxed">

                            <?= nl2br(htmlspecialchars($buku->deskripsi)); ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</main>

<div id="toast-container" class="fixed bottom-6 right-6 z-[110] flex flex-col gap-3 pointer-events-none"></div>

<?php $this->load->view('components/Footer'); ?>

<script>
    // State aplikasi dipertahankan secara utuh
    const CURRENT_USER = "<?= htmlspecialchars($this->session->userdata('username') ?? 'guest'); ?>"; 
    const LOGIN_URL = "<?= base_url('login'); ?>";
    const KERANJANG_URL = "<?= base_url('keranjang'); ?>"; 
    const STORAGE_KEY = `cart_storage_${CURRENT_USER}`;
    const targetBookPayload = <?= json_encode($buku); ?>;

    function executeDetailCartAction(isRedirect) {
        if (CURRENT_USER === 'guest') {
            window.location.href = LOGIN_URL;
            return; 
        }

        let currentCart = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
        const isExist = currentCart.find(item => parseInt(item.id) === parseInt(targetBookPayload.id));
        
        if (!isExist) {
            currentCart.push(targetBookPayload);
            localStorage.setItem(STORAGE_KEY, JSON.stringify(currentCart));
            if (!isRedirect) {
                showToast(`${targetBookPayload.judul_buku} berhasil dimasukkan ke keranjang!`, 'success');
            }
        } else {
            if (!isRedirect) {
                showToast(`Buku ini sudah ada di dalam daftar keranjang Anda.`, 'info');
            }
        }

        if (isRedirect) {
            setTimeout(() => {
                window.location.href = KERANJANG_URL;
            }, 100);
        }
    }

    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toastId = 'toast-' + Date.now();
        const colorClass = type === 'success' ? 'border-l-4 border-l-[#0E6D64] text-[#0E6D64]' : 'border-l-4 border-l-[#FF8C00] text-[#FF8C00]';
        const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-info-circle';
        
        const toastHTML = `
            <div id="${toastId}" class="pointer-events-auto flex items-center gap-3 bg-white p-4 pr-8 rounded-xl shadow-xl border border-slate-100 ${colorClass} relative overflow-hidden min-w-[300px] max-w-sm transition-all duration-300 transform translate-y-2 opacity-0">
                <div class="flex-none w-8 h-8 bg-slate-50 rounded-full flex items-center justify-center text-xs">
                    <i class="fas ${iconClass}"></i>
                </div>
                <div>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Sistem Notifikasi</p>
                    <p class="text-xs font-semibold text-slate-700 leading-tight">${message}</p>
                </div>
                <div class="absolute bottom-0 left-0 h-1 bg-slate-100 w-full">
                    <div class="h-full bg-current opacity-20 transition-all duration-[2500ms] ease-linear w-full" id="progress-${toastId}"></div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', toastHTML);
        
        const toastElement = document.getElementById(toastId);
        
        // Trigger animasi masuk
        setTimeout(() => {
            if(toastElement) {
                toastElement.classList.remove('translate-y-2', 'opacity-0');
            }
            const pb = document.getElementById(`progress-${toastId}`);
            if(pb) pb.style.width = '0%';
        }, 50);

        // Animasi keluar dan hapus elemen
        setTimeout(() => {
            if(toastElement) {
                toastElement.classList.add('opacity-0', 'translate-x-10');
                setTimeout(() => toastElement.remove(), 300);
            }
        }, 2550);
    }
</script>
</body>
</html>