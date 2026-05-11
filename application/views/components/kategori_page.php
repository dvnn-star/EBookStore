<?php
/**
 * ARCHITECTURE: MULTI-DIMENSIONAL DATA GROUPING
 * Mengelompokkan data mentah dari database ke dalam kategori visual yang koheren.
 */
$semua_buku = isset($semua_buku) ? $semua_buku : [];
$koleksi_buku = [];
$judul_referensi = [
    'fiksi'          => 'Koleksi Fiksi',
    'bisnis&ekonomi' => 'Koleksi Bisnis & Ekonomi',
    'sejarah'        => 'Koleksi Sejarah',
    'edukasi'        => 'Koleksi Edukasi'
];

foreach ($semua_buku as $item) {
    $buku = (array) $item; 
    $kat = $buku['kategori'] ?? 'lainnya';
    if (!isset($koleksi_buku[$kat])) {
        $koleksi_buku[$kat] = [
            'judul_section' => $judul_referensi[$kat] ?? 'Kategori Lainnya',
            'data' => []
        ];
    }
    $koleksi_buku[$kat]['data'][] = $buku;
}
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA - Arsitektur Katalog & Keranjang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 'ep-green': '#0c6b63', 'ep-orange': '#f39c12' },
                    animation: { 
                        'fade-in': 'fadeIn 0.3s ease-out',
                        'slide-in': 'slideIn 0.4s cubic-bezier(0.16, 1, 0.3, 1)'
                    },
                    keyframes: { 
                        fadeIn: { '0%': { opacity: 0, transform: 'scale(0.95)' }, '100%': { opacity: 1, transform: 'scale(1)' } },
                        slideIn: { '0%': { transform: 'translateX(100%)', opacity: 0 }, '100%': { transform: 'translateX(0)', opacity: 1 } }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans text-slate-900">

    <main class="container mx-auto px-4 py-12 flex flex-col md:flex-row gap-10 items-start">
        
        <!-- SIDEBAR NAVIGASI KATEGORI -->
        <aside class="w-full md:w-72 flex-shrink-0 sticky top-28 self-start z-10">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200">
                <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-th-large text-ep-green"></i> Filter Kategori
                </h3>
                <nav id="sidebar-nav" class="space-y-2">
                    <?php foreach(array_keys($koleksi_buku) as $key_kategori): ?>
                        <button id="btn-<?= $key_kategori ?>" onclick="scrollToSection('<?= $key_kategori ?>')" 
                                class="nav-btn w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-300 group hover:bg-slate-50">
                            <div class="flex items-center gap-3">
                                <div class="dot w-1.5 h-1.5 rounded-full bg-slate-300 group-hover:bg-ep-green transition-colors"></div>
                                <span class="text-sm font-medium text-slate-600 group-hover:text-ep-green capitalize">
                                    <?= str_replace('&', ' & ', $key_kategori) ?>
                                </span>
                            </div>
                            <i class="fas fa-chevron-right text-[10px] text-slate-300 opacity-0 group-hover:opacity-100 transition-all nav-icon"></i>
                        </button>
                    <?php endforeach; ?>
                </nav>
            </div>
        </aside>

        <!-- AREA GRID PRODUK -->
        <div class="flex-grow space-y-16 w-full">
            <?php foreach ($koleksi_buku as $id_kategori => $kategori): ?>
            <section id="sec-<?= $id_kategori ?>" class="scroll-mt-32">
                <div class="flex items-end justify-between mb-8">
                    <div>
                        <h2 class="text-3xl font-black text-slate-800 tracking-tight"><?= $kategori['judul_section'] ?></h2>
                        <div class="h-1.5 w-12 bg-ep-green mt-3 rounded-full"></div>
                    </div>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($kategori['data'] as $book): ?>
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:border-ep-green/30 transition-all duration-500 flex flex-col h-full relative group cursor-pointer" 
                         onclick="bukaDetailBuku(this)" 
                         data-buku="<?= htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8') ?>">
                        
                        <div class="relative aspect-[3/4.5] mb-5 overflow-hidden rounded-xl bg-slate-100 shadow-inner">
                            <img src="<?= htmlspecialchars($book['gambar'] ?? '') ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 z-10">
                        </div>

                        <div class="flex-grow flex flex-col">
                            <h3 class="font-bold text-slate-800 text-sm line-clamp-2 min-h-[2.5rem] leading-snug"><?= htmlspecialchars($book['judul_buku']) ?></h3>
                            <p class="text-xs text-slate-400 mb-4">By <?= htmlspecialchars($book['penulis']) ?></p>
                            
                            <div class="mt-auto pt-4 border-t border-slate-50">
                                <p class="font-black text-lg text-ep-green mb-4">Rp<?= number_format($book['harga'], 0, ',', '.') ?></p>
                                <div class="flex gap-2">
                                    <button class="flex-grow bg-ep-orange text-white text-[11px] font-bold py-3 rounded-xl shadow-lg shadow-ep-orange/20 hover:bg-slate-800 transition-all active:scale-95" 
                                            onclick="event.stopPropagation(); cartAction(this, true);">
                                        BELI
                                    </button>
                                    <button class="flex-none border border-slate-200 bg-white text-slate-400 w-12 rounded-xl hover:border-ep-green hover:text-ep-green transition-all shadow-sm active:scale-95 flex items-center justify-center" 
                                            onclick="event.stopPropagation(); cartAction(this, false);">
                                        <i class="fas fa-cart-plus text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- TOAST NOTIFICATION CONTAINER -->
    <div id="toast-container" class="fixed bottom-10 right-10 z-[110] flex flex-col gap-4 pointer-events-none"></div>

    <!-- MODAL DETAIL BUKU -->
    <div id="modalDetail" class="fixed inset-0 bg-slate-900/60 z-[100] hidden items-center justify-center p-4 backdrop-blur-md">
        <div class="bg-white max-w-2xl w-full rounded-3xl overflow-hidden flex flex-col md:flex-row relative animate-fade-in shadow-2xl">
            <button onclick="tutupDetailBuku()" class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center bg-slate-100 text-slate-500 rounded-full hover:bg-red-50 hover:text-red-500 transition-all z-10">
                <i class="fas fa-times"></i>
            </button>
            <div class="w-full md:w-1/2 bg-slate-50 p-10 flex items-center justify-center">
                <img id="m-gambar" src="" class="h-72 object-cover shadow-2xl rounded-xl">
            </div>
            <div class="p-10 md:w-1/2 flex flex-col">
                <h2 id="m-judul" class="text-2xl font-bold text-slate-900 leading-tight mb-2"></h2>
                <p id="m-deskripsi" class="text-slate-600 text-sm leading-relaxed mb-8 line-clamp-4"></p>
                <div class="mt-auto">
                    <button id="modal-buy-btn" class="w-full bg-ep-orange text-white py-4 rounded-2xl font-bold shadow-lg shadow-ep-orange/20 hover:bg-slate-800 transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-shopping-cart"></i> TAMBAH KE KERANJANG
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        /**
         * STATE CONFIGURATION
         */
        const CURRENT_USER = "<?= htmlspecialchars($this->session->userdata('username') ?? 'guest'); ?>";
        const LOGIN_URL = "<?= base_url('login'); ?>";
        const STORAGE_KEY = `cart_storage_${CURRENT_USER}`;

        /**
         * UI ENGINE: TOAST SYSTEM
         */
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toastId = 'toast-' + Date.now();
            const colorClass = type === 'success' ? 'border-ep-green text-ep-green' : 'border-ep-orange text-ep-orange';
            const iconClass = type === 'success' ? 'fa-check' : 'fa-info-circle';
            
            const toastHTML = `
                <div id="${toastId}" class="pointer-events-auto flex items-center gap-4 bg-white border-l-4 ${colorClass} p-5 pr-10 rounded-2xl shadow-2xl shadow-slate-200/50 animate-slide-in relative overflow-hidden min-w-[320px]">
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
            setTimeout(() => document.getElementById(`progress-${toastId}`).style.width = '0%', 10);
            setTimeout(() => {
                toastElement.classList.add('opacity-0', 'translate-x-10');
                setTimeout(() => toastElement.remove(), 500);
            }, 3000);
        }

        /**
         * CART LOGIC: STATE MANAGEMENT
         */
        function cartAction(buttonElement, isRedirect) {
            if (CURRENT_USER === 'guest') {
                window.location.href = LOGIN_URL;
                return; 
            }

            const card = buttonElement.closest('[data-buku]');
            const dataBuku = JSON.parse(card.getAttribute('data-buku'));
            
            let currentCart = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
            const isExist = currentCart.find(item => item.id === dataBuku.id);

            if (!isExist) {
                currentCart.push(dataBuku);
                localStorage.setItem(STORAGE_KEY, JSON.stringify(currentCart));
                showToast(`${dataBuku.judul_buku} berhasil ditambahkan!`);
            } else {
                showToast(`Buku ini sudah ada di keranjang.`, 'info');
            }

            if (isRedirect) setTimeout(() => window.location.href = "<?= base_url('keranjang'); ?>", 800);
        }

        /**
         * MODAL ENGINE: PRESENTATION LAYER
         */
        function bukaDetailBuku(element) {
            const buku = JSON.parse(element.getAttribute('data-buku'));
            document.getElementById('m-gambar').src = buku.gambar;
            document.getElementById('m-judul').innerText = buku.judul_buku;
            document.getElementById('m-deskripsi').innerText = buku.deskripsi;
            
            // Re-bind tombol modal
            const buyBtn = document.getElementById('modal-buy-btn');
            buyBtn.onclick = (e) => { e.stopPropagation(); cartAction(element, false); };
            
            document.getElementById('modalDetail').classList.replace('hidden', 'flex');
            document.body.style.overflow = 'hidden'; 
        }

        function tutupDetailBuku() {
            document.getElementById('modalDetail').classList.replace('flex', 'hidden');
            document.body.style.overflow = 'auto'; 
        }

        function scrollToSection(id) {
            const element = document.getElementById('sec-' + id);
            if (element) window.scrollTo({ top: element.offsetTop - 120, behavior: 'smooth' });
        }
    </script>
</body>
</html>