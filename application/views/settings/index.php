<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil & Keamanan</title>
</head>
<body class="h-full flex flex-col bg-[#F8F9FA] text-[#2C3E50] font-sans antialiased overflow-hidden">

    <?php $this->load->view('components/navbar'); ?>
    
    <div class="flex-1 flex flex-col overflow-hidden w-full">
        
        <main class="flex-1 overflow-y-auto py-6 px-4 sm:px-6 md:px-10 lg:px-16 w-full">
            <div class="max-w-[1600px] mx-auto w-full space-y-6">
                
                <div class="border-b border-slate-200/60 pb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-black text-[#2C3E50] tracking-tight">
                            Pengaturan <span class="text-[#0E6D64]">Profil & Keamanan</span>
                        </h1>
                        <p class="text-[#2C3E50]/60 mt-1 text-xs md:text-sm font-medium">Kelola informasi kredensial data diri dan konfigurasi keamanan akun Anda.</p>
                    </div>
                </div>
        
                <?php if($this->session->flashdata('success')): ?>
                    <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl font-bold text-sm flex items-center shadow-sm transition-all">
                        <i class="fa-solid fa-circle-check mr-3 text-emerald-500 text-base"></i>
                        <?= $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>
                
                <?php if($this->session->flashdata('error')): ?>
                    <div class="p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl font-bold text-sm flex items-center shadow-sm transition-all">
                        <i class="fa-solid fa-circle-exclamation mr-3 text-red-500 text-base"></i>
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
        
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start w-full">
                    
                    <div class="lg:col-span-4 xl:col-span-3 w-full bg-white border border-[#2C3E50]/10 p-6 rounded-2xl shadow-sm text-center flex-shrink-0">
                        <div class="w-20 h-20 bg-[#0E6D64] text-white rounded-2xl flex items-center justify-center mx-auto text-3xl font-black uppercase tracking-wider shadow-lg shadow-[#0E6D64]/20 mb-4">
                            <?= substr($this->session->userdata('username'), 0, 1); ?>
                        </div>
                        <h2 class="text-lg font-black text-[#2C3E50] truncate">
                            <?= htmlspecialchars($this->session->userdata('username')); ?>
                        </h2>
                        <p class="text-xs font-semibold text-slate-400 mt-0.5 truncate"><?= htmlspecialchars($user->email); ?></p>
                        
                        
                    </div>
        
                    <div class="lg:col-span-8 xl:col-span-9 w-full bg-white border border-[#2C3E50]/10 p-6 md:p-8 rounded-2xl shadow-sm">
                        <form action="<?= base_url('settings/update'); ?>" method="POST" class="space-y-6">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="w-full">
                                    <label class="block text-xs font-black uppercase tracking-wider text-[#2C3E50]/60 mb-2">Nama Lengkap</label>
                                    <div class="relative w-full">
                                        <input type="text" name="name" value="<?= htmlspecialchars($user->name); ?>" 
                                            class="w-full pl-11 pr-4 py-3 bg-[#F8F9FA] border border-[#2C3E50]/10 rounded-xl text-sm font-semibold text-[#2C3E50] focus:outline-none focus:ring-4 focus:ring-[#0E6D64]/10 focus:border-[#0E6D64] focus:bg-white transition-all duration-300" required>
                                        <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                    </div>
                                </div>
        
                                <div class="w-full">
                                    <label class="block text-xs font-black uppercase tracking-wider text-[#2C3E50]/60 mb-2">Alamat Email</label>
                                    <div class="relative w-full">
                                        <input type="email" name="email" value="<?= htmlspecialchars($user->email); ?>" 
                                            class="w-full pl-11 pr-4 py-3 bg-[#F8F9FA] border border-[#2C3E50]/10 rounded-xl text-sm font-semibold text-[#2C3E50] focus:outline-none focus:ring-4 focus:ring-[#0E6D64]/10 focus:border-[#0E6D64] focus:bg-white transition-all duration-300" required>
                                        <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                    </div>
                                </div>
                            </div>
        
                            <div class="py-2">
                                <hr class="border-slate-100">
                            </div>
        
                            <div class="w-full">
                                <label class="block text-xs font-black uppercase tracking-wider text-[#2C3E50]/60 mb-2">Password Baru</label>
                                <div class="relative w-full">
                                    <input type="password" name="password" placeholder="••••••••" 
                                        class="w-full pl-11 pr-4 py-3 bg-[#F8F9FA] border border-[#2C3E50]/10 rounded-xl text-sm font-semibold text-[#2C3E50] focus:outline-none focus:ring-4 focus:ring-[#0E6D64]/10 focus:border-[#0E6D64] focus:bg-white transition-all duration-300">
                                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                </div>
                                <p class="text-[11px] text-[#2C3E50]/40 mt-2 font-medium leading-relaxed">
                                    <i class="fa-solid fa-circle-info mr-1 text-[#0E6D64]"></i> Biarkan kolom ini kosong jika Anda tidak berniat memperbarui kata sandi saat ini.
                                </p>
                            </div>
        
                            <div class="pt-4 flex justify-end w-full">
                                <button type="submit" 
                                    class="w-full sm:w-auto px-10 py-3.5 bg-[#0E6D64] hover:bg-[#084d46] text-white text-xs font-black rounded-xl transition-all shadow-md shadow-[#0E6D64]/10 active:scale-[0.98] uppercase tracking-wider">
                                    Simpan Perubahan
                                </button>
                            </div>
        
                        </form>
                    </div>
        
                </div>
                
                
                
            </main>
        </div>
        <?php $this->load->view('components/Footer'); ?>

</body>
</html>