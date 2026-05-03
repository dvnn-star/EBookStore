<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Pustaka</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-0 p-0">

<?php
$title = "JELAJAHI RIBUAN E-BOOK TERBAIK HANYA DI E-PUSTAKA";
$desc  = "Akses instan ke koleksi terlengkap fiksi, non-fiksi, dan edukasi.";
$image = "assets/images/image_hero2.png";
?>

<div class="bg-teal-700 text-white px-10 py-12 flex items-center justify-between">
    
    <!-- Text -->
    <div class="max-w-xl">
        <h1 class="text-3xl md:text-4xl font-bold mb-4 leading-snug">
            <?= $title ?>
        </h1>
        
        <p class="text-gray-200 mb-6">
            <?= $desc ?>
        </p>

        <div class="flex gap-4">
            <button 
            class="bg-orange-500 hover:bg-orange-600 px-5 py-3 rounded font-semibold">
            MULAI MEMBACA SEKARANG!
            </button>
        
            <button
                onclick="window.location.href='<?= base_url('kategori'); ?>'"
                class="bg-orange-500 border-white px-5 py-3 rounded hover:bg-orange-600 transition">
                Lihat Koleksi
            </button>
        </div>
    </div>

    <div class="mr-[100px] hidden md:block" >
        <img src="<?= $image ?>" alt="ebook" class="w-100">
    </div>

</div>

</body>
</html>