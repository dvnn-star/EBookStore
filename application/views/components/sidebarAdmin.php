<?php
// Pastikan variabel konsisten menggunakan $session (tunggal).
$session = $this->session->all_userdata();
?>
<aside class="w-64 h-screen bg-white flex flex-col justify-between border-r border-neutral-200 sticky top-0 left-0 z-40 shrink-0 overflow-y-auto">
    <div class="flex flex-col flex-1 min-h-0">
        <div class="p-6 md:p-8 border-b border-neutral-100 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-[#005B52] rounded-lg flex items-center justify-center shadow-lg shadow-[#005B52]/20">
                    <span class="text-white font-bold text-xl">B</span>
                </div>
                <h1 class="text-lg font-black tracking-tight text-[#1F2937] uppercase">E-Book<span class="text-[#005B52]">Store</span></h1>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 overflow-y-auto space-y-1.5 sub-scroll">
            <p class="px-4 text-[10px] font-bold text-neutral-500 uppercase tracking-widest mb-3">Main Menu</p>

            <a href="<?= base_url('dashboard') ?>" class="flex items-center px-4 py-3 text-sm font-bold <?= ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') ? 'bg-[#005B52] text-white shadow-md shadow-[#005B52]/10' : 'text-neutral-600 hover:text-[#005B52] hover:bg-neutral-50' ?> rounded-xl transition-all">
                Dashboard
            </a>

            <a href="<?= base_url('DaftarBuku') ?>" class="flex items-center px-4 py-3 text-sm font-bold <?= ($this->uri->segment(1) == 'DaftarBuku') ? 'bg-[#005B52] text-white shadow-md shadow-[#005B52]/10' : 'text-neutral-600 hover:text-[#005B52] hover:bg-neutral-50' ?> rounded-xl transition-all">
                Daftar Buku
            </a>

            <a href="<?= base_url('DaftarUser') ?>" class="flex items-center px-4 py-3 text-sm font-bold <?= ($this->uri->segment(1) == 'DaftarUser') ? 'bg-[#005B52] text-white shadow-md shadow-[#005B52]/10' : 'text-neutral-600 hover:text-[#005B52] hover:bg-neutral-50' ?> rounded-xl transition-all">
                Daftar User
            </a>

            <a href="<?= base_url('DaftarTransactions') ?>" class="flex items-center px-4 py-3 text-sm font-bold <?= ($this->uri->segment(1) == 'DaftarTransactions') ? 'bg-[#005B52] text-white shadow-md shadow-[#005B52]/10' : 'text-neutral-600 hover:text-[#005B52] hover:bg-neutral-50' ?> rounded-xl transition-all">
                Transactions
            </a>
        </nav>
    </div>

    <div class="p-4 border-t border-neutral-100 bg-white shrink-0">
        <div class="relative p-4 bg-neutral-50 rounded-2xl border-2 border-[#005B52]/20 group cursor-pointer hover:bg-[#005B52]/5 hover:border-[#005B52]/40 transition-all duration-300">
            
            <div class="absolute bottom-full left-0 w-full mb-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50">
                <div class="bg-white border border-neutral-200 rounded-xl shadow-xl py-1 overflow-hidden">
                    <a href="<?= base_url('auth/logout') ?>" class="px-4 py-2.5 text-sm font-extrabold text-rose-600 hover:bg-rose-50 transition-colors flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#FF8A00] flex items-center justify-center text-white font-black shadow-md shadow-[#FF8A00]/20 shrink-0 text-lg">
                    <?= strtoupper(substr($session['username'] ?? 'U', 0, 1)) ?>
                </div>
                <div class="overflow-hidden flex-1">
                    <p class="text-sm font-extrabold text-[#1F2937] truncate capitalize tracking-wide"><?= $session['username'] ?? 'Guest' ?></p>
                    <p class="text-[10px] text-neutral-600 font-extrabold uppercase tracking-wider mt-0.5"><?= $session['role'] ?? 'No Role' ?></p>
                </div>
                <div class="text-neutral-600 shrink-0 group-hover:text-[#005B52] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</aside>