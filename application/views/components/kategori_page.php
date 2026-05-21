<?php
/**
 * ARCHITECTURAL DESIGN: MULTI-DIMENSIONAL DATA GROUPING
 * Strategi memetakan data relasional linear (flat array dari database) menjadi 
 * struktur data pohon (tree/nested associative array) di layer presentasi.
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
    // Type-casting dari StdClass Object ke Array untuk menjamin konsistensi akses ke data key.
    $buku = (array) $item; 
    $kat = $buku['kategori'] ?? 'lainnya';
    
    // Defensive Programming: Menginisialisasi skema sub-array jika indeks kategori belum terbentuk.
    if (!isset($koleksi_buku[$kat])) {
        $koleksi_buku[$kat] = [
            'judul_section' => $judul_referensi[$kat] ?? 'Kategori Lainnya',
            'data' => []
        ];
    }
    // Push baris data ke dalam bucket memori kategori yang sesuai (Kombinasi O(N) Time Complexity).
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
        // Deklarasi ekstensi konfigurasi Tailwind JIT (Just-In-Time) Compiler untuk kustomisasi token desain global.
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
        
        <!-- SIDEBAR: LAYOUT STICKY & ACCESSIBILITY NAV -->
        <!-- Penggunaan max-h dan overflow-y-auto memastikan kontainer navigasi mandiri dari scroll viewport utama -->
        <aside class="w-full md:w-72 flex-shrink-0 self-start sticky top-28 z-20 max-h-[calc(100vh-7rem)] overflow-y-auto overscroll-contain rounded-2xl">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-tags text-ep-green"></i> Kategori Buku
                </h3>
                <nav id="sidebar-nav" class="space-y-2">
                    <?php if (!empty($koleksi_buku)): ?>
                        <?php foreach ($koleksi_buku as $key => $section): ?>
                            <?php if (!empty($section['data'])): ?>
                                <button type="button" id="btn-<?= $key ?>" onclick="scrollToSection('<?= $key ?>')" class="nav-btn w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-300 group hover:bg-slate-50">
                                    <div class="flex items-center gap-3">
                                        <div class="dot w-1.5 h-1.5 rounded-full bg-slate-300 group-hover:bg-ep-green transition-colors"></div>
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-ep-green capitalize">
                                            <?= str_replace(['_', '&'], [' ', ' & '], $key) ?>
                                        </span>
                                    </div>
                                    <span class="text-[10px] bg-slate-100 px-2 py-0.5 rounded-md text-slate-400 group-hover:bg-ep-green/10 group-hover:text-ep-green transition-colors">
                                        <?= count($section['data']) ?>
                                    </span>
                                </button>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </nav>
            </div>
        </aside>

        <!-- AREA GRID PRODUK: RENDER DATA COMPONENT -->
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
                    
                    <!-- DOM DATA BINDING: Menyimpan payload objek JSON mentah ke dalam DOM atribut untuk parsing instan di sisi klien -->
                    <!-- Kelas 'flex flex-col h-full' menjamin footer tindakan kartu selalu presisi sejajar di baris bawah -->
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:border-ep-green/30 transition-all duration-500 flex flex-col h-full relative group cursor-pointer" onclick="bukaDetailBuku(this)" data-buku="<?= htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8') ?>">
                        
                        <!-- ASPRATIO BLOCK: Mengunci dimensi layout gambar via aspect ratio untuk mencegah layout shifting (CLS) saat rendering -->
                        <div class="relative aspect-[3/4.5] mb-5 overflow-hidden rounded-xl bg-slate-100 shadow-inner">
                            <img src="<?= htmlspecialchars($book['gambar'] ?? '') ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 z-10" alt="<?= htmlspecialchars($book['judul_buku']) ?>">
                        </div>
                        <div class="flex-grow flex flex-col">
                            <h3 class="font-bold text-slate-800 text-sm line-clamp-2 min-h-[2.5rem] leading-snug"><?= htmlspecialchars($book['judul_buku']) ?></h3>
                            <p class="text-xs text-slate-400 mb-4">By <?= htmlspecialchars($book['penulis']) ?></p>
                            <div class="mt-auto pt-4 border-t border-slate-50">
                                <p class="font-black text-lg text-ep-green mb-4">Rp<?= number_format($book['harga'], 0, ',', '.') ?></p>
                                <div class="flex gap-2">
                                    
                                    <!-- INTERACTION HANDLING: Injeksi event.stopPropagation() mutlak diperlukan di sini -->
                                    <!-- Ini memutus siklus Event Bubbling agar trigger fungsi klik anak tidak merambat ke listener klik div induk (bukaDetailBuku) -->
                                    <button class="flex-grow bg-ep-orange text-white text-[11px] font-bold py-3 rounded-xl shadow-lg shadow-ep-orange/20 hover:bg-slate-800 transition-all active:scale-95" onclick="event.stopPropagation(); cartAction(this, true);">
                                        BELI
                                    </button>
                                    <button class="flex-none border border-slate-200 bg-white text-slate-400 w-12 rounded-xl hover:border-ep-green hover:text-ep-green transition-all shadow-sm active:scale-95 flex items-center justify-center" onclick="event.stopPropagation(); cartAction(this, false);">
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

    <!-- TOAST INJECTION CONTAINER LAYER -->
    <div id="toast-container" class="fixed bottom-10 right-10 z-[110] flex flex-col gap-4 pointer-events-none"></div>

    <!-- MODAL VIRTUAL CONTAINER VIEW -->
    <div id="modalDetail" class="fixed inset-0 bg-slate-900/60 z-[100] hidden items-center justify-center p-4 backdrop-blur-md">
        <div class="bg-white max-w-2xl w-full rounded-3xl overflow-hidden flex flex-col md:flex-row relative animate-fade-in shadow-2xl">
            <button onclick="tutupDetailBuku()" class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center bg-slate-100 text-slate-500 rounded-full hover:bg-red-50 hover:text-red-500 transition-all z-10">
                <i class="fas fa-times"></i>
            </button>
            <div class="w-full md:w-1/2 bg-slate-50 p-10 flex items-center justify-center">
                <img id="m-gambar" src="" class="h-72 object-cover shadow-2xl rounded-xl" alt="Detail Gambar">
            </div>
            <div class="p-10 md:w-1/2 flex flex-col">
                <h2 id="m-judul" class="text-2xl font-bold text-slate-900 leading-tight mb-2"></h2>
                <p id="m-deskripsi" class="text-slate-600 text-sm leading-relaxed mb-8 line-clamp-4"></p>
                <div class="mt-auto">
                    <!-- Tombol modal ini akan di-bind secara runtime via closure JavaScript ketika modal diinisiasi -->
                    <button id="modal-buy-btn" class="w-full bg-ep-orange text-white py-4 rounded-2xl font-bold shadow-lg shadow-ep-orange/20 hover:bg-slate-800 transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-shopping-cart"></i> TAMBAH KE KERANJANG
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        /**
                  * APPLICATION GLOBAL STATE & PERSISTENCE CONFIGURATION
                  * Mengisolasi storage key berdasarkan entitas user untuk menghindari kebocoran data antar sesi (Multi-tenant State Isolation)
                  */
        const CURRENT_USER = "<?= htmlspecialchars($this->session->userdata('username') ?? 'guest'); ?>";
        const LOGIN_URL = "<?= base_url('login'); ?>";
        const STORAGE_KEY = `cart_storage_${CURRENT_USER}`;

        /**
         * ENGINE SYSTEM: TOAST NOTIFICATION RUNTIME
         * Mengelola komponen transient UI secara asinkronus menggunakan penanganan siklus hidup DOM berbasis micro-timer
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
            
            // BROWSER REPAINT LIFECYCLE SYNC:
            // Menggunakan penundaan minimal 10ms untuk mematangkan status render elemen di DOM, 
            // sehingga transisi CSS lebar progress bar dari 100% ke 0% dapat dieksekusi secara mulus oleh GPU peramban.
            setTimeout(() => {
                const pb = document.getElementById(`progress-${toastId}`);
                if(pb) pb.style.width = '0%';
            }, 10);

            // AUTO-DISPOSE PATTERN: Melakukan unmount komponen secara otomatis setelah siklus waktu selesai (3000ms + 500ms Animasi Out)
            setTimeout(() => {
                toastElement.classList.add('opacity-0', 'translate-x-10');
                setTimeout(() => toastElement.remove(), 500);
            }, 3000);
        }

        /**
         * TRANSACTION LOGIC LAYER: CART ACTION & STATE RECONCILIATION
         * @param {HTMLElement} buttonElement - Node referensi pemicu aksi belanja
         * @param {Boolean} isRedirect - Flag kontrol disposisi visual dan alur navigasi aplikasi
         */
        function cartAction(buttonElement, isRedirect) {
            // Guard Clause Pattern: Terminasi eksekusi dini jika status verifikasi autentikasi user adalah Guest anonymous
            if (CURRENT_USER === 'guest') {
                window.location.href = LOGIN_URL;
                return; 
            }

            // Membaca manifest objek serialisasi JSON langsung dari representasi node kartu terdekat di DOM pohon
            const card = buttonElement.closest('[data-buku]');
            const dataBuku = JSON.parse(card.getAttribute('data-buku'));
            
            // Sinkronisasi Sesi Lokal Penyimpanan (Local Storage State Engine)
            let currentCart = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
            const isExist = currentCart.find(item => item.id === dataBuku.id);

            if (!isExist) {
                currentCart.push(dataBuku);
                localStorage.setItem(STORAGE_KEY, JSON.stringify(currentCart));
                
                // SIDE-EFFECT SUPPRESSION CONFIGURATION: 
                // Jika isRedirect true (Tombol Beli), pengiriman umpan balik visual (Toast) disupresi secara total 
                // karena browser akan memicu re-navigasi lokasi global, membuat kemunculan toast menjadi redundan.
                if (!isRedirect) {
                    showToast(`${dataBuku.judul_buku} berhasil ditambahkan!`);
                }
            } else {
                if (!isRedirect) {
                    showToast(`Buku ini sudah ada di keranjang.`, 'info');
                }
            }

            // Debouncing navigasi eksekusi dengan memberikan jeda makro-task 100ms untuk memastikan penulisan storage selesai sepenuhnya
            if (isRedirect) setTimeout(() => window.location.href = "<?= base_url('keranjang'); ?>", 100);
        }

        /**
         * MODAL PRESENTER LAYER: RUNTIME DATA INTERPOLATION
         * Mengimplementasikan pola runtime closure injection untuk mengaitkan event handler dinamis pada runtime modal view scope
         */
        function bukaDetailBuku(element) {
            const buku = JSON.parse(element.getAttribute('data-buku'));
            
            // Melakukan interpolasi string secara langsung pada textContent DOM node aman untuk mencegah kerentanan XSS Injection
            document.getElementById('m-gambar').src = buku.gambar;
            document.getElementById('m-judul').innerText = buku.judul_buku;
            document.getElementById('m-deskripsi').innerText = buku.deskripsi;
            
            // DYNAMIC CLOSURE BINDING: 
            // Mengambil instance kontrol elemen di dalam modal dan menetapkan handler fungsi yang secara spesifik mengikat 
            // referensi element kartu asal, menjamin data kontekstual yang dieksekusi di dalam modal selalu tepat sasaran.
            const buyBtn = document.getElementById('modal-buy-btn');
            buyBtn.onclick = (e) => { 
                e.stopPropagation(); 
                cartAction(element, false); 
            };

            // Melakukan manipulasi class utilitas Tailwind untuk mengubah penataan konteks stacking modal layaknya flex view
            document.getElementById('modalDetail').classList.replace('hidden', 'flex');
            // Menghunci scrollbar container utama halaman (body element wrapper) demi mempertahankan fokus visual user
            document.body.style.overflow = 'hidden'; 
        }

        function tutupDetailBuku() {
            document.getElementById('modalDetail').classList.replace('flex', 'hidden');
            document.body.style.overflow = 'auto'; // Mengembalikan kebebasan scroll koordinat halaman utama
        }

        function scrollToSection(id) {
            const element = document.getElementById('sec-' + id);
            // Melakukan pergeseran posisi gulir dengan kompensasi offset tinggi (120px) demi mengantisipasi ketertutupan layout sticky header
            if (element) window.scrollTo({ top: element.offsetTop - 120, behavior: 'smooth' });
        }

        /**
         * PERFORMANCE SYSTEM: VIEWPORT SCROLL-SPY ENGINE
         * Melakukan kalkulasi irisan elemen visual kontainer koordinat dengan garis ambang batas atas viewport peramban
         */
        function updateActiveMenu() {
            const sections = document.querySelectorAll('section[id^="sec-"]');
            const navBtns = document.querySelectorAll('.nav-btn');
            let currentId = "";

            sections.forEach(sec => {
                // Menetapkan toleransi jarak threshold 150px dari batas atas window untuk mendeteksi section yang sedang dominan dilihat
                if (window.pageYOffset >= (sec.offsetTop - 150)) {
                    currentId = sec.getAttribute('id').replace('sec-', '');
                }
            });

            // Sinkronisasi kelas token CSS dinamis pada struktur manifest tombol navigasi yang berkesesuaian
            navBtns.forEach(btn => {
                const btnId = btn.id.replace('btn-', '');
                const dot = btn.querySelector('.dot');
                const text = btn.querySelector('span');

                if (btnId === currentId) {
                    btn.classList.add('bg-ep-green/10', 'ring-1', 'ring-ep-green/20');
                    dot.classList.add('bg-ep-green', 'scale-150');
                    text.classList.add('text-ep-green', 'font-bold');
                } else {
                    btn.classList.remove('bg-ep-green/10', 'ring-1', 'ring-ep-green/20');
                    dot.classList.remove('bg-ep-green', 'scale-150');
                    text.classList.remove('text-ep-green', 'font-bold');
                }
            });
        }

        // Mendaftarkan fungsi listener pemantau aktivitas koordinat scroll dan pemuatan siklus inisial halaman
        window.addEventListener('scroll', updateActiveMenu);
        window.addEventListener('load', updateActiveMenu);
    </script>
</body>
</html>