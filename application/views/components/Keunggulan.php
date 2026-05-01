<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keunggulan E-PUSTAKA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8f9fa]">

<?php
// Data keunggulan dalam array
$features = [
    [
        'icon' => '<svg class="w-12 h-12 text-[#1a4d4a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2zM5 8h2m-2 4h2"></path></svg>',
        'title' => 'Akses Instan',
        'desc' => 'Akses instan dolor sit amet, cohen instancu mentalkenpstron.'
    ],
    [
        'icon' => '<svg class="w-12 h-12 text-[#1a4d4a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>',
        'title' => 'Koleksi Terbaru',
        'desc' => 'Lorem ipsum dolor sit amet, edton tetteni dion vengenbangan odstosi.'
    ],
    [
        'icon' => '<svg class="w-12 h-12 text-[#1a4d4a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
        'title' => 'Transaksi Aman',
        'desc' => 'ttorem ipsum dolor sit amet, adion untuly ad transotsi aman.'
    ]
];
?>

<section class="py-16 px-4">
    <div class="max-w-6xl mx-auto text-center">
        <!-- Judul Utama -->
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-12 uppercase tracking-tight">
            Keunggulan E-PUSTAKA
        </h2>

        <!-- Grid Container -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-4">
            <?php foreach ($features as $feature): ?>
                <div class="flex flex-col items-center px-6">
                    <!-- Icon Container -->
                    <div class="mb-4">
                        <?php echo $feature['icon']; ?>
                    </div>
                    
                    <!-- Judul Fitur -->
                    <h3 class="text-lg font-bold text-gray-900 mb-2">
                        <?php echo $feature['title']; ?>
                    </h3>
                    
                    <!-- Deskripsi -->
                    <p class="text-sm text-gray-600 leading-relaxed max-w-xs">
                        <?php echo $feature['desc']; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

</body>
</html>