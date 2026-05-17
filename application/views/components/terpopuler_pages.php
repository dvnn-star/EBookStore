<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA - Katalog Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 'ep-green': '#0c6b63', 'ep-orange': '#f39c12' },
                    animation: { 
                        'fade-in': 'fadeIn 0.3s ease-out',
                        'slide-in': 'slideIn 0.4s cubic-bezier(0.16, 1, 0.3, 1)'
                    },
                    keyframes: { 
                        fadeIn: { '0%': { opacity: 0, transform: 'scale(0.95)' }, '100%': { opacity: 1, transform: 'scale(1)' } },
                        slideIn: { '0%': { transform: 'translateX(100%)', opacity: 0 }, '100%': { transform: 'translateX(0)', opacity: 1 } }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans text-slate-900">
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row gap-10">
            <aside class="w-full md:w-72 flex-shrink-0">
                <div class="sticky top-28 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-tags text-ep-green"></i> Kategori Buku
                    </h3>
                    <nav id="sidebar-nav" class="space-y-2">
                        <?php if (!empty($koleksi_buku)): ?>
                            <?php foreach ($koleksi_buku as $key => $section): 
                                $safe_id = str_replace(['&', ' '], '-', $key); 
                            ?>
                                <?php if (!empty($section['data'])): ?>
                                    <button type="button" id="btn-<?= $safe_id ?>" onclick="scrollToSection('<?= $safe_id ?>')" class="nav-btn w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-300 group hover:bg-slate-50">
                                        <div class="flex items-center gap-3">
                                            <div class="dot w-1.5 h-1.5 rounded-full bg-slate-300 group-hover:bg-ep-green transition-colors"></div>
                                            <span class="text-sm font-medium text-slate-600 group-hover:text-ep-green capitalize">
                                                <?= str_replace(['_', '&'], [' ', ' & '], $key) ?>
                                            </span>
                                        </div>
                                        <span class="text-[10px] bg-slate-100 px-2 py-0.5 rounded-md text-slate-400 group-hover:bg-ep-green/10 group-hover:text-ep-green transition-colors">
                                            <?= count($section['data']) ?>
                                        </span>
                                    </button>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </nav>
                </div>
            </aside>
            <div class="flex-grow space-y-16">
                <?php if (!empty($koleksi_buku)): ?>
                    <?php foreach ($koleksi_buku as $id_kat => $section): 
                        $safe_id = str_replace(['&', ' '], '-', $id_kat);
                    ?>
                        <section id="sec-<?= $safe_id ?>" class="scroll-mt-32">
                            <div class="mb-8">
                                <h2 class="text-3xl font-black text-slate-800 tracking-tight"><?= $section['judul'] ?></h2>
                                <div class="h-1.5 w-20 bg-ep-green mt-2 rounded-full"></div>
                            </div>
                            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                                <?php foreach ($section['data'] as $b): ?>
                                    <div onclick='bukaModal(<?= htmlspecialchars(json_encode($b), ENT_QUOTES, 'UTF-8') ?>)' class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:border-ep-green/30 transition-all duration-500 cursor-pointer group flex flex-col h-full">
                                        <div class="relative aspect-[3/4.5] mb-5 overflow-hidden rounded-xl bg-slate-100 shadow-inner">
                                            <img src="<?= $b->gambar ?>" onerror="this.src='https://placehold.co/400x600?text=No+Image'" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="<?= $b->judul_buku ?>">
                                        </div>
                                        <h4 class="font-bold text-slate-800 text-sm line-clamp-2 min-h-[2.5rem] leading-snug group-hover:text-ep-green transition-colors">
                                            <?= $b->judul_buku ?>
                                        </h4>
                                        <p class="text-xs text-slate-400 mt-1 mb-4"><?= $b->penulis ?></p>
                                        <div class="mt-auto pt-4 border-t border-slate-50">
                                            <div class="flex items-center justify-between mb-3">
                                                <span class="font-black text-ep-green">
                                                    Rp<?= number_format($b->harga, 0, ',', '.') ?>
                                                </span>
                                                <div class="flex text-ep-orange text-[9px] gap-0.5">
                                                    <?php for ($i = 1; $i <= 5; $i++) echo '<i class="' . ($i <= $b->rating ? 'fas' : 'far') . ' fa-star"></i>'; ?>
                                                </div>
                                            </div>
                                            <div class="flex gap-2">
                                                <button type="button" onclick="event.stopPropagation(); cartAction(<?= htmlspecialchars(json_encode($b), ENT_QUOTES, 'UTF-8') ?>, true);" class="flex-grow bg-ep-orange text-white text-[11px] font-bold py-2.5 rounded-xl shadow-lg shadow-ep-orange/20 hover:bg-slate-800 transition-all active:scale-95">
                                                    BELI
                                                </button>
                                                <button type="button" onclick="event.stopPropagation(); cartAction(<?= htmlspecialchars(json_encode($b), ENT_QUOTES, 'UTF-8') ?>, false);" class="flex-none border border-slate-200 bg-white text-slate-400 w-10 rounded-xl hover:border-ep-green hover:text-ep-green transition-all shadow-sm active:scale-95 flex items-center justify-center">
                                                    <i class="fas fa-cart-plus text-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-20 bg-white rounded-3xl border border-dashed">
                        <p class="text-slate-400">Data buku tidak ditemukan.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="toast-container" class="fixed bottom-10 right-10 z-[110] flex flex-col gap-4 pointer-events-none"></div>
    <div id="modal" class="fixed inset-0 bg-slate-900/60 z-[100] hidden items-center justify-center p-4 backdrop-blur-md" onclick="closeOnOverlay(event)">
        <div class="bg-white max-w-2xl w-full rounded-3xl overflow-hidden flex flex-col md:flex-row relative animate-fade-in shadow-2xl">
            <button onclick="tutupModal()" class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center bg-slate-100 text-slate-500 rounded-full hover:bg-red-50 hover:text-red-500 transition-all z-10">
                <i class="fas fa-times"></i>
            </button>
            <div class="w-full md:w-1/2 bg-slate-50 p-10 flex items-center justify-center">
                <img id="md-img" src="" class="h-72 object-cover shadow-2xl rounded-xl rotate-2 hover:rotate-0 transition-transform duration-500">
            </div>
            <div class="p-10 md:w-1/2 flex flex-col">
                <span class="text-[10px] font-black text-ep-green uppercase tracking-[0.2em] mb-2">Detail Produk</span>
                <h2 id="md-title" class="text-2xl font-bold text-slate-900 leading-tight mb-2"></h2>
                <p id="md-author" class="text-slate-400 text-sm mb-4 font-medium"></p>
                <div class="mb-6">
                    <span class="text-gray-400 text-xs block">Harga Produk:</span>
                    <span id="md-price" class="text-2xl font-black text-ep-green"></span>
                </div>
                <p id="md-desc" class="text-slate-600 text-sm leading-relaxed mb-8 line-clamp-4"></p>
                <div class="mt-auto flex gap-3">
                    <button id="modal-buy-btn" class="flex-grow bg-ep-orange text-white py-4 rounded-2xl font-bold shadow-lg shadow-ep-orange/20 hover:bg-slate-800 transition-all active:scale-95 flex items-center justify-center gap-2 text-sm">
                        <i class="fas fa-shopping-bag"></i> BELI SEKARANG
                    </button>
                    <button id="modal-cart-btn" class="flex-none border border-slate-200 bg-white text-slate-400 w-14 rounded-2xl hover:border-ep-green hover:text-ep-green transition-all shadow-sm active:scale-95 flex items-center justify-center">
                        <i class="fas fa-cart-plus text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const CURRENT_USER = "<?= htmlspecialchars($this->session->userdata('username') ?? 'guest'); ?>";
        const LOGIN_URL = "<?= base_url('login'); ?>";
        const STORAGE_KEY = `cart_storage_${CURRENT_USER}`;
        function scrollToSection(id) {
            const element = document.getElementById('sec-' + id);
            if (element) {
                const offset = 120;
                window.scrollTo({
                    top: element.offsetTop - offset,
                    behavior: 'smooth'
                });
            }
        }
        function updateActiveMenu() {
            const sections = document.querySelectorAll('section[id^="sec-"]');
            const navBtns = document.querySelectorAll('.nav-btn');
            let currentId = "";
            sections.forEach(sec => {
                if (window.pageYOffset >= (sec.offsetTop - 150)) {
                    currentId = sec.getAttribute('id').replace('sec-', '');
                }
            });
            navBtns.forEach(btn => {
                const btnId = btn.id.replace('btn-', '');
                const dot = btn.querySelector('.dot');
                const text = btn.querySelector('span');
                if (btnId === currentId) {
                    btn.classList.add('bg-ep-green/10', 'ring-1', 'ring-ep-green/20');
                    dot.classList.add('bg-ep-green', 'scale-150');
                    text.classList.add('text-ep-green', 'font-bold');
                } else {
                    btn.classList.remove('bg-ep-green/10', 'ring-1', 'ring-ep-green/20');
                    dot.classList.remove('bg-ep-green', 'scale-150');
                    text.classList.remove('text-ep-green', 'font-bold');
                }
            });
        }
        window.addEventListener('scroll', updateActiveMenu);
        window.addEventListener('load', updateActiveMenu);
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toastId = 'toast-' + Date.now();
            const colorClass = type === 'success' ? 'border-ep-green text-ep-green' : 'border-ep-orange text-ep-orange';
            const iconClass = type === 'success' ? 'fa-check' : 'fa-info-circle';
            const toastHTML = `
                <div id="${toastId}" class="pointer-events-auto flex items-center gap-4 bg-white border-l-4 ${colorClass} p-5 pr-10 rounded-2xl shadow-2xl shadow-slate-200/50 animate-slide-in relative overflow-hidden min-w-[320px]">
                    <div class="flex-none w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center">
                        <i class="fas ${iconClass}"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">E-Pustaka System</p>
                        <p class="text-sm font-bold text-slate-700">${message}</p>
                    </div>
                    <div class="absolute bottom-0 left-0 h-1 bg-slate-100 w-full">
                        <div class="h-full bg-current opacity-20 transition-all duration-[3000ms] ease-linear w-full" id="progress-${toastId}"></div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', toastHTML);
            const toastElement = document.getElementById(toastId);
            setTimeout(() => {
                const progressBar = document.getElementById(`progress-${toastId}`);
                if(progressBar) progressBar.style.width = '0%';
            }, 10);
            setTimeout(() => {
                toastElement.classList.add('opacity-0', 'translate-x-10');
                setTimeout(() => toastElement.remove(), 500);
            }, 3000);
        }
        function cartAction(dataBuku, isRedirect) {
            if (CURRENT_USER === 'guest') {
                window.location.href = LOGIN_URL;
                return; 
            }
            let currentCart = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
            const isExist = currentCart.find(item => item.id === dataBuku.id);
            if (!isExist) {
                currentCart.push(dataBuku);
                localStorage.setItem(STORAGE_KEY, JSON.stringify(currentCart));
                if (!isRedirect) {
                    showToast(`${dataBuku.judul_buku} berhasil ditambahkan!`, 'success');
                }
            } else {
                if (!isRedirect) {
                    showToast(`Buku ini sudah ada di keranjang.`, 'info');
                }
            }
            if (isRedirect) {
                setTimeout(() => window.location.href = "<?= base_url('keranjang'); ?>", 100);
            }
        }
        function bukaModal(buku) {
            document.getElementById('md-img').src = buku.gambar;
            document.getElementById('md-title').innerText = buku.judul_buku;
            document.getElementById('md-author').innerText = 'Karya ' + buku.penulis;
            document.getElementById('md-desc').innerText = buku.deskripsi || 'Tidak ada deskripsi tersedia.';
            const hargaIDR = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(buku.harga);
            document.getElementById('md-price').innerText = hargaIDR;
            document.getElementById('modal-buy-btn').onclick = function() {
                cartAction(buku, true);
            };
            document.getElementById('modal-cart-btn').onclick = function() {
                cartAction(buku, false);
            };
            document.getElementById('modal').classList.replace('hidden', 'flex');
            document.body.style.overflow = 'hidden';
        }
        function tutupModal() {
            document.getElementById('modal').classList.replace('flex', 'hidden');
            document.body.style.overflow = 'auto';
        }
        function closeOnOverlay(e) {
            if (e.target.id === 'modal') tutupModal();
        }
    </script>
</body>
</html>