<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BookStore | Edit Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="h-full bg-[#fbfcfd] text-slate-900 antialiased">

    <div class="flex min-h-screen">
        <?php $this->load->view('components/sidebarAdmin'); ?>

        <main class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200/60 flex items-center justify-between px-10 sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <a href="<?= base_url('DaftarUser') ?>" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Edit Profil: <?= html_escape($users->name) ?></h2>
                </div>
            </header>

            <section class="p-8 lg:p-12">
                <div class="max-w-4xl mx-auto">
                    <!-- Alert Notifications -->
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="mb-6 flex items-center p-4 text-emerald-800 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl shadow-sm">
                            <div class="ml-3 text-sm font-semibold italic"><?= $this->session->flashdata('success'); ?></div>
                        </div>
                    <?php endif; ?>

                    <div class="bg-white border border-slate-200/60 rounded-[2rem] shadow-sm overflow-hidden">
                        <div class="p-8 md:p-12">
                            <?= form_open_multipart('DaftarUser/update_user/' . $users->id); ?>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Input Nama -->
                                <div class="md:col-span-2 space-y-2">
                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap</label>
                                    <input type="text" name="name" 
                                           value="<?= set_value('name', $users->name) ?>" 
                                           class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                                           placeholder="Masukkan nama lengkap">
                                    <?= form_error('name', '<small class="text-rose-500 font-medium ml-2">', '</small>'); ?>
                                </div>

                                <!-- Input Email -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Alamat Email</label>
                                    <input type="email" name="email" 
                                           value="<?= set_value('email', $users->email) ?>" 
                                           class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                                           placeholder="email@contoh.com">
                                    <?= form_error('email', '<small class="text-rose-500 font-medium ml-2">', '</small>'); ?>
                                </div>

                                <!-- Select Role -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Hak Akses (Role)</label>
                                    <div class="relative">
                                        <select name="role" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all appearance-none">
                                            <option value="user" <?= $users->role == 'user' ? 'selected' : '' ?>>User (Pelanggan)</option>
                                            <option value="admin" <?= $users->role == 'admin' ? 'selected' : '' ?>>Admin (Pengelola)</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-12 flex items-center justify-end gap-6 border-t border-slate-100 pt-8">
                                <a href="<?= base_url('DaftarUser') ?>" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">
                                    Batal
                                </a>
                                <button type="submit" class="px-10 py-4 bg-indigo-600 text-white text-sm font-bold rounded-2xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all active:scale-95">
                                    Simpan Perubahan
                                </button>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>