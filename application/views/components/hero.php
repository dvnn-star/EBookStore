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

<!-- Kontainer Utama: Latar belakang tetap full-width -->
<div class="bg-teal-700 text-white px-6 md:px-16 py-16">
    
    <!-- Pembungkus Konten: Membatasi lebar maksimal dan otomatis ke tengah (mx-auto) -->
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-10">
        
        <!-- Blok Teks -->
        <div class="max-w-xl text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 leading-snug">
                <?= $title ?>
            </h1>
            
            <p class="text-gray-200 mb-6 text-sm md:text-base">
                <?= $desc ?>
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                <button 
                    onclick="window.location.href='<?= base_url('terpopuler'); ?>'"
                    class="bg-orange-500 hover:bg-orange-600 px-5 py-3 rounded font-semibold transition text-sm md:text-base">
                    MULAI MEMBACA SEKARANG!
                </button>
            
                <button
                    onclick="window.location.href='<?= base_url('kategori'); ?>'"
                    class="bg-transparent border border-white px-5 py-3 rounded hover:bg-white hover:text-teal-700 transition text-sm md:text-base">
                    Lihat Koleksi
                </button>
            </div>
        </div>

        <!-- Blok Gambar: Menghapus margin hack 'mr-[100px]' -->
        <div class="hidden md:block max-w-sm lg:max-w-md flex-shrink-0">
            <img src="<?= $image ?>" alt="ebook" class="w-full h-auto object-contain">
        </div>

    </div>

</div>

</body>
</html>