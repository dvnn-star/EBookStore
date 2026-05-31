<?php $old = $this->session->flashdata('old_input'); ?>
<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA | Tambah Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-[#F8F9FA] text-[#2C3E50] antialiased">

    <div class="flex min-h-screen">
        <?php $this->load->view('components/sidebarAdmin'); ?>

        <main class="flex-1 flex flex-col">
            <header class="h-20 bg-[#FFFFFF] border-b border-[#2C3E50]/20 flex items-center justify-between px-10 sticky top-0 z-10 shadow-sm">
                <div class="flex items-center gap-4">
                    <a href="<?= base_url('DaftarUser') ?>" class="p-2 text-[#E67E22] hover:text-[#D35400] hover:bg-[#E67E22]/10 rounded-xl transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <h2 class="text-xl font-bold text-[#005B52] tracking-tight">Registrasi Pengguna Baru</h2>
                </div>
            </header>

            <section class="p-8 lg:p-12">
                <div class="max-w-4xl mx-auto">

                    <div class="bg-[#FFFFFF] border border-[#2C3E50]/20 rounded-[2.5rem] shadow-md overflow-hidden">
                        <div class="p-10 md:p-14">
                            <div class="mb-10">
                                <h3 class="text-lg font-bold text-[#005B52]">Informasi Kredensial</h3>
                                <p class="text-sm text-[#2C3E50] font-medium opacity-90">Pastikan alamat email aktif dan gunakan password yang kuat.</p>
                            </div>
                            <?php if ($this->session->flashdata('success')) : ?>
                                <?= $this->session->flashdata('success'); ?>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('error')) : ?>
                                <p class="text-xl text-red-600 font-serif font-bold"><?=  $this->session->flashdata('error'); ?></p>
                            <?php endif; ?>
                            
                            <?= form_open('DaftarUser/admin/StoreUser'); ?>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                <div class="md:col-span-2 space-y-2">
                                    <label class="text-[10px] font-black text-[#2C3E50] uppercase tracking-widest ml-1">Nama Lengkap</label>
                                    <input type="text" name="name" value="<?= isset($old['name']) ? html_escape($old['name']) : '' ?>"
                                        class="w-full px-5 py-4 bg-[#F8F9FA] border border-[#2C3E50]/40 rounded-2xl focus:ring-4 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] font-semibold placeholder-[#2C3E50]/50 outline-none transition-all"
                                        placeholder="Contoh: John Doe"
                                        required>
                                    <?= form_error('name', '<p class="text-xs text-rose-600 font-bold mt-1 ml-1">', '</p>'); ?>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-[#2C3E50] uppercase tracking-widest ml-1">Alamat Email</label>
                                    <input type="email" name="email" value="<?= isset($old['email']) ? html_escape($old['email']) : '' ?>"
                                        class="w-full px-5 py-4 bg-[#F8F9FA] border border-[#2C3E50]/40 rounded-2xl focus:ring-4 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] font-semibold placeholder-[#2C3E50]/50 outline-none transition-all"
                                        placeholder="nama@email.com">
                                    <?= form_error('email', '<p class="text-xs text-rose-600 font-bold mt-1 ml-1">', '</p>'); ?>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-[#2C3E50] uppercase tracking-widest ml-1">Hak Akses</label>
                                    <div class="relative">
                                        <select name="role" class="w-full px-5 py-4 bg-[#F8F9FA] border border-[#2C3E50]/40 rounded-2xl focus:ring-4 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] font-semibold outline-none appearance-none transition-all">
                                            <option value="user">User (Customer)</option>
                                            <option value="admin">Administrator</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-[#2C3E50]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-[#2C3E50] uppercase tracking-widest ml-1">Password</label>
                                    <input type="password" name="password"
                                        class="w-full px-5 py-4 bg-[#F8F9FA] border border-[#2C3E50]/40 rounded-2xl focus:ring-4 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] font-semibold placeholder-[#2C3E50]/50 outline-none transition-all"
                                        placeholder="••••••••"
                                        required>
                                    <?= form_error('password', '<p class="text-xs text-rose-600 font-bold mt-1 ml-1">', '</p>'); ?>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-[#2C3E50] uppercase tracking-widest ml-1">Ulangi Password</label>
                                    <input type="password" name="confirm_password"
                                        class="w-full px-5 py-4 bg-[#F8F9FA] border border-[#2C3E50]/40 rounded-2xl focus:ring-4 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] font-semibold placeholder-[#2C3E50]/50 outline-none transition-all"
                                        placeholder="••••••••"
                                        required>
                                    <?= form_error('confirm_password', '<p class="text-xs text-rose-600 font-bold mt-1 ml-1">', '</p>'); ?>
                                </div>
                            </div>

                            <div class="mt-14 flex items-center justify-end gap-6 border-t border-[#2C3E50]/10 pt-10">
                                <a href="<?= base_url('DaftarUser') ?>" class="text-sm font-bold text-[#2C3E50]/70 hover:text-[#2C3E50] transition-colors">
                                    Batalkan
                                </a>
                                <button type="submit" class="px-12 py-4 bg-[#005B52] text-white text-sm font-bold rounded-xl hover:bg-[#00443d] shadow-xl shadow-[#005B52]/20 transition-all active:scale-95">
                                    Simpan Pengguna
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