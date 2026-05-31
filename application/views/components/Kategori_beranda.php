<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Beranda E-PUSTAKA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 py-12">

<?php
// Data kategori ditambahkan 'slug' yang sesuai dengan key di halaman Kategori
$categories = [
    [
        'name'  => 'Bisnis & Ekonomi',
        'image' => 'assets/images/bisnis.jpg',
        'slug'  => 'bisnis&ekonomi' // Nyambung ke id="sec-bisnis_ekonomi"
    ],
    [
        'name'  => 'Fiksi',
        'image' => 'assets/images/fiksi.avif',
        'slug'  => 'fiksi'          // Nyambung ke id="sec-fiksi"
    ],
    [
        'name'  => 'Edukasi',
        'image' => 'assets/images/education.avif',
        'slug'  => 'edukasi'        // Nyambung ke id="sec-edukasi"
    ],
    [
        'name'  => 'Sejarah',
        'image' => 'assets/images/Sejarah2.png',
        'slug'  => 'sejarah'        // Nyambung ke id="sec-sejarah"
    ]
];
?>

<div class="mt-6 max-w-7xl mx-auto px-4">
    <!-- Judul  -->
    <h2 class="text-center text-xl md:text-2xl font-bold text-gray-900 mb-8 tracking-tight">
        Temukan Berdasarkan Kategori
    </h2>

    <!-- Grid Container (4 Kolom) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <?php foreach ($categories as $cat): ?>
            
            <!-- Menggunakan Tag <a> untuk Link Pindah Halaman & Scroll -->
            <a href="<?= base_url('kategori#sec-' . $cat['slug']); ?>" 
               class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-4 border border-gray-100 flex flex-col items-center group cursor-pointer block">
                
                <!-- Container Gambar/Ilustrasi -->
                <div class="w-full aspect-square mb-4 overflow-hidden rounded-lg bg-gray-50 flex items-center justify-center relative">
                    <img 
                        src="<?= base_url($cat['image']); ?>" 
                        alt="<?= $cat['name']; ?>" 
                        class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300 z-10"
                        onerror="this.style.display='none'"
                    >
                </div>

                <!-- Nama Kategori -->
                <span class="text-gray-800 font-bold text-sm md:text-base text-center group-hover:text-[#0c6b63] transition-colors">
                    <?= $cat['name']; ?>
                </span>
                
            </a>
            
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>