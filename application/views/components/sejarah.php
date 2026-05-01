<?php
// Data tiruan (mock data) untuk buku-buku Sejarah
$books = [
    [
        'title' => 'Sapiens: Riwayat Singkat Umat Manusia',
        'author' => 'Yuval Noah Harari',
        'price' => 115000,
        'rating' => 5,
        'image' => 'https://images.unsplash.com/photo-1461360228754-6e81c478b882?q=80&w=200&h=300&auto=format&fit=crop'
    ],
    [
        'title' => 'Nusantara: Sejarah Indonesia',
        'author' => 'Bernard H.M. Vlekke',
        'price' => 95000,
        'rating' => 4,
        'image' => 'https://images.unsplash.com/photo-1599360889420-714058f82270?q=80&w=200&h=300&auto=format&fit=crop'
    ],
    [
        'title' => 'Guns, Germs, and Steel',
        'author' => 'Jared Diamond',
        'price' => 105000,
        'rating' => 5,
        'image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=200&h=300&auto=format&fit=crop'
    ],
    [
        'title' => 'Bung Karno: Penyambung Lidah Rakyat',
        'author' => 'Cindy Adams',
        'price' => 85000,
        'rating' => 5,
        'image' => 'https://images.unsplash.com/photo-1535905557558-afc4877a26fc?q=80&w=200&h=300&auto=format&fit=crop'
    ],
    [
        'title' => 'Sejarah Modern Indonesia',
        'author' => 'M.C. Ricklefs',
        'price' => 120000,
        'rating' => 5,
        'image' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=200&h=300&auto=format&fit=crop'
    ],
    [
        'title' => 'Sejarah Dunia yang Disembunyikan',
        'author' => 'Jonathan Black',
        'price' => 110000,
        'rating' => 4,
        'image' => 'https://images.unsplash.com/photo-1532012197267-da84d127e765?q=80&w=200&h=300&auto=format&fit=crop'
    ]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Sejarah - E-PUSTAKA</title>
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

    <!-- Navbar Sederhana -->
    <nav class="bg-white shadow-sm py-4 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center gap-8">
            <h1 class="text-2xl font-bold text-epustaka-green">E-PUSTAKA</h1>
            <ul class="hidden md:flex gap-6 text-sm font-semibold text-gray-600">
                <li class="hover:text-epustaka-orange cursor-pointer">Beranda</li>
                <li class="text-epustaka-orange cursor-pointer">Kategori</li>
                <li class="hover:text-epustaka-orange cursor-pointer">Terpopuler</li>
                <li class="hover:text-epustaka-orange cursor-pointer">Blog</li>
            </ul>
        </div>
        <div class="flex items-center gap-4">
            <div class="relative hidden md:block">
                <input type="text" placeholder="Search..." class="bg-gray-100 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-epustaka-green">
                <i class="fas fa-search absolute right-3 top-2.5 text-gray-400"></i>
            </div>
            <button class="bg-epustaka-orange text-white px-5 py-2 rounded-md text-sm font-bold hover:bg-orange-500 transition">MASUK / DAFTAR</button>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="container mx-auto px-4 md:px-12 py-8 flex flex-col md:flex-row gap-8">
        
        <!-- Sidebar Filter -->
        <aside class="w-full md:w-1/4 bg-white p-6 rounded-lg shadow-sm h-fit">
            <h2 class="text-lg font-bold mb-4 border-b pb-2">Kategori</h2>
            
            <!-- Accordion Kategori -->
            <div class="mb-6">
                <div class="flex items-center justify-between cursor-pointer mb-2">
                    <span class="font-semibold text-sm">Ebook</span>
                    <i class="fas fa-chevron-up text-xs"></i>
                </div>
                <div class="pl-4 flex flex-col gap-2 text-sm text-gray-600">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="subkategori" class="text-epustaka-green focus:ring-epustaka-green">
                        <span>Fiksi</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="subkategori" class="text-epustaka-green focus:ring-epustaka-green" checked>
                        <span class="font-medium text-epustaka-green">Sejarah</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="subkategori" class="text-epustaka-green focus:ring-epustaka-green">
                        <span>Biografi</span>
                    </label>
                </div>
            </div>

            <!-- Filter Bahasa -->
            <div class="mb-6 border-t pt-4">
                <h3 class="font-semibold text-sm mb-3">Bahasa</h3>
                <div class="flex flex-col gap-2 text-sm text-gray-600">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="bahasa" class="text-epustaka-green focus:ring-epustaka-green">
                        <span>Indonesia</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="bahasa" class="text-epustaka-green focus:ring-epustaka-green">
                        <span>English</span>
                    </label>
                </div>
            </div>

            <!-- Filter Harga -->
            <div class="mb-6 border-t pt-4">
                <h3 class="font-semibold text-sm mb-3">Harga</h3>
                <div class="flex flex-col gap-3">
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-sm text-gray-500">Rp</span>
                        <input type="number" placeholder="Min" class="w-full border rounded-md pl-10 pr-3 py-2 text-sm focus:outline-none focus:border-epustaka-green">
                    </div>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-sm text-gray-500">Rp</span>
                        <input type="number" placeholder="Max" class="w-full border rounded-md pl-10 pr-3 py-2 text-sm focus:outline-none focus:border-epustaka-green">
                    </div>
                </div>
            </div>

            <!-- Filter Stok -->
            <div class="border-t pt-4">
                <h3 class="font-semibold text-sm mb-3">Stok</h3>
                <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-600">
                    <input type="checkbox" class="rounded text-epustaka-green focus:ring-epustaka-green">
                    <span>Hanya yang tersedia</span>
                </label>
            </div>
        </aside>

        <!-- Grid Produk -->
        <section class="w-full md:w-3/4">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Koleksi Sejarah</h2>
                <span class="text-sm text-gray-500">Menampilkan <?= count($books) ?> hasil</span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                <?php foreach ($books as $book): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition flex flex-col h-full relative">
                    <!-- Icon Favorit -->
                    <button class="absolute top-6 right-6 text-gray-300 hover:text-red-500 transition bg-white/80 rounded-full p-1 z-10">
                        <i class="fas fa-heart"></i>
                    </button>
                    
                    <!-- Cover Buku -->
                    <div class="w-full h-48 bg-gray-200 rounded-md mb-4 overflow-hidden">
                        <img src="<?= $book['image'] ?>" alt="<?= $book['title'] ?>" class="w-full h-full object-cover">
                    </div>

                    <!-- Info Buku -->
                    <div class="flex-grow flex flex-col">
                        <h3 class="font-bold text-sm md:text-base text-gray-800 line-clamp-2 leading-tight mb-1 uppercase"><?= $book['title'] ?></h3>
                        <p class="text-xs text-gray-500 mb-2">By <?= $book['author'] ?></p>
                        
                        <!-- Rating Bintang -->
                        <div class="flex text-epustaka-orange text-xs mb-3">
                            <?php for($i=1; $i<=5; $i++): ?>
                                <i class="<?= $i <= $book['rating'] ? 'fas' : 'far' ?> fa-star"></i>
                            <?php endfor; ?>
                        </div>
                        
                        <div class="mt-auto">
                            <p class="font-bold text-base md:text-lg text-gray-900 mb-3">Rp <?= number_format($book['price'], 0, ',', '.') ?></p>
                            
                            <!-- Tombol Action -->
                            <div class="flex gap-2">
                                <button class="flex-grow bg-epustaka-orange text-white text-xs font-bold py-2 rounded-md hover:bg-orange-500 transition">
                                    BELI SEKARANG
                                </button>
                                <button class="border-2 border-epustaka-orange text-epustaka-orange p-2 rounded-md hover:bg-orange-50 transition">
                                    <i class="fas fa-shopping-basket"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

    </main>

</body>
</html>