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
        <!-- Logo -->
        <div class="text-2xl font-bold text-[#0E6D64]">E-PUSTAKA</div>
        
        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button id="menu-btn" class="text-[#0E6D64] focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white flex-col p-6 shadow-xl md:static md:flex md:flex-row md:shadow-none md:w-auto md:p-0 md:space-x-8 md:items-center font-medium">
            
            <!-- Link Beranda (Kondisi Aktif) -->
            <a href="" class="nav-link text-[#0E6D64] border-b-2 border-[#0E6D64] py-2 md:py-0 transition-all duration-300">
                Beranda
            </a>
            <!-- Link Lainnya (Gunakan text-gray-500 agar kontras saat hover ke warna primary) -->
            <a href="#kategori" class="nav-link text-gray-500 hover:text-[#0E6D64] hover:scale-105 transition-all duration-300 py-2 md:py-0 block">
                Kategori
            </a>
            <a href="#populer" class="nav-link text-gray-500 hover:text-[#0E6D64] hover:scale-105 transition-all duration-300 py-2 md:py-0 block">
                Terpopuler
            </a>
            <a href="#footer" class="nav-link text-gray-500 hover:text-[#0E6D64] hover:scale-105 transition-all duration-300 py-2 md:py-0 block">
                Tentang Kami
            </a>
            
            <!-- Search & Button Container -->
            <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-4 mt-4 md:mt-0">
                <div class="relative w-full md:w-auto">
                    <input type="text" placeholder="Cari buku..." class="w-full pl-10 pr-4 py-2 border rounded-full text-sm focus:outline-none focus:ring-1 focus:ring-[#0E6D64] md:w-64">
                    <svg class="w-4 h-4 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                </div>
                <button class="bg-[#FF8C00] text-white px-6 py-2 rounded-full font-semibold hover:bg-[#e67e00] transition-all shadow-md w-full md:w-auto">
                    MASUK
                </button>
            </div>
        </div>
    </div>
</nav>

<script>
    // Pastikan script ini ada di bagian bawah sebelum tag </body>
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
            // Hapus status aktif dari semua link
            navLinks.forEach(l => {
                l.classList.remove('text-[#0E6D64]', 'border-b-2', 'border-[#0E6D64]');
                l.classList.add('text-gray-500');
            });

            // Tambahkan status aktif ke link yang diklik
            this.classList.add('text-[#0E6D64]', 'border-b-2', 'border-[#0E6D64]');
            this.classList.remove('text-gray-500');

            // Tutup mobile menu jika terbuka
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