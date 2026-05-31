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
<body class="bg-slate-50 font-sans text-slate-900 antialiased">

<?php
// Data buku simulasi internal untuk memastikan kompatibilitas rendering parser
$semua_buku = isset($semua_buku) ? $semua_buku : [
    ['id' => 1, 'judul_buku' => 'Rich Dad Poor Dad', 'penulis' => 'Robert T. Kiyosaki', 'harga' => 95000, 'rating' => 5, 'kategori' => 'bisnis&ekonomi', 'gambar' => 'https://placehold.co/400x600?text=Rich+Dad'],
    ['id' => 2, 'judul_buku' => 'The Psychology of Money', 'penulis' => 'Morgan Housel', 'harga' => 85000, 'rating' => 4, 'kategori' => 'bisnis&ekonomi', 'gambar' => 'https://placehold.co/400x600?text=Psychology'],
    ['id' => 3, 'judul_buku' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'harga' => 89000, 'rating' => 5, 'kategori' => 'fiksi', 'gambar' => 'https://placehold.co/400x600?text=Laskar+Pelangi']
];

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

    <main class="container mx-auto px-4 py-8 md:py-12 flex flex-col md:flex-row gap-6 md:gap-10 items-start">
        
        <aside class="w-full md:w-64 flex-shrink-0 sticky top-0 md:top-28 z-30 md:max-h-[calc(100vh-9rem)] bg-slate-50 md:bg-transparent pt-3 pb-4 md:py-0 -mx-4 px-4 md:mx-0 md:px-0">
            <div class="bg-white p-4 md:p-5 rounded-xl md:rounded-2xl shadow-sm border border-slate-200/80">
                <h3 class="hidden md:flex font-bold text-slate-800 mb-4 items-center gap-2 text-sm tracking-wide">
                    <i class="fas fa-tags text-ep-green"></i> Kategori Buku
                </h3>
                
                <nav id="sidebar-nav" class="flex flex-row md:flex-col gap-2 overflow-x-auto md:overflow-x-visible md:overflow-y-auto overscroll-contain scrollbar-none pb-1 md:pb-0">
                    <?php if (!empty($koleksi_buku)): ?>
                        <?php foreach ($koleksi_buku as $key => $section): ?>
                            <?php if (!empty($section['data'])): ?>
                                <button type="button" 
                                        id="btn-<?= $key ?>" 
                                        onclick="scrollToSection('<?= $key ?>')" 
                                        class="nav-btn flex-shrink-0 flex items-center justify-between gap-3 px-3.5 py-2 md:py-2.5 rounded-lg md:rounded-xl transition-all duration-300 group hover:bg-slate-50 border border-slate-100 md:border-0 md:w-full">
                                    <div class="flex items-center gap-2.5">
                                        <div class="dot w-1.5 h-1.5 rounded-full bg-slate-300 group-hover:bg-ep-green transition-colors"></div>
                                        <span class="text-xs md:text-sm font-semibold text-slate-600 group-hover:text-ep-green capitalize whitespace-nowrap">
                                            <?= str_replace(['_', '&'], [' ', ' & '], $key) ?>
                                        </span>
                                    </div>
                                    <span class="text-[9px] bg-slate-100 px-1.5 py-0.5 rounded text-slate-400 group-hover:bg-ep-green/10 group-hover:text-ep-green transition-colors font-bold">
                                        <?= count($section['data']) ?>
                                    </span>
                                </button>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </nav>
            </div>
        </aside>

        <div class="flex-grow space-y-12 md:space-y-16 w-full">
            <?php foreach ($koleksi_buku as $id_kategori => $kategori): ?>
            <section id="sec-<?= $id_kategori ?>" class="scroll-mt-24 md:scroll-mt-32">
                <div class="mb-6 md:mb-8">
                    <h2 class="text-xl md:text-2xl font-black text-slate-800 tracking-tight"><?= $kategori['judul_section'] ?></h2>
                    <div class="h-1 w-10 bg-ep-green mt-2 rounded-full"></div>
                </div>
                
                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-5">
                    <?php foreach ($kategori['data'] as $book): ?>
                    <div class="bg-white p-3 md:p-3.5 rounded-xl border border-slate-100 shadow-sm hover:shadow-lg hover:border-ep-green/20 transition-all duration-500 flex flex-col h-full relative group cursor-pointer" onclick="bukaDetailBuku(this)" data-buku="<?= htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8') ?>">
                        
                        <div class="relative aspect-[3/4] mb-3 overflow-hidden rounded-lg bg-slate-100 shadow-inner flex justify-center items-center">
                            <img src="<?= htmlspecialchars($book['gambar'] ?? '') ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?= htmlspecialchars($book['judul_buku']) ?>">
                        </div>
                        
                        <div class="flex-grow flex flex-col">
                            <h3 class="font-bold text-slate-800 text-xs line-clamp-2 min-h-[2rem] leading-snug"><?= htmlspecialchars($book['judul_buku']) ?></h3>
                            <p class="text-[11px] text-slate-400 mb-3">By <?= htmlspecialchars($book['penulis']) ?></p>
                            
                            <div class="mt-auto pt-3 border-t border-slate-50">
                                <p class="font-extrabold text-sm text-ep-green mb-3">Rp<?= number_format($book['harga'], 0, ',', '.') ?></p>
                                <div class="flex gap-1.5">
                                    <button class="flex-grow bg-ep-orange text-white text-[10px] font-bold py-2 rounded-lg shadow-md shadow-ep-orange/10 hover:bg-slate-800 transition-all active:scale-95 tracking-wide" onclick="event.stopPropagation(); cartAction(this, true);">
                                        BELI
                                    </button>
                                    <button class="flex-none border border-slate-200 bg-white text-slate-400 w-8 h-8 rounded-lg hover:border-ep-green hover:text-ep-green transition-all shadow-sm active:scale-95 flex items-center justify-center" onclick="event.stopPropagation(); cartAction(this, false);">
                                        <i class="fas fa-cart-plus text-xs"></i>
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

    <div id="toast-container" class="fixed bottom-6 right-6 z-[110] flex flex-col gap-3 pointer-events-none"></div>

    <div id="modalDetail" class="fixed inset-0 bg-slate-900/50 z-[100] hidden items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white max-w-xl w-full rounded-2xl overflow-hidden flex flex-col sm:flex-row relative animate-fade-in shadow-xl">
            <button onclick="tutupDetailBuku()" class="absolute top-3 right-3 w-8 h-8 flex items-center justify-center bg-slate-100 text-slate-500 rounded-full hover:bg-red-50 hover:text-red-500 transition-all z-10 text-xs">
                <i class="fas fa-times"></i>
            </button>
            <div class="w-full sm:w-5/12 bg-slate-50 p-6 flex items-center justify-center">
                <img id="m-gambar" src="" class="h-56 object-cover shadow-xl rounded-lg" alt="Detail Gambar">
            </div>
            <div class="p-6 sm:w-7/12 flex flex-col">
                <h2 id="m-judul" class="text-lg font-bold text-slate-900 leading-tight mb-2"></h2>
                <p id="m-deskripsi" class="text-slate-600 text-xs leading-relaxed mb-5 line-clamp-3"></p>
                <div class="mt-auto">
                    <button id="modal-buy-btn" class="w-full bg-ep-orange text-white py-2.5 rounded-xl font-bold shadow-md shadow-ep-orange/10 hover:bg-slate-800 transition-all flex items-center justify-center gap-1.5 text-xs tracking-wide">
                        <i class="fas fa-shopping-cart"></i> TAMBAH KE KERANJANG
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const CURRENT_USER = "<?= htmlspecialchars($this->session->userdata('username') ?? 'guest'); ?>";
        const LOGIN_URL = "<?= base_url('login'); ?>";
        const STORAGE_KEY = `cart_storage_${CURRENT_USER}`;

        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toastId = 'toast-' + Date.now();
            const colorClass = type === 'success' ? 'border-ep-green text-ep-green' : 'border-ep-orange text-ep-orange';
            const iconClass = type === 'success' ? 'fa-check' : 'fa-info-circle';
            
            const toastHTML = `
                <div id="${toastId}" class="pointer-events-auto flex items-center gap-3 bg-white border-l-4 ${colorClass} p-3.5 pr-8 rounded-xl shadow-lg relative overflow-hidden min-w-[280px]">
                    <div class="flex-none w-8 h-8 bg-slate-50 rounded-full flex items-center justify-center text-xs">
                        <i class="fas ${iconClass}"></i>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-wider mb-0.5">E-Pustaka System</p>
                        <p class="text-xs font-bold text-slate-700">${message}</p>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', toastHTML);
            const toastElement = document.getElementById(toastId);
            setTimeout(() => {
                toastElement.classList.add('opacity-0');
                setTimeout(() => toastElement.remove(), 300);
            }, 2500);
        }

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
                if (!isRedirect) showToast(`${dataBuku.judul_buku} berhasil ditambahkan!`);
            } else {
                if (!isRedirect) showToast(`Buku ini sudah ada di keranjang.`, 'info');
            }

            if (isRedirect) setTimeout(() => window.location.href = "<?= base_url('keranjang'); ?>", 100);
        }

        function bukaDetailBuku(element) {
            const buku = JSON.parse(element.getAttribute('data-buku'));
            document.getElementById('m-gambar').src = buku.gambar;
            document.getElementById('m-judul').innerText = buku.judul_buku;
            document.getElementById('m-deskripsi').innerText = buku.deskripsi || 'Tidak ada deskripsi tersedia.';
            
            const buyBtn = document.getElementById('modal-buy-btn');
            buyBtn.onclick = (e) => { 
                e.stopPropagation(); 
                cartAction(element, false); 
            };

            document.getElementById('modalDetail').classList.replace('hidden', 'flex');
            document.body.style.overflow = 'hidden'; 
        }

        function tutupDetailBuku() {
            document.getElementById('modalDetail').classList.replace('flex', 'hidden');
            document.body.style.overflow = 'auto'; 
        }

        function scrollToSection(id) {
            const element = document.getElementById('sec-' + id);
            // Penyesuaian offset scroll: 80px di mobile (navbar/sidebar lebih tipis) dan 120px di desktop
            const offset = window.innerWidth < 768 ? 80 : 120;
            if (element) window.scrollTo({ top: element.offsetTop - offset, behavior: 'smooth' });
        }

        function updateActiveMenu() {
            const sections = document.querySelectorAll('section[id^="sec-"]');
            const navBtns = document.querySelectorAll('.nav-btn');
            let currentId = "";

            sections.forEach(sec => {
                if (window.pageYOffset >= (sec.offsetTop - 160)) {
                    currentId = sec.getAttribute('id').replace('sec-', '');
                }
            });

            navBtns.forEach(btn => {
                const btnId = btn.id.replace('btn-', '');
                const dot = btn.querySelector('.dot');
                const text = btn.querySelector('span');

                if (btnId === currentId) {
                    btn.classList.add('bg-ep-green/10', 'ring-1', 'ring-ep-green/20');
                    dot.classList.add('bg-ep-green', 'scale-150');
                    text.classList.add('text-ep-green', 'font-bold');
                    // Menggulirkan menu aktif secara horizontal pada tampilan mobile agar tetap terlihat (Auto-scroll Spy)
                    if (window.innerWidth < 768) {
                        btn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    }
                } else {
                    btn.classList.remove('bg-ep-green/10', 'ring-1', 'ring-ep-green/20');
                    dot.classList.remove('bg-ep-green', 'scale-150');
                    text.classList.remove('text-ep-green', 'font-bold');
                }
            });
        }

        window.addEventListener('scroll', updateActiveMenu);
        window.addEventListener('load', updateActiveMenu);
    </script>
</body>
</html>