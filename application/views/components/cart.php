<!-- Container Utama: Layout Sidebar-Content -->
<div class="container mx-auto px-4 py-12 flex flex-col lg:flex-row gap-10 min-h-[70vh]">
    <!-- AREA KONTEN UTAMA (DAFTAR ITEM) -->
    <div class="flex-grow">
        <header class="mb-10">
            <h1 class="text-4xl font-black text-slate-800 tracking-tight flex items-center gap-4">
                <i class="fas fa-shopping-basket text-ep-green"></i> Keranjang Anda
            </h1>
            <div class="h-1.5 w-20 bg-ep-orange mt-3 rounded-full"></div>
        </header>

        <!-- Container Dinamis untuk Item Keranjang -->
        <div id="cart-items-wrapper" class="space-y-4">
            <!-- Data di-render via JavaScript -->
            <div class="animate-pulse space-y-4">
                <div class="h-28 bg-slate-100 rounded-3xl"></div>
                <div class="h-28 bg-slate-100 rounded-3xl"></div>
            </div>
        </div>
    </div>

    <!-- AREA RINGKASAN (SIDEBAR) -->
    <aside class="w-full lg:w-96 flex-shrink-0">
        <div class="sticky top-28 bg-white p-8 rounded-3xl shadow-xl border border-slate-100">
            <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                <i class="fas fa-file-invoice-dollar text-ep-green"></i> Ringkasan
            </h3>
            <div class="space-y-4 pb-6 border-b border-slate-100">
                <div class="flex justify-between text-slate-500">
                    <span>Subtotal</span>
                    <span id="subtotal-val" class="font-bold text-slate-700">Rp0</span>
                </div>
                <div class="flex justify-between text-slate-400 text-xs tracking-wide">
                    <span>Pajak & Biaya Layanan</span>
                    <span class="italic text-ep-green uppercase font-black">Free</span>
                </div>
            </div>
            <div class="py-6 flex justify-between items-center">
                <span class="font-bold text-slate-800">Total Harga</span>
                <span id="grand-total-val" class="text-2xl font-black text-ep-green tracking-tighter">Rp0</span>
            </div>
            <button id="checkout-trigger" onclick="handleCheckout()" class="w-full bg-orange-500 text-white py-4 rounded-2xl font-extrabold shadow-lg shadow-ep-orange/30 hover:bg-orange-600 transition-all duration-300 active:scale-95 flex items-center justify-center gap-3">
                CHECKOUT SEKARANG <i class="fas fa-lock text-sm"></i>
            </button>
        </div>
    </aside>
</div>

<!-- TOAST CONTAINER -->
<div id="toast-container" class="fixed bottom-10 right-10 z-[110] flex flex-col gap-4 pointer-events-none"></div>

<script>
    /**
     * CONFIG & STATE IDENTITY
     */
    const USERNAME = "<?= htmlspecialchars($this->session->userdata('username') ?? 'guest'); ?>";
    const CART_KEY = `cart_storage_${USERNAME}`;
    const CSRF_NAME = "<?= $this->security->get_csrf_token_name(); ?>";
    const CSRF_HASH = "<?= $this->security->get_csrf_hash(); ?>";

    /**
     * UI COMPONENT: HIGH-CONTRAST TOAST NOTIFICATION
     * Menggunakan strategi Polymorphic Style Mapping untuk mengubah skema warna secara total
     * berdasarkan tingkat urgensi atau jenis destruksi aksi (seperti penghapusan item).
     */
    function showToast(message, type = 'success', duration = 3000) {
        const container = document.getElementById('toast-container');
        const toastId = 'toast-' + Date.now();

        // Matrix tema untuk memberikan diferensiasi visual yang kontras tinggi di viewport
        const themes = {
            success: {
                bg: 'bg-white',
                border: 'border-l-4 border-ep-green',
                text: 'text-slate-700',
                meta: 'text-slate-400',
                iconWrapper: 'bg-emerald-50 text-ep-green',
                icon: 'fa-check'
            },
            info: { // Dikonfigurasi khusus untuk aksi penghapusan item (Destructive Alert)
                bg: 'bg-slate-950',          // Latar belakang gelap pekat untuk kontras maksimal di atas halaman putih
                border: 'border-l-4 border-red-500', // Batas kiri merah menyala sebagai indikator warning
                text: 'text-white',          // Teks putih murni untuk keterbacaan tingkat tinggi (WCAG AAA Compliant)
                meta: 'text-red-400 font-bold',
                iconWrapper: 'bg-red-950/50 text-red-400',
                icon: 'fa-trash-alt'          // Mengubah ikon menjadi representasi tempat sampah
            },
            error: {
                bg: 'bg-red-900',
                border: 'border-l-4 border-red-700',
                text: 'text-white',
                meta: 'text-red-200',
                iconWrapper: 'bg-red-950 text-white',
                icon: 'fa-exclamation-triangle'
            }
        };

        const activeTheme = themes[type] || themes.success;

        const html = `
            <div id="${toastId}" class="pointer-events-auto flex items-center gap-4 ${activeTheme.bg} ${activeTheme.border} p-5 pr-10 rounded-2xl shadow-2xl animate-fade-in relative overflow-hidden min-w-[320px]">
                <div class="flex-none w-10 h-10 ${activeTheme.iconWrapper} rounded-full flex items-center justify-center">
                    <i class="fas ${activeTheme.icon}"></i>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-widest mb-0.5 ${activeTheme.meta}">System Message</p>
                    <p class="text-sm font-bold ${activeTheme.text}">${message}</p>
                </div>
                <div class="absolute bottom-0 left-0 h-1 bg-slate-100/10 w-full">
                    <div class="h-full bg-current opacity-30 transition-all ease-linear w-full" id="progress-${toastId}" style="transition-duration: ${duration}ms"></div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        
        // Sinkronisasi animasi progress bar penyusutan waktu
        setTimeout(() => {
            const pb = document.getElementById(`progress-${toastId}`);
            if (pb) pb.style.width = '0%';
        }, 10);

        // Alur penghapusan komponen dari hirarki pohon DOM (Garbage Collection)
        setTimeout(() => {
            const el = document.getElementById(toastId);
            if (el) {
                el.classList.add('opacity-0', 'translate-x-10', 'transition-all', 'duration-500');
                setTimeout(() => el.remove(), 500);
            }
        }, duration);
    }

    /**
     * CART ENGINE (BUSINESS LOGIC)
     */
    const CartEngine = {
        getRawData: function() {
            return JSON.parse(localStorage.getItem(CART_KEY)) || [];
        },

        removeItem: function(id, judul) {
            let current = this.getRawData();
            let updated = current.filter(item => item.id != id);
            localStorage.setItem(CART_KEY, JSON.stringify(updated));
            this.render();
            
            // Memicu toast dengan parameter 'info' yang kini telah dikonfigurasi berlatar gelap kontras tinggi
            showToast(`${judul} dihapus dari keranjang.`, 'info');
        },

        formatIDR: function(num) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(num);
        },

        render: function() {
            const container = document.getElementById('cart-items-wrapper');
            const data = this.getRawData();

            if (data.length === 0) {
                container.innerHTML = this.templateEmpty();
                this.updatePricing(0);
                document.getElementById('checkout-trigger').style.display = 'none';
                return;
            }

            let html = '';
            let total = 0;
            data.forEach(item => {
                total += parseInt(item.harga);
                html += this.templateItem(item);
            });

            container.innerHTML = html;
            this.updatePricing(total);
            document.getElementById('checkout-trigger').style.display = 'flex';
        },

        updatePricing: function(total) {
            document.getElementById('subtotal-val').innerText = this.formatIDR(total);
            document.getElementById('grand-total-val').innerText = this.formatIDR(total);
        },

        templateItem: function(item) {
            const safeTitle = item.judul_buku.replace(/'/g, "\\'");
            return `
                <div class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-6 group hover:border-ep-green transition-all duration-300">
                    <img src="${item.gambar}" class="w-20 h-28 object-cover rounded-xl shadow-md group-hover:scale-105 transition-transform" alt="${item.judul_buku}">
                    <div class="flex-grow">
                        <span class="text-[9px] font-black text-ep-green uppercase tracking-[0.2em] mb-1 block">${item.kategori || 'Digital Book'}</span>
                        <h4 class="font-bold text-slate-800 leading-tight">${item.judul_buku}</h4>
                        <p class="text-xs text-slate-400 mt-1">${item.penulis}</p>
                        <div class="mt-4 font-black text-slate-900">${this.formatIDR(item.harga)}</div>
                    </div>
                    <button onclick="CartEngine.removeItem('${item.id}', '${safeTitle}')" 
                            class="px-6 py-2.5 bg-[#e52828] hover:bg-red-700 text-white text-sm font-bold rounded-full shadow-lg shadow-red-500/30 transition-all active:scale-95 flex items-center justify-center min-w-[90px]">
                        Hapus
                    </button>
                </div>
            `;
        },

        templateEmpty: function() {
            return `
                <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-slate-100">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-200">
                        <i class="fas fa-shopping-basket text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Keranjang Kosong</h3>
                    <p class="text-slate-400 text-sm mt-2">Anda belum menambahkan ebook ke keranjang.</p>
                    <a href="<?= base_url('kategori') ?>" class="inline-block mt-8 px-8 py-3 bg-orange-500 text-white rounded-xl font-bold hover:bg-orange-600 transition-all">Lihat Kategori</a>
                </div>
            `;
        }
    };

    /**
     * AJAX CHECKOUT LOGIC
     */
    async function handleCheckout() {
        const data = CartEngine.getRawData();
        if (data.length === 0) return;

        const btn = document.getElementById('checkout-trigger');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> MEMPROSES...';

        try {
            const response = await fetch('<?= base_url("transactions/create") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    [CSRF_NAME]: CSRF_HASH,
                    'cart_data': JSON.stringify(data.map(item=>({
                        'buku_id':item.id,
                        'qty' : 1
                    })))
                })
            });

            const result = await response.json();
            if (result.status === 'success') {
                localStorage.removeItem(CART_KEY);
                window.location.href = result.redirect_url;
            } else {
                throw new Error(result.message);
            }
        } catch (error) {
            showToast(error.message, 'error', 5000);
            btn.disabled = false;
            btn.innerHTML = 'CHECKOUT SEKARANG <i class="fas fa-lock text-sm"></i>';
        }
    }

    document.addEventListener('DOMContentLoaded', () => CartEngine.render());
</script>