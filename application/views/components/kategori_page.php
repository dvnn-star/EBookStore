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
                        'epustaka-green': '#0c6b63',
                        'epustaka-orange': '#f39c12',
                        'epustaka-bg': '#f9fafb'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-epustaka-bg font-sans text-gray-800">

    <!-- Konten Utama -->
    <main class="container mx-auto px-4 md:px-12 py-8 flex flex-col md:flex-row gap-8 items-start">
        
        <!-- Sidebar Filter Sticky -->
        <aside class="w-full md:w-1/4 bg-white p-6 rounded-lg shadow-sm sticky top-24">
            <h2 class="text-lg font-bold mb-4 border-b pb-2">Kategori Section</h2>
            
            <div class="mb-6">
                <div class="flex items-center justify-between cursor-pointer mb-2">
                    <span class="font-semibold text-sm">Pilih Kategori:</span>
                    <i class="fas fa-list text-xs"></i>
                </div>
                <div class="pl-2 flex flex-col gap-3 text-sm text-gray-600 mt-3">
                    <?php if(!empty($koleksi_buku)): ?>
                        <?php foreach(array_keys($koleksi_buku) as $index => $key_kategori): ?>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-epustaka-green" onclick="document.getElementById('sec-<?= $key_kategori ?>').scrollIntoView();">
                                <input type="radio" name="nav_kategori" class="text-epustaka-green focus:ring-epustaka-green" <?= $index === 0 ? 'checked' : '' ?>>
                                <span class="capitalize"><?= str_replace('&', ' & ', $key_kategori) ?></span>
                            </label>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-xs text-red-500">Kategori kosong.</p>
                    <?php endif; ?>
                </div>
            </div>
        </aside>

        <!-- Area Grid Produk -->
        <div class="w-full md:w-3/4 flex flex-col gap-12">

            <?php if(empty($koleksi_buku)): ?>
                <div class="bg-white p-8 text-center rounded-xl shadow-sm border border-gray-50">
                    <h3 class="text-lg font-bold text-gray-500">Belum ada data buku.</h3>
                    <p class="text-sm text-gray-400">Pastikan database Anda sudah terisi dan model berhasil mengambil data.</p>
                </div>
            <?php endif; ?>

            <?php foreach ($koleksi_buku as $id_kategori => $kategori): ?>
            <!-- Section Kategori -->
            <section id="sec-<?= $id_kategori ?>" class="scroll-mt-24 bg-white p-6 rounded-xl shadow-sm border border-gray-50">
                <div class="mb-6 flex justify-between items-center border-b pb-4">
                    <h2 class="text-2xl font-bold text-epustaka-green">
                        <i class="fas fa-book-open mr-2"></i> <?= $kategori['judul_section'] ?>
                    </h2>
                    <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full font-semibold">
                        <?= count($kategori['data']) ?> Buku
                    </span>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    <?php foreach ($kategori['data'] as $book): ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md hover:border-epustaka-green transition duration-300 flex flex-col h-full relative group">
                        
                        <!-- Gambar Buku -->
                        <div class="w-full h-56 bg-gray-100 rounded-md mb-4 overflow-hidden flex items-center justify-center relative">
                            <!-- Anda bisa mengganti ini dengan base_url('assets/img/'.$book['gambar']) jika menggunakan helper URL CI -->
                            <img src="<?= htmlspecialchars($book['gambar'] ?? '') ?>" alt="<?= htmlspecialchars($book['judul_buku'] ?? '') ?>" class="w-full h-full object-cover z-10" onerror="this.style.display='none'">
                            <span class="absolute text-gray-400 text-xs text-center px-2 z-0">Gambar: <?= htmlspecialchars($book['gambar'] ?? 'Tidak ada') ?></span>
                        </div>

                        <!-- Info Buku -->
                        <div class="flex-grow flex flex-col">
                            <h3 class="font-bold text-sm md:text-base text-gray-800 line-clamp-2 leading-tight mb-1"><?= htmlspecialchars($book['judul_buku'] ?? 'Tanpa Judul') ?></h3>
                            <p class="text-xs text-gray-500 mb-2">By <?= htmlspecialchars($book['penulis'] ?? 'Unknown') ?> <br> <span class="italic"><?= htmlspecialchars($book['penerbit'] ?? '-') ?></span></p>
                            
                            <!-- Rating -->
                            <div class="flex text-epustaka-orange text-xs mb-3">
                                <?php 
                                    $rating = isset($book['rating']) ? (int)$book['rating'] : 0;
                                    for($i=1; $i<=5; $i++): 
                                ?>
                                    <i class="<?= $i <= $rating ? 'fas' : 'far' ?> fa-star"></i>
                                <?php endfor; ?>
                            </div>

                            <p class="text-xs text-gray-600 line-clamp-2 mb-3"><?= htmlspecialchars($book['deskripsi'] ?? '') ?></p>
                            
                            <div class="mt-auto">
                                <p class="font-bold text-lg text-gray-900 mb-3">Rp <?= number_format($book['harga'] ?? 0, 0, ',', '.') ?></p>
                                
                                <button class="w-full bg-epustaka-green text-white text-xs font-bold py-2.5 rounded-md hover:bg-teal-800 transition shadow-sm">
                                    TAMBAH KE KERANJANG
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endforeach; ?>

        </div>
    </main>

    <!-- Script navigasi radio button -->
    <script>
        document.addEventListener('scroll', function() {
            const sections = <?= json_encode(array_keys($koleksi_buku)) ?>;
            let current = '';

            sections.forEach(sec => {
                const element = document.getElementById('sec-' + sec);
                if (element && window.scrollY >= (element.offsetTop - 150)) {
                    current = sec;
                }
            });

            if(current !== '') {
                const radios = document.getElementsByName('nav_kategori');
                const index = sections.indexOf(current);
                if(radios[index]) radios[index].checked = true;
            }
        });
    </script>
</body>
</html>