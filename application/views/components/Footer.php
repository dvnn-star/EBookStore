<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer E-PUSTAKA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

<?php
// Data navigasi footer
$footerData = [
    'Navigasi' => [
        'Beranda'      => '', // Sesuaikan dengan controller utama Anda
        'Kategori'     => 'kategori', // Ganti dengan nama controller kategori Anda
        'Terpopuler'   => 'terpopuler',
        'Tentang Kami' => 'tentang'],

    'Kategori' => [
        // Format: 'NAMA_CONTROLLER/index#sec-ID_KATEGORI'
        // Sesuaikan 'kategori' dengan nama controller tempat form kategori Anda berada
        'Sejarah'          => 'kategori#sec-sejarah',
        'Bisnis & Ekonomi' => 'kategori#sec-bisnis&ekonomi',
        'Edukasi'          => 'kategori#sec-edukasi',
        'Fiksi'            => 'kategori#sec-fiksi'
    ],
    
    'Bantuan' => [
        'FAQ'    => '#sec-FAQ', 
        'Kontak' => '#sec-Kontak'
    ]
];
?>

<footer class="bg-[#004d4d] text-white pt-12 pb-6 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 justify-items-center">
            
            <!-- Looping untuk Navigasi, Kategori, Bantuan -->
            <?php foreach ($footerData as $title => $links): ?>
            <div>
                <h4 class="font-bold text-lg mb-4"><?php echo $title; ?></h4>
                <ul class="space-y-2">
                    <?php foreach ($links as $label => $url): ?>
                    <li>
                        <a href="<?= base_url($url); ?>" 
                        class="text-gray-300 hover:text-white transition text-sm">
                            <?= $label; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>

            <!-- Media Sosial -->
            <div>
                <h4 class="font-bold text-lg mb-4">Media Sosial</h4>
                <div class="space-y-3">
                    <a href="#" class="flex items-center space-x-2 text-gray-300 hover:text-white transition text-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        <span>Facebook</span>
                    </a>
                    <a href="#" class="flex items-center space-x-2 text-gray-300 hover:text-white transition text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        <span>Instagram</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Garis Tipis & Copyright -->
        <div class="border-t border-white/10 pt-8 text-center text-sm text-gray-400">
            <p>&copy; 2024 E-PUSTAKA. All Rights Reserved.</p>
        </div>
    </div>

</footer>

</body>
</html>