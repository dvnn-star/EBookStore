<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <title>E-Book Terpopuler</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 py-16">

<?php
// Data buku untuk simulasi database

?>

<div class="max-w-7xl mx-auto px-4">
    <!-- Judul Section -->
    <h2 class="mt-5 text-center text-2xl md:text-3xl font-bold text-gray-900 mb-12">
        E-Book Terpopuler Bulan Ini
    </h2>

    <!-- Grid Kartu Buku -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($buku as $book): ?>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex flex-col h-full">
                
                <!-- Container Cover Buku -->
                <div class="<?php  ?> rounded-xl p-6 mb-4 flex justify-center items-center">
                    <img src="<?php echo $book['gambar']; ?>" 
                         alt="<?php echo $book['judul_buku']; ?>" 
                         class="shadow-2xl rounded-sm w-32 h-44 object-cover transform hover:scale-105 transition-transform duration-300">
                </div>

                <!-- Informasi Buku -->
                <div class="flex-grow">
                    <h3 class="font-bold text-gray-900 text-sm md:text-base leading-tight mb-1 uppercase">
                        <?php echo $book['judul_buku']; ?>
                    </h3>
                    <p class="text-xs text-gray-500 mb-2">By <?php echo $book['penulis']; ?></p>
                    
                    <!-- Rating Bintang -->
                    <div class="flex text-orange-400 mb-3">
                        <?php for($i=0; $i<$book['rating']; $i++): ?>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <?php endfor; ?>
                    </div>

                    <p class="font-bold text-lg text-gray-900 mb-4">Rp <?php echo $book['harga']; ?></p>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex gap-2">
                    <button class="flex-grow bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full text-sm transition-colors uppercase tracking-wider">
                        Beli Sekarang
                    </button>
                    <button class="w-10 h-10 border-2 border-orange-500 text-orange-500 rounded-lg flex items-center justify-center hover:bg-orange-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>