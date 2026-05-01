<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <title>Kategori E-PUSTAKA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 py-12">

<?php
// Data kategori dengan placeholder ilustrasi
$categories = [
    [
        'name' => 'Bisnis & Ekonomi',
        'image' => 'assets/images/bisnis.jpg',
    ],
    [
        'name' => 'Fiksi',
        'image' => 'assets/images/fiksi.avif',
    ],
    [
        'name' => 'Edukasi',
        'image' => 'assets/images/education.avif',
    ],
    [
        'name' => 'Sejarah',
        'image' => 'assets/images/Sejarah.png',
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
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-4 border border-gray-100 flex flex-col items-center group cursor-pointer">
                
                <!-- Container Gambar/Ilustrasi -->
                <div class="w-full aspect-square mb-4 overflow-hidden rounded-lg bg-gray-50 flex items-center justify-center">
                    <img 
                        src="<?php echo $cat['image']; ?>" 
                        alt="<?php echo $cat['name']; ?>" 
                        class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                    >
                </div>

                <!-- Nama Kategori -->
                <span class="text-gray-800 font-bold text-sm md:text-base text-center">
                    <?php echo $cat['name']; ?>
                </span>
                
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>