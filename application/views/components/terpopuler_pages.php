<?php
// 1. DATA BUATAN (DUMMY DATA)
$semua_buku = [
    ['id' => 1, 'judul_buku' => 'Rich Dad Poor Dad', 'penulis' => 'Robert T. Kiyosaki', 'penerbit' => 'Gramedia', 'harga' => 95000, 'kategori' => 'bisnis_ekonomi', 'rating' => 5, 'is_populer' => 1, 'gambar' => 'https://images.tokopedia.net/img/cache/700/Vqb7pG/2021/4/27/7f7e9b1d-930b-4f7d-9a9c-097d519b5d4e.jpg', 'deskripsi' => 'Buku ini membahas pentingnya kecerdasan finansial.', 'halaman' => 244],
    ['id' => 3, 'judul_buku' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'penerbit' => 'Bentang Pustaka', 'harga' => 89000, 'kategori' => 'fiksi', 'rating' => 5, 'is_populer' => 1, 'gambar' => 'https://upload.wikimedia.org/wikipedia/id/8/8e/Laskar_pelangi_sampul.jpg', 'deskripsi' => 'Kisah perjuangan anak-anak Belitong mengejar mimpi.', 'halaman' => 529],
    ['id' => 5, 'judul_buku' => 'Sapiens', 'penulis' => 'Yuval Noah Harari', 'penerbit' => 'KPG', 'harga' => 135000, 'kategori' => 'sejarah', 'rating' => 4, 'is_populer' => 1, 'gambar' => 'https://images.tokopedia.net/img/cache/700/Vqb7pG/2021/1/14/0f1d0b5d-9b5d-4f1d-9b5d-0f1d0b5d9b5d.jpg', 'deskripsi' => 'Sejarah singkat umat manusia.', 'halaman' => 500],
    ['id' => 7, 'judul_buku' => 'Atomic Habits', 'penulis' => 'James Clear', 'penerbit' => 'Penguin', 'harga' => 108000, 'kategori' => 'edukasi', 'rating' => 5, 'is_populer' => 1, 'gambar' => 'https://m.media-amazon.com/images/I/91bYsX41DVL.jpg', 'deskripsi' => 'Cara mudah membangun kebiasaan baik.', 'halaman' => 320],
];

$judul_referensi = [
    'terpopuler'     => 'Buku Terpopuler',
    'fiksi'          => 'Populer Fiksi',
    'bisnis_ekonomi' => 'Populer Bisnis & Ekonomi',
    'sejarah'        => 'Populer Sejarah',
    'edukasi'        => 'Populer Edukasi'
];

$koleksi_buku = [];
foreach ($judul_referensi as $key => $judul) { $koleksi_buku[$key] = ['judul' => $judul, 'data' => []]; }

foreach ($semua_buku as $buku) {
    if ($buku['is_populer'] == 1) $koleksi_buku['terpopuler']['data'][] = $buku;
    $kat = $buku['kategori'];
    if (isset($koleksi_buku[$kat])) $koleksi_buku[$kat]['data'][] = $buku;
}
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA - Katalog Tailwind</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 'ep-green': '#0c6b63', 'ep-orange': '#f39c12' },
                    animation: { 'fade-in': 'fadeIn 0.3s ease-out' },
                    keyframes: { fadeIn: { '0%': { opacity: 0, transform: 'scale(0.95)' }, '100%': { opacity: 1, transform: 'scale(1)' } } }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans text-slate-900">

    <div class="container mx-auto px-4 py-12 flex flex-col md:flex-row gap-10">
        
        <!-- SIDEBAR (TAB KIRI) -->
        <aside class="w-full md:w-72 flex-shrink-0">
            <div class="sticky top-28 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-th-large text-ep-green"></i> Filter Kategori
                </h3>
                <nav id="sidebar-nav" class="space-y-2">
                    <?php foreach($koleksi_buku as $key => $section): ?>
                        <?php if(!empty($section['data'])): ?>
                        <button 
                            id="btn-<?= $key ?>"
                            onclick="scrollToSection('<?= $key ?>')" 
                            class="nav-btn w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-300 group hover:bg-slate-50"
                        >
                            <div class="flex items-center gap-3">
                                <!-- Dot Indikator -->
                                <div class="dot w-1.5 h-1.5 rounded-full bg-slate-300 group-hover:bg-ep-green transition-colors"></div>
                                <span class="text-sm font-medium text-slate-600 group-hover:text-ep-green capitalize">
                                    <?= str_replace('_', ' ', $key) ?>
                                </span>
                            </div>
                            <i class="fas fa-chevron-right text-[10px] text-slate-300 opacity-0 group-hover:opacity-100 transition-all"></i>
                        </button>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </nav>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-grow space-y-16">
            <?php foreach ($koleksi_buku as $id => $section): ?>
                <?php if(!empty($section['data'])): ?>
                <section id="sec-<?= $id ?>" class="scroll-mt-32">
                    <div class="flex items-end justify-between mb-8">
                        <div>
                            <h2 class="text-3xl font-black text-slate-800 tracking-tight"><?= $section['judul'] ?></h2>
                            <div class="h-1 w-full bg-ep-green mt-2 rounded-full"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php foreach ($section['data'] as $buku): ?>
                        <div onclick="bukaModal(<?= htmlspecialchars(json_encode($buku)) ?>)" 
                             class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:border-ep-green/30 transition-all duration-500 cursor-pointer group">
                            
                            <div class="relative aspect-[3/4.5] mb-5 overflow-hidden rounded-xl bg-slate-100 shadow-inner">
                                <img src="<?= $buku['gambar'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <?php if($id == 'terpopuler'): ?>
                                    <div class="absolute top-3 left-3 bg-ep-orange text-white text-[10px] font-black px-2.5 py-1 rounded-lg shadow-lg uppercase tracking-wider">Hot Item</div>
                                <?php endif; ?>
                            </div>

                            <h4 class="font-bold text-slate-800 text-sm line-clamp-2 min-h-[2.5rem] leading-snug group-hover:text-ep-green transition-colors"><?= $buku['judul_buku'] ?></h4>
                            <p class="text-xs text-slate-400 mt-1 mb-4"><?= $buku['penulis'] ?></p>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                <span class="font-black text-ep-green">Rp<?= number_format($buku['harga'], 0, ',', '.') ?></span>
                                <div class="flex text-ep-orange text-[9px] gap-0.5">
                                    <?php for($i=1; $i<=5; $i++) echo '<i class="'.($i <= $buku['rating'] ? 'fas' : 'far').' fa-star"></i>'; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- MODAL DETAIL -->
    <<!-- MODAL DETAIL -->
        <div id="modal" class="fixed inset-0 bg-slate-900/60 z-[100] hidden items-center justify-center p-4 backdrop-blur-md">
            <div class="bg-white max-w-2xl w-full rounded-3xl overflow-hidden flex flex-col md:flex-row relative animate-fade-in shadow-2xl">
                <button onclick="tutupModal()" class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center bg-slate-100 text-slate-500 rounded-full hover:bg-red-50 hover:text-red-500 transition-all z-10">
                    <i class="fas fa-times"></i>
                </button>
                
                <div class="w-full md:w-1/2 bg-slate-50 p-10 flex items-center justify-center">
                    <img id="md-img" src="" class="h-72 object-cover shadow-2xl rounded-xl rotate-2 hover:rotate-0 transition-transform duration-500">
                </div>

                <div class="p-10 md:w-1/2 flex flex-col">
                    <span class="text-[10px] font-black text-ep-green uppercase tracking-[0.2em] mb-2">Detail Produk</span>
                    <h2 id="md-title" class="text-2xl font-bold text-slate-900 leading-tight mb-2"></h2>
                    <p id="md-author" class="text-slate-400 text-sm mb-4 font-medium"></p>
                    
                    <!-- Tambahkan Elemen Harga di Sini -->
                    <div class="mb-6">
                        <span class="text-gray-400 text-xs block">Harga Produk:</span>
                        <span id="md-price" class="text-2xl font-black text-ep-green"></span>
                    </div>

                    <p id="md-desc" class="text-slate-600 text-sm leading-relaxed mb-8 line-clamp-4"></p>
                    
                    <div class="mt-auto space-y-3">
                        <!-- Ganti teks menjadi BELI SEKARANG -->
                        <button class="w-full bg-ep-orange text-white py-4 rounded-2xl font-bold shadow-lg shadow-ep-orange/20 hover:bg-slate-800 transition-all active:scale-95 flex items-center justify-center gap-2">
                            <i class="fas fa-shopping-cart"></i> BELI SEKARANG
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <script>
        function scrollToSection(id) {
            const element = document.getElementById('sec-' + id);
            const offset = 120; 
            window.scrollTo({ top: element.offsetTop - offset, behavior: 'smooth' });
        }

        function updateActiveMenu() {
            const sections = document.querySelectorAll('section[id^="sec-"]');
            const navBtns = document.querySelectorAll('.nav-btn');
            let currentId = "";

            sections.forEach(sec => {
                if (window.pageYOffset >= (sec.offsetTop - 150)) {
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
                } else {
                    btn.classList.remove('bg-ep-green/10', 'ring-1', 'ring-ep-green/20');
                    dot.classList.remove('bg-ep-green', 'scale-150');
                    text.classList.remove('text-ep-green', 'font-bold');
                }
            });
        }

        window.addEventListener('scroll', updateActiveMenu);
        window.addEventListener('load', updateActiveMenu);

        function bukaModal(buku) {
            document.getElementById('md-img').src = buku.gambar;
            document.getElementById('md-title').innerText = buku.judul_buku;
            document.getElementById('md-author').innerText = 'Karya ' + buku.penulis;
            document.getElementById('md-desc').innerText = buku.deskripsi;
            document.getElementById('modal').classList.replace('hidden', 'flex');
            document.body.style.overflow = 'hidden';
        }

        function tutupModal() {
            document.getElementById('modal').classList.replace('flex', 'hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</body>
</html>