<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA - Toko Buku Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .bg-primary { background-color: #0E6D64; }
        .text-primary { color: #0E6D64; }
        .bg-accent { background-color: #FF8C00; }
        .hover-accent:hover { background-color: #e67e00; }
        /* Transisi smooth untuk navbar */
        nav { transition: all 0.3s ease-in-out; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
<!-- NAVBAR -->
<nav class="bg-white shadow-sm sticky top-0 z-50 transition-all duration-300">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        
        <!-- 1. Logo -->
        <div class="text-2xl font-bold text-[#0E6D64] cursor-pointer shrink-0" onclick="window.location.href='<?= base_url(); ?>'">
            E-PUSTAKA
        </div>
        
        <!-- 2. Mobile Menu Button (Hamburger) -->
        <div class="md:hidden flex items-center">
            <button id="menu-btn" class="text-[#0E6D64] focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- 3. Wrapper Menu Navigasi & Action (Digabungkan) -->
        <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white flex-col p-6 shadow-xl md:static md:flex md:flex-row md:justify-between md:items-center md:flex-1 md:ml-10 md:p-0 md:shadow-none font-medium">
            
            <!-- Navigation Links -->
            <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-8 mb-6 md:mb-0">
                <?php $current_page = $this->uri->segment(1); ?>
                <a href="<?= base_url(); ?>" class="nav-link <?= ($current_page == '' || $current_page == 'beranda') ? 'text-[#0E6D64] border-b-2 border-[#0E6D64]' : 'text-gray-500'; ?> hover:text-[#0E6D64] transition-all duration-300 py-2 md:py-0 w-fit">Beranda</a>
                <a href="<?= base_url('kategori'); ?>" class="nav-link <?= ($current_page == 'kategori') ? 'text-[#0E6D64] border-b-2 border-[#0E6D64]' : 'text-gray-500'; ?> hover:text-[#0E6D64] transition-all duration-300 py-2 md:py-0 w-fit">Kategori</a>
                <a href="<?= base_url('terpopuler'); ?>" class="nav-link <?= ($current_page == 'terpopuler') ? 'text-[#0E6D64] border-b-2 border-[#0E6D64]' : 'text-gray-500'; ?> hover:text-[#0E6D64] transition-all duration-300 py-2 md:py-0 w-fit">Terpopuler</a>
                <a href="<?= base_url('about'); ?>" class="nav-link <?= ($current_page == 'about') ? 'text-[#0E6D64] border-b-2 border-[#0E6D64]' : 'text-gray-500'; ?> hover:text-[#0E6D64] transition-all duration-300 py-2 md:py-0 w-fit">Tentang Kami</a>
            </div>
            
            <!-- Search & Button Container -->
            <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-4 border-t border-gray-100 md:border-none pt-6 md:pt-0">
                <div class="relative w-full md:w-auto">
                    <input type="text" placeholder="Cari buku..." class="w-full pl-10 pr-4 py-2 border rounded-full text-sm focus:outline-none focus:ring-1 focus:ring-[#0E6D64] md:w-64">
                    <svg class="w-4 h-4 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                </div>

                <?php if ($this->session->userdata('logged_in')) : ?>
                    <div class="flex items-center justify-between w-full md:w-auto space-x-4">
                        <!-- Nama Akun: Menggunakan flex-1 agar mengisi sisa ruang, dan shrink agar bisa di-truncate jika terlalu panjang -->
                        <span class="text-[#0E6D64] font-medium truncate flex-1 md:flex-none md:max-w-xs cursor-default">
                            Halo, <?= htmlspecialchars($this->session->userdata('username')); ?>
                        </span>
                        
                        <!-- Tombol Keluar: Menghapus w-full dan menambahkan shrink-0 agar ukurannya pas dengan teks -->
                        <a href="<?= base_url('auth/logout'); ?>" class="bg-red-50 text-red-600 border border-red-200 px-6 py-1.5 rounded-full text-sm font-semibold hover:bg-red-500 hover:text-white transition-all text-center shadow-sm shrink-0">
                            Keluar
                        </a>
                    </div>
                <?php else : ?>
                    <button onclick="window.location.href='<?= base_url('login'); ?>'" class="bg-[#FF8C00] text-white px-6 py-2 rounded-full font-semibold hover:bg-[#e67e00] transition-all shadow-md w-full md:w-auto text-center">
                        MASUK
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script>
    const menuBtn = document.querySelector('#menu-btn');
    const mobileMenu = document.querySelector('#mobile-menu');
    const navLinks = document.querySelectorAll('.nav-link');

    // 1. Toggle Menu Mobile
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
        });
    }

    // 2. Logika Smooth Scroll & Update Active Link
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            navLinks.forEach(l => {
                l.classList.remove('text-[#0E6D64]', 'border-b-2', 'border-[#0E6D64]');
                l.classList.add('text-gray-500');
            });
            this.classList.add('text-[#0E6D64]', 'border-b-2', 'border-[#0E6D64]');
            this.classList.remove('text-gray-500');

            if (window.innerWidth < 768) {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('flex');
            }
        });
    });

    // 3. Navbar Sticky Effect on Scroll
    window.addEventListener('scroll', () => {
        const nav = document.querySelector('nav');
        if (window.scrollY > 20) {
            nav.classList.add('shadow-md', 'bg-white/95', 'backdrop-blur-md');
        } else {
            nav.classList.remove('shadow-md', 'bg-white/95', 'backdrop-blur-md');
        }
    });
</script>
</body>
</html>