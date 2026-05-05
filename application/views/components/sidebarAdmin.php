<!-- Sidebar: Dark & Elegant -->

<?php
$session = $this->session->all_userdata();
?>
<aside class="w-64 bg-slate-900 flex flex-col transition-all duration-300">
    <div class="p-8">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/30">
                <span class="text-white font-bold text-xl">B</span>
            </div>
            <h1 class="text-lg font-bold tracking-tight text-white uppercase">E-Book<span class="text-indigo-400">Store</span></h1>
        </div>
    </div>

    <nav class="flex-1 px-4 space-y-2 mt-4">
        <p class="px-4 text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-2">Main Menu</p>
        
        <a href="<?= base_url('dashboard') ?>" class="flex items-center px-4 py-3 text-sm font-medium <?= ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') ? 'bg-indigo-600 text-white shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?> rounded-xl shadow-md transition-all">
            Dashboard
        </a>
        
        <a href="<?= base_url('DaftarBuku') ?>" class="flex items-center px-4 py-3 text-sm font-medium <?= ($this->uri->segment(1) == 'DaftarBuku') ? 'bg-indigo-600 text-white shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?> rounded-xl transition-all group">
            Daftar Buku
        </a>
        
        <a href="<?= base_url('DaftarUser') ?>" class="flex items-center px-4 py-3 text-sm font-medium group <?= ($this->uri->segment(1) == 'DaftarUser') ? 'bg-indigo-600 text-white shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?> text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl transition-all">
            Daftar User
        </a>
        
        <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 rounded-xl transition-all">
            Transactions
        </a>
    </nav>

    <div class="p-4 m-4 bg-slate-800/50 rounded-2xl border border-slate-700/50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold shadow-inner">
                <?= strtoupper(substr($session['username'] ?? 'U', 0, 1)) ?>
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-semibold text-white truncate capitalize"><?= $session['username'] ?? 'Guest'?></p>
                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter"><?= $session['role'] ?? 'No Role' ?></p>
            </div>
        </div>
    </div>
</aside>