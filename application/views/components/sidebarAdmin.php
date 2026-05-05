<!-- Sidebar: Dark & Elegant -->
<?php
// Pastikan variabel konsisten. Saya gunakan $session (tunggal).
$session = $this->session->all_userdata();
?>
<aside class="w-64 bg-slate-900 flex flex-col transition-all duration-300">
    <!-- Logo Section -->
    <div class="p-8">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/30">
                <span class="text-white font-bold text-xl">B</span>
            </div>
            <h1 class="text-lg font-bold tracking-tight text-white uppercase">E-Book<span class="text-indigo-400">Store</span></h1>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 space-y-2 mt-4">
        <p class="px-4 text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-2">Main Menu</p>

        <a href="<?= base_url('dashboard') ?>" class="flex items-center px-4 py-3 text-sm font-medium <?= ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?> rounded-xl transition-all">
            Dashboard
        </a>

        <a href="<?= base_url('DaftarBuku') ?>" class="flex items-center px-4 py-3 text-sm font-medium <?= ($this->uri->segment(1) == 'DaftarBuku') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?> rounded-xl transition-all">
            Daftar Buku
        </a>

        <a href="<?= base_url('DaftarUser') ?>" class="flex items-center px-4 py-3 text-sm font-medium <?= ($this->uri->segment(1) == 'DaftarUser') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?> rounded-xl transition-all">
            Daftar User
        </a>

        <a href="<?= base_url('DaftarTransactions') ?>" class="flex items-center px-4 py-3 text-sm font-medium <?= ($this->uri->segment(1) == 'DaftarTransactions') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?> rounded-xl transition-all">
            Transactions
        </a>
    </nav>

    <!-- User Profile & Dropup Section -->
    <div class="relative p-4 m-4 bg-slate-800/50 rounded-2xl border border-slate-700/50 group cursor-pointer hover:bg-slate-800 transition-all duration-300">
        
        <!-- Dropup Menu Content -->
        <div class="absolute bottom-full left-0 w-full mb-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50">
            <div class="bg-slate-800 border border-slate-700 rounded-xl shadow-2xl py-2 flex flex-col overflow-hidden">
          
                <div class="h-px bg-slate-700/50 my-1"></div>
                <a href="<?= base_url('auth/logout') ?>"  class="px-4 py-2.5 text-sm text-rose-400 hover:text-rose-300 hover:bg-slate-700 transition-colors flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </a>
            </div>
        </div>

        <!-- Visible Trigger (Avatar & Name) -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold shadow-inner shrink-0">
                <?= strtoupper(substr($session['username'] ?? 'U', 0, 1)) ?>
            </div>
            <div class="overflow-hidden flex-1">
                <p class="text-sm font-semibold text-white truncate capitalize"><?= $session['username'] ?? 'Guest' ?></p>
                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter"><?= $session['role'] ?? 'No Role' ?></p>
            </div>
            <div class="text-slate-500 shrink-0 group-hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-y-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            </div>
        </div>
    </div>
</aside>