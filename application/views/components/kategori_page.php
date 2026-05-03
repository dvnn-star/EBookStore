<?php
// Pastikan variabel $semua_buku tersedia dari Controller. Jika tidak ada, jadikan array kosong agar tidak error.
$semua_buku = isset($semua_buku) ? $semua_buku : [];

// Logika PHP untuk mengelompokkan data berdasarkan kategori agar sesuai dengan Section UI
$koleksi_buku = [];

// Judul referensi untuk masing-masing id kategori
$judul_referensi = [
    'fiksi'          => 'Koleksi Fiksi',
    'bisnis&ekonomi' => 'Koleksi Bisnis & Ekonomi',
    'sejarah'        => 'Koleksi Sejarah',
    'edukasi'        => 'Koleksi Edukasi'
];

foreach ($semua_buku as $item) {
    // Casting ke array untuk berjaga-jaga jika Model CI3 Anda menggunakan result() (object) alih-alih result_array()
    $buku = (array) $item; 
    
    // Pastikan key 'kategori' ada untuk menghindari error offset
    $kat = isset($buku['kategori']) ? $buku['kategori'] : 'lainnya';
    
    // Inisialisasi kategori jika belum ada di array terkelompok
    if (!isset($koleksi_buku[$kat])) {
        $koleksi_buku[$kat] = [
            'judul_section' => $judul_referensi[$kat] ?? 'Kategori Lainnya',
            'data' => []
        ];
    }
    
    // Masukkan buku ke kategorinya
    $koleksi_buku[$kat]['data'][] = $buku;
}
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA - Multi Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 
                        'ep-green': '#0c6b63', 
                        'ep-orange': '#f39c12' 
                    },
                    animation: { 
                        'fade-in': 'fadeIn 0.3s ease-out' 
                    },
                    keyframes: { 
                        fadeIn: { 
                            '0%': { opacity: 0, transform: 'scale(0.95)' }, 
                            '100%': { opacity: 1, transform: 'scale(1)' } 
                        } 
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans text-slate-900">

    <!-- Konten Utama -->
    <main class="container mx-auto px-4 py-12 flex flex-col md:flex-row gap-10 items-start">
        
        <!-- SIDEBAR (MENGGUNAKAN GAYA "FILTER KATEGORI" TERPOPULER DENGAN FIX STICKY) -->
        <aside class="w-full md:w-72 flex-shrink-0 sticky top-28 self-start z-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-th-large text-ep-green"></i> Filter Kategori
                </h3>
                
                <nav id="sidebar-nav" class="space-y-2">
                    <?php if(!empty($koleksi_buku)): ?>
                        <?php foreach(array_keys($koleksi_buku) as $key_kategori): ?>
                            <button 
                                id="btn-<?= $key_kategori ?>"
                                onclick="scrollToSection('<?= $key_kategori ?>')" 
                                class="nav-btn w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-300 group hover:bg-slate-50"
                            >
                                <div class="flex items-center gap-3">
                                    <!-- Dot Indikator -->
                                    <div class="dot w-1.5 h-1.5 rounded-full bg-slate-300 group-hover:bg-ep-green transition-colors"></div>
                                    <span class="text-sm font-medium text-slate-600 group-hover:text-ep-green capitalize">
                                        <?= str_replace('&', ' & ', $key_kategori) ?>
                                    </span>
                                </div>
                                <!-- Ikon Chevron -->
                                <i class="fas fa-chevron-right text-[10px] text-slate-300 opacity-0 group-hover:opacity-100 transition-all nav-icon"></i>
                            </button>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-xs text-red-500 px-4">Kategori kosong.</p>
                    <?php endif; ?>
                </nav>
            </div>
        </aside>

        <!-- Area Grid Produk -->
        <div class="flex-grow space-y-16 w-full">

            <?php if(empty($koleksi_buku)): ?>
                <div class="bg-white p-12 text-center rounded-3xl shadow-sm border border-slate-100">
                    <i class="fas fa-box-open text-4xl text-slate-300 mb-4"></i>
                    <h3 class="text-lg font-bold text-slate-500">Belum ada data buku.</h3>
                    <p class="text-sm text-slate-400 mt-2">Pastikan database Anda sudah terisi dan model berhasil mengambil data.</p>
                </div>
            <?php endif; ?>

            <?php foreach ($koleksi_buku as $id_kategori => $kategori): ?>
            <!-- Section Kategori -->
            <section id="sec-<?= $id_kategori ?>" class="scroll-mt-32">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
                    <div>
                        <h2 class="text-3xl font-black text-slate-800 tracking-tight flex items-center gap-3">
                            <?= $kategori['judul_section'] ?>
                        </h2>
                        <div class="h-1 w-full bg-ep-green mt-3 rounded-full"></div>
                    </div>
                    <span class="text-xs text-ep-green bg-ep-green/10 px-4 py-2 rounded-full font-bold uppercase tracking-wider">
                        <?= count($kategori['data']) ?> Buku
                    </span>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($kategori['data'] as $book): ?>
                    <!-- KARTU BUKU -->
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:border-ep-green/30 transition-all duration-500 flex flex-col h-full relative group cursor-pointer" 
                         onclick="bukaDetailBuku(this)" 
                         data-buku="<?= htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8') ?>">
                        
                        <!-- Gambar Buku -->
                        <div class="relative aspect-[3/4.5] mb-5 overflow-hidden rounded-xl bg-slate-100 shadow-inner flex items-center justify-center">
                            <img src="<?= htmlspecialchars($book['gambar'] ?? '') ?>" alt="<?= htmlspecialchars($book['judul_buku'] ?? '') ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 z-10" onerror="this.style.display='none'">
                            <span class="absolute text-slate-400 text-[10px] text-center px-2 z-0">No Image</span>
                        </div>

                        <!-- Info Buku -->
                        <div class="flex-grow flex flex-col">
                            <h3 class="font-bold text-slate-800 text-sm line-clamp-2 min-h-[2.5rem] leading-snug group-hover:text-ep-green transition-colors mb-1"><?= htmlspecialchars($book['judul_buku'] ?? 'Tanpa Judul') ?></h3>
                            <p class="text-xs text-slate-400 mb-2">By <?= htmlspecialchars($book['penulis'] ?? 'Unknown') ?></p>
                            
                            <!-- Rating -->
                            <div class="flex text-ep-orange text-[9px] gap-0.5 mb-3">
                                <?php 
                                    $rating = isset($book['rating']) ? (int)$book['rating'] : 0;
                                    for($i=1; $i<=5; $i++): 
                                ?>
                                    <i class="<?= $i <= $rating ? 'fas' : 'far' ?> fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            
                            <!-- Harga & Aksi -->
                            <div class="mt-auto pt-4 border-t border-slate-50">
                                <p class="font-black text-lg text-ep-green mb-3">Rp<?= number_format($book['harga'] ?? 0, 0, ',', '.') ?></p>
                                
                                <div class="flex gap-2">
                                    <button class="flex-grow bg-ep-orange text-white text-[11px] font-bold py-2.5 rounded-xl shadow-sm hover:bg-slate-800 transition-all active:scale-95" onclick="event.stopPropagation();">
                                        BELI
                                    </button>
                                    <button class="flex-none border border-slate-200 bg-white text-slate-400 w-10 rounded-xl hover:border-ep-green hover:text-ep-green transition-all shadow-sm active:scale-95 flex items-center justify-center" title="Tambah ke Keranjang" onclick="event.stopPropagation();">
                                        <i class="fas fa-cart-plus"></i>
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

    <!-- ================= MODAL DETAIL BUKU ================= -->
    <div id="modalDetail" class="fixed inset-0 bg-slate-900/60 z-[100] hidden items-center justify-center p-4 backdrop-blur-md">
        <!-- Kontainer Modal -->
        <div class="bg-white max-w-4xl w-full rounded-3xl overflow-hidden flex flex-col md:flex-row relative animate-fade-in shadow-2xl max-h-[95vh] md:max-h-[85vh] overflow-y-auto">
            
            <button onclick="tutupDetailBuku()" class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center bg-slate-100 text-slate-500 rounded-full hover:bg-red-50 hover:text-red-500 transition-all z-10">
                <i class="fas fa-times"></i>
            </button>

            <!-- Kolom Kiri -->
            <div class="w-full md:w-2/5 bg-slate-50 p-10 flex items-center justify-center border-r border-slate-100">
                <div class="w-full max-w-[220px] aspect-[2/3] bg-slate-200 rounded-xl shadow-2xl overflow-hidden rotate-2 hover:rotate-0 transition-transform duration-500">
                    <img id="m-gambar" src="" alt="Cover Buku" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="w-full md:w-3/5 p-8 md:p-10 flex flex-col">
                <span id="m-kategori" class="text-[10px] font-black text-ep-green uppercase tracking-[0.2em] mb-2">KATEGORI</span>
                <h2 id="m-judul" class="text-2xl md:text-3xl font-extrabold text-slate-900 leading-tight mb-2">Judul Buku</h2>
                <p class="text-slate-400 text-sm mb-6 font-medium">Karya <span id="m-penulis" class="text-slate-600">Penulis</span></p>

                <!-- Spesifikasi Teknis -->
                <div class="grid grid-cols-2 gap-4 text-sm bg-white p-4 rounded-2xl border border-slate-100 mb-6 shadow-sm">
                    <div>
                        <span class="block text-slate-400 text-[11px] uppercase tracking-wider mb-1">Penerbit</span>
                        <span id="m-penerbit" class="font-bold text-slate-700">Penerbit</span>
                    </div>
                    <div>
                        <span class="block text-slate-400 text-[11px] uppercase tracking-wider mb-1">Halaman</span>
                        <span id="m-halaman" class="font-bold text-slate-700">0</span>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-8 flex-grow">
                    <h3 class="font-bold text-slate-800 text-sm mb-3">Sinopsis</h3>
                    <p id="m-deskripsi" class="text-sm text-slate-500 leading-relaxed text-justify line-clamp-4 hover:line-clamp-none transition-all cursor-ns-resize">
                        Deskripsi...
                    </p>
                </div>

                <!-- Harga & Aksi -->
                <div class="mt-auto border-t border-slate-50 pt-6">
                    <p class="text-xs text-slate-400 mb-1 font-medium">Harga Resmi</p>
                    <p id="m-harga" class="text-3xl font-black text-ep-green mb-6">Rp 0</p>
                    
                    <div class="flex gap-3">
                        <button class="flex-grow bg-ep-orange text-white font-bold py-4 rounded-2xl shadow-lg shadow-ep-orange/20 hover:bg-slate-800 transition-all active:scale-95 flex items-center justify-center gap-2">
                            <i class="fas fa-shopping-bag"></i> BELI SEKARANG
                        </button>
                        <button class="px-6 border border-slate-200 text-slate-600 rounded-2xl hover:border-ep-green hover:text-ep-green transition-all shadow-sm font-bold flex items-center justify-center">
                            <i class="fas fa-cart-plus text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Logika -->
    <script>
        // Fungsi scroll smooth saat tombol diklik
        function scrollToSection(id) {
            const element = document.getElementById('sec-' + id);
            if (element) {
                const offset = 120; // Penyesuaian jarak dari atas layar (navbar)
                window.scrollTo({ top: element.offsetTop - offset, behavior: 'smooth' });
            }
        }

        // Logika Navigasi Active State (Merespons Scroll)
        function updateActiveMenu() {
            const sections = <?= json_encode(array_keys($koleksi_buku)) ?>;
            const navBtns = document.querySelectorAll('.nav-btn');
            let currentId = "";

            sections.forEach(sec => {
                const element = document.getElementById('sec-' + sec);
                if (element && window.pageYOffset >= (element.offsetTop - 180)) {
                    currentId = sec;
                }
            });

            // Set state aktif pertama jika pengguna berada di paling atas
            if(currentId === "" && sections.length > 0) {
                currentId = sections[0];
            }

            navBtns.forEach(btn => {
                const btnId = btn.id.replace('btn-', '');
                const dot = btn.querySelector('.dot');
                const text = btn.querySelector('span');
                const icon = btn.querySelector('.nav-icon');

                if (btnId === currentId) {
                    btn.classList.add('bg-ep-green/10', 'ring-1', 'ring-ep-green/20');
                    dot.classList.add('bg-ep-green', 'scale-150');
                    text.classList.add('text-ep-green', 'font-bold');
                    icon.classList.remove('opacity-0');
                    icon.classList.add('opacity-100', 'text-ep-green');
                } else {
                    btn.classList.remove('bg-ep-green/10', 'ring-1', 'ring-ep-green/20');
                    dot.classList.remove('bg-ep-green', 'scale-150');
                    text.classList.remove('text-ep-green', 'font-bold');
                    icon.classList.add('opacity-0');
                    icon.classList.remove('opacity-100', 'text-ep-green');
                }
            });
        }

        // Jalankan fungsi saat scroll dan saat halaman dimuat
        window.addEventListener('scroll', updateActiveMenu);
        window.addEventListener('load', updateActiveMenu);

        // ================= LOGIKA MODAL DETAIL BUKU =================
        const modal = document.getElementById('modalDetail');

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
        }

        function bukaDetailBuku(element) {
            const buku = JSON.parse(element.getAttribute('data-buku'));

            document.getElementById('m-gambar').src = buku.gambar || '';
            document.getElementById('m-judul').innerText = buku.judul_buku || 'Tanpa Judul';
            document.getElementById('m-kategori').innerText = buku.kategori || 'Lainnya';
            document.getElementById('m-penulis').innerText = buku.penulis || 'Unknown';
            document.getElementById('m-penerbit').innerText = buku.penerbit || '-';
            document.getElementById('m-halaman').innerText = (buku.halaman || '0') + ' Hlm';
            document.getElementById('m-deskripsi').innerText = buku.deskripsi || 'Tidak ada deskripsi.';
            document.getElementById('m-harga').innerText = formatRupiah(buku.harga || 0);

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden'; 
        }

        function tutupDetailBuku() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto'; 
        }

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                tutupDetailBuku();
            }
        });
    </script>
</body>
</html>