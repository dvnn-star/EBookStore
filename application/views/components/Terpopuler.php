<?php
define('BOOK_IMAGE_PATH', 'assets/images/Buku/');
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA - E-Book Terpopuler</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        // PERBAIKAN: Menambahkan konfigurasi animasi JIT agar slide-in dan fade-in bekerja nyata
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 'ep-green': '#0c6b63', 'ep-orange': '#f39c12' },
                    animation: { 
                        'fade-in': 'fadeIn 0.25s ease-out',
                        'slide-in': 'slideIn 0.35s cubic-bezier(0.16, 1, 0.3, 1)'
                    },
                    keyframes: { 
                        fadeIn: { '0%': { opacity: 0 }, '100%': { opacity: 1 } },
                        slideIn: { '0%': { transform: 'translateX(100%)', opacity: 0 }, '100%': { transform: 'translateX(0)', opacity: 1 } }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased">

<div class="container mx-auto max-w-6xl px-4 py-12">
    
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">E-Book Terpopuler Bulan Ini</h2>
        <div class="h-1.5 w-12 bg-ep-green mt-3 rounded-full mx-auto"></div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($buku as $book): ?>
            <div onclick='bukaModal(<?= htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8') ?>)' 
                 class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:border-ep-green/20 transition-all duration-500 cursor-pointer group flex flex-col h-full relative">
                
                <div class="relative aspect-[3/4] mb-4 overflow-hidden rounded-xl bg-slate-100 shadow-inner flex justify-center items-center">
                    <img src="<?= BOOK_IMAGE_PATH . htmlspecialchars($book['gambar']); ?>" 
                         onerror="this.src='https://placehold.co/400x600?text=No+Image'" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                         alt="<?php echo htmlspecialchars($book['judul_buku']); ?>">
                </div>

                <h4 class="font-bold text-slate-800 text-sm line-clamp-2 min-h-[2.5rem] leading-snug group-hover:text-ep-green transition-colors">
                    <?php echo htmlspecialchars($book['judul_buku']); ?>
                </h4>
                <p class="text-xs text-slate-400 mt-1 mb-4"><?php echo htmlspecialchars($book['penulis']); ?></p>
                
                <div class="mt-auto pt-4 border-t border-slate-50">
                    <div class="flex items-center justify-between mb-3">
                        <span class="font-black text-base text-ep-green">
                            Rp<?= number_format($book['harga'], 0, ',', '.') ?>
                        </span>
                        <div class="flex text-ep-orange text-[9px] gap-0.5">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="<?= ($i <= $book['rating'] ? 'fas' : 'far') ?> fa-star"></i>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="button" 
                                onclick="event.stopPropagation(); cartAction(<?= htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8') ?>, true);" 
                                class="flex-grow bg-ep-orange text-white text-[11px] font-bold py-3 rounded-xl shadow-lg shadow-ep-orange/10 hover:bg-slate-800 transition-all active:scale-95 uppercase tracking-wide">
                            Beli
                        </button>
                        <button type="button" 
                                onclick="event.stopPropagation(); cartAction(<?= htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8') ?>, false);" 
                                class="flex-none border border-slate-200 bg-white text-slate-400 w-11 h-11 rounded-xl hover:border-ep-green hover:text-ep-green transition-all shadow-sm active:scale-95 flex items-center justify-center">
                            <i class="fas fa-cart-plus text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- TOAST CONTAINER LAYER -->
<div id="toast-container" class="fixed bottom-8 right-8 z-[110] flex flex-col gap-4 pointer-events-none"></div>

<!-- MODAL BOX -->
<div id="modal" class="fixed inset-0 bg-slate-900/60 z-[100] hidden items-center justify-center p-4 backdrop-blur-md" onclick="closeOnOverlay(event)">
    <div class="bg-white max-w-xl w-full rounded-3xl overflow-hidden flex flex-col sm:flex-row relative shadow-2xl animate-fade-in">
        <button onclick="tutupModal()" class="absolute top-4 right-4 w-9 h-9 flex items-center justify-center bg-slate-100 text-slate-500 rounded-full hover:bg-red-50 hover:text-red-500 transition-all z-10 text-xs">
            <i class="fas fa-times"></i>
        </button>
        <div class="w-full sm:w-5/12 bg-slate-50 p-8 flex items-center justify-center">
            <!-- PERBAIKAN: Menambahkan fallback onerror dan mempertahankan properti object-cover -->
            <img id="md-img" src="" onerror="this.src='https://placehold.co/400x600?text=No+Image'" class="h-60 object-cover shadow-2xl rounded-xl transition-all duration-500">
        </div>
        <div class="p-8 sm:w-7/12 flex flex-col">
            <span class="text-[9px] font-black text-ep-green uppercase tracking-widest mb-1.5">Katalog Detail</span>
            <h2 id="md-title" class="text-xl font-bold text-slate-900 leading-tight mb-1"></h2>
            <p id="md-author" class="text-slate-400 text-xs mb-4 font-semibold"></p>
            <div class="mb-4 bg-slate-50 p-3 rounded-xl border border-slate-100">
                <span class="text-slate-400 text-[10px] uppercase font-bold tracking-wider block mb-0.5">Akses Premium</span>
                <span id="md-price" class="text-2xl font-black text-ep-green"></span>
            </div>
            <p id="md-desc" class="text-slate-600 text-xs leading-relaxed mb-6 line-clamp-3"></p>
            <div class="mt-auto flex gap-2">
                <button id="modal-buy-btn" class="flex-grow bg-ep-orange text-white py-3.5 rounded-xl font-bold shadow-lg shadow-ep-orange/20 hover:bg-slate-800 transition-all active:scale-95 flex items-center justify-center gap-2 text-xs tracking-wide">
                    <i class="fas fa-shopping-bag"></i> BELI SEKARANG
                </button>
                <button id="modal-cart-btn" class="flex-none border border-slate-200 bg-white text-slate-400 w-12 rounded-xl hover:border-ep-green hover:text-ep-green transition-all shadow-sm active:scale-95 flex items-center justify-center">
                    <i class="fas fa-cart-plus text-base"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Injeksi Konstan dari PHP Context Environment
    const BOOK_IMAGE_PATH = "<?= BOOK_IMAGE_PATH; ?>";
    const CURRENT_USER = "<?= htmlspecialchars($this->session->userdata('username') ?? 'guest'); ?>"; 
    const LOGIN_URL = "<?= base_url('login'); ?>";
    const KERANJANG_URL = "<?= base_url('keranjang'); ?>"; 
    const STORAGE_KEY = `cart_storage_${CURRENT_USER}`;

    // PERBAIKAN: Refaktor penuh showToast dengan Animasi Masuk & Progress Bar hitung mundur
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toastId = 'toast-' + Date.now();
        const colorClass = type === 'success' ? 'border-ep-green text-ep-green' : 'border-ep-orange text-ep-orange';
        const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-info-circle';
        
        const toastHTML = `
            <div id="${toastId}" class="pointer-events-auto flex items-center gap-4 bg-white border-l-4 ${colorClass} p-4 pr-10 rounded-2xl shadow-xl animate-slide-in relative overflow-hidden min-w-[320px]">
                <div class="flex-none w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center text-sm">
                    <i class="fas ${iconClass}"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">E-Pustaka System</p>
                    <p class="text-xs font-bold text-slate-700">${message}</p>
                </div>
                <div class="absolute bottom-0 left-0 h-1 bg-slate-100 w-full">
                    <div class="h-full bg-current opacity-20 transition-all duration-[2500ms] ease-linear w-full" id="progress-${toastId}"></div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', toastHTML);
        
        setTimeout(() => {
            const pb = document.getElementById(`progress-${toastId}`);
            if(pb) pb.style.width = '0%';
        }, 10);

        const toastElement = document.getElementById(toastId);
        setTimeout(() => {
            if(toastElement) {
                toastElement.classList.add('opacity-0', 'translate-x-10', 'transition-all', 'duration-500');
                setTimeout(() => toastElement.remove(), 500);
            }
        }, 2500);
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
            setTimeout(() => {
                window.location.href = KERANJANG_URL;
            }, 100);
        }
    }

    // PERBAIKAN: Intersepting string concatenation antara base path folder dan properti file gambar objek
    function bukaModal(buku) {
        document.getElementById('md-img').src = BOOK_IMAGE_PATH + buku.gambar;
        document.getElementById('md-title').innerText = buku.judul_buku;
        document.getElementById('md-author').innerText = 'Karya ' + buku.penulis;
        document.getElementById('md-desc').innerText = buku.deskripsi || 'Tidak ada deskripsi tersedia untuk e-book ini.';
        
        const hargaIDR = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(buku.harga);
        
        document.getElementById('md-price').innerText = hargaIDR;
        
        document.getElementById('modal-buy-btn').onclick = function() { cartAction(buku, true); };
        document.getElementById('modal-cart-btn').onclick = function() { cartAction(buku, false); };
        
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