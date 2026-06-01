<?php
// Data navigasi footer
$footerData = [
    'Navigasi' => [
        'Beranda'      => '', 
        'Kategori'     => 'kategori', 
        'Terpopuler'   => 'terpopuler',
        'Tentang Kami' => 'tentang'
    ],
    'Kategori' => [
        'Sejarah'          => 'kategori#sec-sejarah',
        'Bisnis & Ekonomi' => 'kategori#sec-bisnis&ekonomi',
        'Edukasi'          => 'kategori#sec-edukasi',
        'Fiksi'            => 'kategori#sec-fiksi'
    ],
    'Bantuan' => [
        'FAQ'    => 'about#sec-FAQ', 
        'Kontak' => 'about#sec-Kontak'
    ]
];
?>

<footer class="bg-[#004d4d] text-white pt-16 pb-8 border-t border-white/10 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-10">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">
            
            <?php foreach ($footerData as $title => $links): ?>
            <div class="text-center sm:text-left">
                <h4 class="font-bold text-sm uppercase tracking-wider text-white/90 mb-4">
                    <?= $title; ?>
                </h4>
                <ul class="space-y-3">
                    <?php foreach ($links as $label => $url): ?>
                    <li>
                        <a href="<?= base_url($url); ?>" 
                           class="text-gray-300 hover:text-white text-sm font-medium transition-colors duration-300 block py-0.5">
                            <?= $label; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>

            <div class="text-center sm:text-left">
                <h4 class="font-bold text-sm uppercase tracking-wider text-white/90 mb-4">
                    Media Sosial
                </h4>
                <div class="flex flex-col items-center sm:items-start space-y-3">
                    <a href="https://facebook.com/WindahBasudara" class="inline-flex items-center space-x-2.5 text-gray-300 hover:text-white text-sm font-medium transition-colors duration-300 group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                        <span>Facebook</span>
                    </a>
                    <a href="https://instagram.com/dvn_delvin/" class="inline-flex items-center space-x-2.5 text-gray-300 hover:text-white text-sm font-medium transition-colors duration-300 group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                        <span>Instagram</span>
                    </a>
                </div>
            </div>

        </div>

        <div class="border-t border-white/10 mt-12 pt-8 text-center text-xs font-medium text-gray-400 tracking-wide">
            <p>&copy; <?= date('Y'); ?> E-PUSTAKA. All Rights Reserved.</p>
        </div>
    </div>
</footer>