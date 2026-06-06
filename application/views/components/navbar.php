<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA - Toko Buku Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        nav {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <nav class="bg-white/95 border-b border-slate-100 sticky top-0 z-50 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                <div class="text-2xl font-black text-[#0E6D64] tracking-tight cursor-pointer shrink-0" onclick="window.location.href='<?= base_url(); ?>'">
                    E-<span class="text-[#FF8C00]">PUSTAKA</span>
                </div>

                <div class="hidden md:flex items-center space-x-8 font-semibold text-sm">
                    <?php $current_page = $this->uri->segment(1); ?>
                    <a href="<?= base_url(); ?>" class="<?= ($current_page == '' || $current_page == 'beranda') ? 'text-[#0E6D64]' : 'text-slate-500 hover:text-[#0E6D64]'; ?> transition-colors py-2">Beranda</a>
                    <a href="<?= base_url('kategori'); ?>" class="<?= ($current_page == 'kategori') ? 'text-[#0E6D64]' : 'text-slate-500 hover:text-[#0E6D64]'; ?> transition-colors py-2">Kategori</a>
                    <a href="<?= base_url('terpopuler'); ?>" class="<?= ($current_page == 'terpopuler') ? 'text-[#0E6D64]' : 'text-slate-500 hover:text-[#0E6D64]'; ?> transition-colors py-2">Terpopuler</a>
                    <a href="<?= base_url('about'); ?>" class="<?= ($current_page == 'about') ? 'text-[#0E6D64]' : 'text-slate-500 hover:text-[#0E6D64]'; ?> transition-colors py-2">Tentang Kami</a>
                </div>

                <div class="flex items-center space-x-4">

                    <div class="relative hidden lg:block">
                        <input type="text" id="search-input-desktop" placeholder="Cari buku..." class="w-64 pl-10 pr-4 py-2 border border-slate-200 rounded-xl text-xs font-medium bg-slate-50 focus:outline-none focus:ring-2 focus:ring-[#0E6D64]/20 focus:border-[#0E6D64] transition-all">
                        <i class="fa-solid cursor-pointer fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                        
                        <div id="search-results-wrapper-desktop" class="hidden absolute left-0 mt-2 w-80 bg-white border border-slate-100 rounded-2xl shadow-2xl p-4 z-50 max-h-96 overflow-y-auto">
                            <div id="search-results-content-desktop" class="space-y-2"></div>
                        </div>
                    </div>

                    <a href="<?= $this->session->userdata('logged_in') ? base_url('keranjang') : base_url('login'); ?>" class="relative p-2.5 bg-slate-50 text-[#0E6D64] hover:bg-[#0E6D64] hover:text-white rounded-xl transition-all group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </a>

                    <?php if ($this->session->userdata('logged_in')) : ?>
                        <div class="relative hidden md:inline-block text-left">
                            <button id="dropdownButton" class="flex items-center space-x-2 p-2 px-3 border border-slate-100 hover:bg-slate-50 rounded-xl focus:outline-none transition-colors group">
                                <span class="text-[#0E6D64] font-bold text-xs truncate max-w-[120px]">
                                    Halo, <?= htmlspecialchars($this->session->userdata('username')); ?>
                                </span>
                                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200 group-hover:rotate-180"></i>
                            </button>

                            <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-52 bg-white border border-slate-100 rounded-2xl shadow-2xl p-2 z-50 animate-slide-in">
                                <a href="<?= base_url('bukusaya/' . $this->session->userdata('user_id')); ?>" class="flex items-center px-4 py-3 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-[#0E6D64] rounded-xl transition-colors">
                                    <i class="fa-solid fa-book-bookmark mr-3 text-slate-400 text-sm w-4"></i>Buku Saya
                                </a>
                                <a href="<?= base_url('transaction/'); ?>" class="flex items-center px-4 py-3 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-[#0E6D64] rounded-xl transition-colors">
                                    <i class="fa-solid fa-clock-rotate-left mr-3 text-slate-400 text-sm w-4"></i>Riwayat Transaksi
                                </a>

                                <a href="<?= base_url('settings'); ?>" class="flex items-center px-4 py-3 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-[#0E6D64] rounded-xl transition-colors">
                                    <i class="fa-solid fa-gear mr-3 text-slate-400 text-sm w-4"></i>Pengaturan
                                </a>

                                <?php if ($this->session->userdata('role') == 'admin'): ?>
                                    <a href="<?= base_url('dashboard/'); ?>" class="flex items-center px-4 py-3 text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-[#0E6D64] rounded-xl transition-colors">
                                        <i class="fa-solid fa-chart-pie mr-3 text-slate-400 text-sm w-4"></i>Dashboard
                                    </a>
                                <?php endif; ?>
                                <hr class="border-slate-100 my-1">
                                <a href="<?= base_url('auth/logout'); ?>" class="flex items-center px-4 py-3 text-xs font-bold text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                                    <i class="fa-solid fa-arrow-right-from-bracket mr-3 text-red-500 text-sm w-4"></i>Keluar
                                </a>
                            </div>
                        </div>
                    <?php else : ?>
                        <button onclick="window.location.href='<?= base_url('login'); ?>' " class="hidden md:block bg-[#FF8C00] hover:bg-[#e67e00] text-white px-6 h-11 text-xs font-black rounded-xl transition-all shadow-md shadow-[#FF8C00]/10 uppercase tracking-wider">
                            Masuk
                        </button>
                    <?php endif; ?>

                    <button id="menu-btn" class="md:hidden p-2.5 text-[#0E6D64] bg-slate-50 rounded-xl focus:outline-none hover:bg-slate-100">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div id="sidebar-backdrop" class="fixed inset-0 z-[100] bg-slate-950/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 md:hidden"></div>

    <div id="mobile-sidebar" class="fixed top-0 right-0 h-full w-[290px] bg-white z-[101] shadow-2xl p-6 flex flex-col justify-between translate-x-full transition-transform duration-300 ease-out md:hidden">
        <div>
            <div class="flex items-center justify-between pb-6 border-b border-slate-100">
                <span class="text-lg font-black text-[#0E6D64]">E-PUSTAKA</span>
                <button id="close-btn" class="w-9 h-9 flex items-center justify-center text-slate-400 bg-slate-50 hover:bg-slate-100 rounded-xl">
                    <i class="fa-solid fa-xmark text-md"></i>
                </button>
            </div>

            <?php if ($this->session->userdata('logged_in')) : ?>
                <div class="mt-6 p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center space-x-3">
                    <div class="w-9 h-9 bg-[#0E6D64] rounded-xl flex items-center justify-center text-white font-bold text-sm uppercase">
                        <?= substr($this->session->userdata('username'), 0, 1); ?>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider leading-none">Selamat Datang,</p>
                        <p class="text-sm font-bold text-slate-700 mt-0.5 truncate"><?= htmlspecialchars($this->session->userdata('username')); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="relative mt-6">
                <input type="text" placeholder="Cari buku pilihanmu..." id="search-input" class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl text-xs font-medium bg-slate-50 focus:outline-none">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
            </div>
            
            <div id="search-results-wrapper" class="hidden absolute left-6 right-6 mt-2 bg-white border border-slate-100 rounded-2xl shadow-2xl p-4 z-50 max-h-80 overflow-y-auto">
                <div id="search-results-content" class="space-y-2"></div>
            </div>

            <div class="flex flex-col space-y-1 mt-8">
                <p class="text-[10px] font-black tracking-widest text-slate-400 uppercase mb-2 px-3">Menu Utama</p>
                <a href="<?= base_url(); ?>" class="flex items-center px-3 py-3 text-xs font-bold rounded-xl text-slate-600 hover:bg-slate-50"><i class="fa-solid fa-house mr-3 w-5 text-slate-400 text-sm"></i>Beranda</a>
                <a href="<?= base_url('kategori'); ?>" class="flex items-center px-3 py-3 text-xs font-bold rounded-xl text-slate-600 hover:bg-slate-50"><i class="fa-solid fa-layer-group mr-3 w-5 text-slate-400 text-sm"></i>Kategori</a>
                <a href="<?= base_url('terpopuler'); ?>" class="flex items-center px-3 py-3 text-xs font-bold rounded-xl text-slate-600 hover:bg-slate-50"><i class="fa-solid fa-fire mr-3 w-5 text-slate-400 text-sm"></i>Terpopuler</a>
                <a href="<?= base_url('about'); ?>" class="flex items-center px-3 py-3 text-xs font-bold rounded-xl text-slate-600 hover:bg-slate-50"><i class="fa-solid fa-circle-info mr-3 w-5 text-slate-400 text-sm"></i>Tentang Kami</a>
            </div>

            <?php if ($this->session->userdata('logged_in')) : ?>
                <div class="flex flex-col space-y-1 mt-6 pt-6 border-t border-slate-100">
                    <p class="text-[10px] font-black tracking-widest text-slate-400 uppercase mb-2 px-3">Fitur Pengguna</p>

                    <a href="<?= base_url('bukusaya/' . $this->session->userdata('user_id')); ?>" class="flex items-center px-3 py-3 text-xs font-bold rounded-xl text-slate-600 hover:bg-slate-50">
                        <i class="fa-solid fa-book-bookmark mr-3 w-5 text-slate-400 text-sm"></i>Buku Saya
                    </a>

                    <a href="<?= base_url('transaction/'); ?>" class="flex items-center px-3 py-3 text-xs font-bold rounded-xl text-slate-600 hover:bg-slate-50">
                        <i class="fa-solid fa-clock-rotate-left mr-3 w-5 text-slate-400 text-sm"></i>Riwayat Transaksi
                    </a>

                    <a href="<?= base_url('settings'); ?>" class="flex items-center px-3 py-3 text-xs font-bold rounded-xl text-slate-600 hover:bg-slate-50">
                        <i class="fa-solid fa-gear mr-3 w-5 text-slate-400 text-sm"></i>Pengaturan
                    </a>

                    <?php if ($this->session->userdata('role') == 'admin'): ?>
                        <a href="<?= base_url('dashboard/'); ?>" class="flex items-center px-3 py-3 text-xs font-bold rounded-xl text-slate-600 hover:bg-slate-50">
                            <i class="fa-solid fa-chart-pie mr-3 w-5 text-slate-400 text-sm"></i>Dashboard
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="pt-4 border-t border-slate-100">
            <?php if ($this->session->userdata('logged_in')) : ?>
                <a href="<?= base_url('auth/logout'); ?>" class="flex items-center justify-center w-full py-3 bg-red-50 hover:bg-red-100 text-red-600 font-bold text-xs rounded-xl transition-all">
                    <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Keluar Akun
                </a>
            <?php else: ?>
                <button onclick="window.location.href='<?= base_url('login'); ?>'" class="w-full py-3.5 bg-[#FF8C00] text-white font-bold text-xs rounded-xl transition-all shadow-lg shadow-[#FF8C00]/10 uppercase tracking-wider">
                    Masuk Aplikasi
                </button>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const closeBtn = document.getElementById('close-btn');
        const sidebar = document.getElementById('mobile-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');

        function openSidebar() {
            sidebar.classList.remove('translate-x-full');
            backdrop.classList.remove('opacity-0', 'pointer-events-none');
            backdrop.classList.add('opacity-100', 'pointer-events-auto');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.add('translate-x-full');
            backdrop.classList.remove('opacity-100', 'pointer-events-auto');
            backdrop.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'auto';
        }

        if (menuBtn) menuBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (backdrop) backdrop.addEventListener('click', closeSidebar);

        const destopDropdownBtn = document.getElementById('dropdownButton');
        const destopDropdownMenu = document.getElementById('dropdownMenu');

        if (destopDropdownBtn && destopDropdownMenu) {
            destopDropdownBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                destopDropdownMenu.classList.toggle('hidden');
            });

            window.addEventListener('click', () => {
                if (!destopDropdownMenu.classList.contains('hidden')) {
                    destopDropdownMenu.classList.add('hidden');
                }
            });
        }

        // 1. ENGINE UTAMA: Fungsi Closure Debounce
        function debounce(func, delay) {
            let timeoutId;
            return function(...args) {
                if (timeoutId) clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    func.apply(this, args);
                }, delay);
            };
        }

        // 2. LOGIKA UTAMA: Hit API Backend (Mendukung Multi-Device Node Target)
        const executeSearch = (keyword, isDesktop = false) => {
            // Ambil elemen berdasarkan device target aktif
            const suffix = isDesktop ? '-desktop' : '';
            const contentContainer = document.getElementById(`search-results-content${suffix}`);
            const wrapper = document.getElementById(`search-results-wrapper${suffix}`);

            if (keyword.trim() === '') {
                contentContainer.innerHTML = '';
                wrapper.classList.add('hidden');
                return;
            }

            contentContainer.innerHTML = '<p class="text-xs text-slate-400 font-medium animate-pulse p-2">Mencari lektur...</p>';
            wrapper.classList.remove('hidden');

            // Hit route CI3 berbasis GET Array parameter query
            fetch(`<?= base_url('Buku/search/') ?>${encodeURIComponent(keyword)}`)
                .then(response => {
                    if (!response.ok) throw new Error('Network bermasalah');
                    return response.json();
                })
                .then(data => {
                    contentContainer.innerHTML = '';

                    if (data.length === 0) {
                        contentContainer.innerHTML = '<p class="text-xs text-red-400 font-bold p-2">Buku tidak ditemukan.</p>';
                        return;
                    }

                    data.forEach(book => {
                        const rowHTML = `
                            <div class="flex items-center gap-3 p-2 hover:bg-slate-50 rounded-xl cursor-pointer transition-colors" onclick="window.location.href='<?= base_url('buku/detail/') ?>${book.id}'">
                                <img src="<?= base_url('assets/images/Buku/') ?>${book.gambar}" class="w-8 h-10 object-cover rounded-md shadow-sm">
                                <div class="overflow-hidden">
                                    <p class="text-xs font-bold text-slate-800 truncate">${book.judul_buku}</p>
                                    <p class="text-[10px] text-slate-400 font-medium truncate">By ${book.penulis}</p>
                                </div>
                            </div>
                        `;
                        contentContainer.insertAdjacentHTML('beforeend', rowHTML);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    contentContainer.innerHTML = '<p class="text-xs text-red-500 p-2">Sistem gagal memuat data.</p>';
                });
        };

        // 3. EVENT BINDING: Mengikat listener input untuk device mobile dan desktop secara terisolasi
        const bindSearch = (elementId, isDesktop) => {
            const inputEl = document.getElementById(elementId);
            if (inputEl) {
                inputEl.addEventListener('input', debounce((e) => {
                    executeSearch(e.target.value, isDesktop);
                }, 500));
            }
        };

        bindSearch('search-input', false);         // Jalur Mobile Input
        bindSearch('search-input-desktop', true);   // Jalur Desktop Input

        // Global Event: Klik di luar dropdown untuk menutup down bar secara otomatis
        window.addEventListener('click', (e) => {
            const wrapperDesktop = document.getElementById('search-results-wrapper-desktop');
            const wrapperMobile = document.getElementById('search-results-wrapper');
            
            if (wrapperDesktop && !document.getElementById('search-input-desktop').contains(e.target)) {
                wrapperDesktop.classList.add('hidden');
            }
            if (wrapperMobile && !document.getElementById('search-input').contains(e.target)) {
                wrapperMobile.classList.add('hidden');
            }
        });
    </script>
</body>

</html>