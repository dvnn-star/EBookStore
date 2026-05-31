<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA - E-Book Terpopuler</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 'ep-green': '#0c6b63', 'ep-orange': '#f39c12' }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased">

<?php
// Data buku simulasi
$buku = isset($buku) ? $buku : [
    [
        'id' => 1,
        'judul_buku' => 'Membangun Arsitektur Web Modern dengan Tailwind CSS',
        'penulis' => 'Albert Einstein',
        'harga' => 145000,
        'rating' => 4,
        'gambar' => 'https://placehold.co/400x600?text=Web+Architecture',
        'deskripsi' => 'Panduan mendalam mengenai implementasi utilitas CSS untuk menghasilkan antarmuka modern yang responsif dan performan.'
    ],
    [
        'id' => 2,
        'judul_buku' => 'Prinsip Desain Antarmuka Berorientasi Pengguna',
        'penulis' => 'Grace Hopper',
        'harga' => 120000,
        'rating' => 5,
        'gambar' => 'https://placehold.co/400x600?text=UI+Design+Principles',
        'deskripsi' => 'Sebuah mahakarya yang membedah psikologi persepsi manusia dalam berinteraksi dengan sistem digital.'
    ]
];
?>

<div class="container mx-auto max-w-6xl px-4 py-12">
    
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-black text-slate-800 tracking-tight">E-Book Terpopuler Bulan Ini</h2>
        <div class="h-1 w-12 bg-ep-green mt-2 rounded-full mx-auto"></div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        <?php foreach ($buku as $book): ?>
            <div onclick='bukaModal(<?= htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8') ?>)' 
                 class="bg-white p-3.5 rounded-xl border border-slate-100 shadow-sm hover:shadow-lg hover:border-ep-green/20 transition-all duration-300 cursor-pointer group flex flex-col h-full">
                
                <div class="relative aspect-[3/4] mb-3.5 overflow-hidden rounded-lg bg-slate-100 shadow-inner flex justify-center items-center">
                    <img src="<?php echo $book['gambar']; ?>" 
                         onerror="this.src='https://placehold.co/400x600?text=No+Image'" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                         alt="<?php echo $book['judul_buku']; ?>">
                </div>

                <h4 class="font-bold text-slate-800 text-xs line-clamp-2 min-h-[2rem] leading-snug group-hover:text-ep-green transition-colors">
                    <?php echo $book['judul_buku']; ?>
                </h4>
                <p class="text-[11px] text-slate-400 mt-0.5 mb-3"><?php echo $book['penulis']; ?></p>
                
                <div class="mt-auto pt-3 border-t border-slate-50">
                    <div class="flex items-center justify-between mb-2.5">
                        <span class="font-extrabold text-sm text-ep-green">
                            Rp<?= number_format($book['harga'], 0, ',', '.') ?>
                        </span>
                        <div class="flex text-ep-orange text-[8px] gap-0.5">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="<?= ($i <= $book['rating'] ? 'fas' : 'far') ?> fa-star"></i>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="flex gap-1.5">
                        <button type="button" 
                                onclick="event.stopPropagation(); cartAction(<?= htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8') ?>, true);" 
                                class="flex-grow bg-ep-orange text-white text-[10px] font-bold py-2 rounded-lg shadow-md shadow-ep-orange/10 hover:bg-slate-800 transition-all active:scale-95 uppercase tracking-wide">
                            Beli
                        </button>
                        <button type="button" 
                                onclick="event.stopPropagation(); cartAction(<?= htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8') ?>, false);" 
                                class="flex-none border border-slate-200 bg-white text-slate-400 w-8 h-8 rounded-lg hover:border-ep-green hover:text-ep-green transition-all shadow-sm active:scale-95 flex items-center justify-center">
                            <i class="fas fa-cart-plus text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div id="toast-container" class="fixed bottom-6 right-6 z-[110] flex flex-col gap-3 pointer-events-none"></div>

<div id="modal" class="fixed inset-0 bg-slate-900/50 z-[100] hidden items-center justify-center p-4 backdrop-blur-sm" onclick="closeOnOverlay(event)">
    <div class="bg-white max-w-xl w-full rounded-2xl overflow-hidden flex flex-col sm:flex-row relative shadow-xl">
        <button onclick="tutupModal()" class="absolute top-3 right-3 w-8 h-8 flex items-center justify-center bg-slate-100 text-slate-500 rounded-full hover:bg-red-50 hover:text-red-500 transition-all z-10 text-xs">
            <i class="fas fa-times"></i>
        </button>
        <div class="w-full sm:w-5/12 bg-slate-50 p-6 flex items-center justify-center">
            <img id="md-img" src="" class="h-56 object-cover shadow-xl rounded-lg transition-transform duration-500">
        </div>
        <div class="p-6 sm:w-7/12 flex flex-col">
            <span class="text-[9px] font-black text-ep-green uppercase tracking-wider mb-1">Detail Produk</span>
            <h2 id="md-title" class="text-lg font-bold text-slate-900 leading-tight mb-1"></h2>
            <p id="md-author" class="text-slate-400 text-xs mb-3 font-medium"></p>
            <div class="mb-3">
                <span class="text-gray-400 text-[10px] block">Harga Produk:</span>
                <span id="md-price" class="text-xl font-black text-ep-green"></span>
            </div>
            <p id="md-desc" class="text-slate-600 text-xs leading-relaxed mb-5 line-clamp-3"></p>
            <div class="mt-auto flex gap-2">
                <button id="modal-buy-btn" class="flex-grow bg-ep-orange text-white py-2.5 rounded-xl font-bold shadow-md shadow-ep-orange/10 hover:bg-slate-800 transition-all active:scale-95 flex items-center justify-center gap-1.5 text-xs tracking-wide">
                    <i class="fas fa-shopping-bag"></i> BELI SEKARANG
                </button>
                <button id="modal-cart-btn" class="flex-none border border-slate-200 bg-white text-slate-400 w-11 rounded-xl hover:border-ep-green hover:text-ep-green transition-all shadow-sm active:scale-95 flex items-center justify-center">
                    <i class="fas fa-cart-plus text-sm"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Konfigurasi Autentikasi Ruang Penyimpanan Sistem & Routing URL
    const CURRENT_USER = "<?= htmlspecialchars($this->session->userdata('username') ?? 'guest'); ?>"; 
    const LOGIN_URL = "<?= base_url('login'); ?>";
    const KERANJANG_URL = "<?= base_url('keranjang'); ?>"; 
    const STORAGE_KEY = `cart_storage_${CURRENT_USER}`;

    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toastId = 'toast-' + Date.now();
        const colorClass = type === 'success' ? 'border-ep-green text-ep-green' : 'border-ep-orange text-ep-orange';
        const iconClass = type === 'success' ? 'fa-check' : 'fa-info-circle';
        
        const toastHTML = `
            <div id="${toastId}" class="pointer-events-auto flex items-center gap-3 bg-white border-l-4 ${colorClass} p-3.5 pr-8 rounded-xl shadow-lg relative overflow-hidden min-w-[280px]">
                <div class="flex-none w-8 h-8 bg-slate-50 rounded-full flex items-center justify-center text-xs">
                    <i class="fas ${iconClass}"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-wider mb-0.5">E-Pustaka System</p>
                    <p class="text-xs font-bold text-slate-700">${message}</p>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', toastHTML);
        const toastElement = document.getElementById(toastId);
        setTimeout(() => {
            toastElement.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => toastElement.remove(), 300);
        }, 2500);
    }

    function cartAction(dataBuku, isRedirect) {
        // Interupsi sistem keamanan jika pengguna bertindak sebagai Guest (Sesuai Kode Pertama)
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

        // Eksekusi Pemindahan Jalur Lokasi Halaman (Direct Redirect)
        if (isRedirect) {
            setTimeout(() => {
                window.location.href = KERANJANG_URL;
            }, 100);
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
        
        // Pemasangan handler aksi dinamis di dalam komponen modal
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