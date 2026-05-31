<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA | Daftar Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="<?= base_url('assets/vendor/sweetalert2/sweetalert2.min.js') ?>"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="h-full bg-[#F8F9FA] text-[#2C3E50] antialiased">

    <div class="flex min-h-screen">
        <?php $this->load->view('components/sidebarAdmin'); ?>
        <?php if ($this->session->flashdata('success')) : ?>
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil ditambahkan',
                    icon: 'success',
                    confirmButtonColor: '#005B52'
                });
            </script>
        <?php endif; ?>
        <?php if ($this->session->flashdata('perubahan')) : ?>
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil diubah',
                    icon: 'success',
                    confirmButtonColor: '#005B52'
                });
            </script>
        <?php endif; ?>

        <main class="flex-1 flex flex-col">
            <!-- Header (Pure White #FFFFFF dengan border tipis kontras) -->
            <header class="h-20 bg-[#FFFFFF] border-b border-[#2C3E50]/20 flex items-center justify-between px-10 sticky top-0 z-10 shadow-sm">
                <div>
                    <!-- Judul Utama menggunakan Deep Teal #005B52 -->
                    <h2 class="text-xl font-bold text-[#005B52] tracking-tight">Manajemen Pengguna</h2>
                    <p class="text-[11px] text-[#2C3E50] font-bold uppercase tracking-wider opacity-90">Otoritas Akses & Pengaturan Akun</p>
                </div>
                <!-- Tombol CTA Utama sesuai Spesifikasi Mandatori -->
                <a href="<?= base_url('DaftarUser/tambah_user') ?>" class="px-5 py-2.5 text-sm font-bold text-white bg-[#005B52] rounded-xl hover:bg-[#00443d] transition-all shadow-lg shadow-[#005B52]/20 flex items-center gap-2 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah User
                </a>
            </header>

            <section class="p-8 lg:p-10">
                <!-- Table Container (Background Pure White #FFFFFF) -->
                <div class="bg-[#FFFFFF] border border-[#2C3E50]/20 rounded-[2rem] shadow-md overflow-hidden">
                    <div class="px-8 py-5 border-b border-[#2C3E50]/20 bg-[#F8F9FA] flex justify-between items-center">
                        <h3 class="font-bold text-[#005B52] text-sm uppercase tracking-widest">Database Pengguna</h3>
                        <!-- Total Badge menggunakan Aksen Tambahan Vibrant Orange #E67E22 -->
                        <span class="px-3 py-1 bg-[#E67E22]/10 text-[#E67E22] text-[10px] font-bold rounded-lg border border-[#E67E22]/30">Total: <?= $total ?></span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[10px] uppercase tracking-[0.15em] text-[#2C3E50] font-black border-b border-[#2C3E50]/20 bg-[#F8F9FA]">
                                    <th class="px-8 py-4">Informasi User</th>
                                    <th class="px-8 py-4">Alamat Email</th>
                                    <th class="px-8 py-4">Status Akses</th>
                                    <th class="px-8 py-4 text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#2C3E50]/10">
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr class="group hover:bg-[#F8F9FA] transition-colors">
                                            <!-- Nama & ID -->
                                            <td class="px-8 py-5">
                                                <div class="flex flex-col">
                                                    <!-- Hover nama mengarah ke warna utama Deep Teal -->
                                                    <span class="text-sm font-bold text-[#2C3E50] group-hover:text-[#005B52] transition-colors"><?= html_escape($user->name) ?></span>
                                                    <span class="text-[10px] text-[#2C3E50]/70 font-mono tracking-tight font-semibold">UID: #<?= $user->id ?></span>
                                                </div>
                                            </td>

                                            <!-- Email -->
                                            <td class="px-8 py-5">
                                                <span class="text-sm text-[#2C3E50] font-semibold"><?= html_escape($user->email) ?></span>
                                            </td>

                                            <!-- Role Badge (Dinamis dengan penyesuaian kontras tinggi) -->
                                            <td class="px-8 py-5">
                                                <?php
                                                $isAdmin = (strtolower($user->role) === 'admin');
                                                // Admin menggunakan basis Deep Teal, User biasa menggunakan basis Emerald/Hijau Daun
                                                $roleStyles = $isAdmin
                                                    ? 'bg-[#005B52]/10 text-[#005B52] border-[#005B52]/30'
                                                    : 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                                ?>
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border <?= $roleStyles ?>">
                                                    <span class="w-1.5 h-1.5 rounded-full mr-2 <?= $isAdmin ? 'bg-[#005B52]' : 'bg-emerald-600' ?>"></span>
                                                    <?= html_escape($user->role) ?>
                                                </span>
                                            </td>

                                            <!-- Action Buttons -->
                                            <td class="px-8 py-5">
                                                <div class="flex items-center justify-center gap-3">
                                                    <!-- EDIT (Menggunakan warna aksen Vibrant Orange agar kontras) -->
                                                    <a href="<?= base_url('DaftarUser/edit/' . $user->id) ?>"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[12px] font-bold text-[#E67E22] bg-[#E67E22]/10 hover:bg-[#E67E22]/20 rounded-lg transition-all active:scale-95 border border-[#E67E22]/20">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        <span>Edit</span>
                                                    </a>

                                                    <!-- DELETE -->
                                                    <?= form_open('DaftarUser/delete/' . $user->id, [
                                                        'onsubmit' => "return confirm('Data akan dihapus permanen. Lanjutkan?')",
                                                        'class'    => 'inline'
                                                    ]) ?>
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[12px] font-bold text-red-700 bg-red-50 hover:bg-red-100 rounded-lg transition-all active:scale-95 border border-red-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        <span>Hapus</span>
                                                    </button>
                                                    <?= form_close() ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="px-8 py-20 text-center">
                                            <div class="flex flex-col items-center">
                                                <p class="text-sm font-bold text-[#2C3E50]/60 italic">Tidak ada data pengguna yang ditemukan dalam sistem.</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-8 py-6 bg-[#F8F9FA] border-t border-[#2C3E50]/20 flex flex-col md:flex-row items-center justify-between gap-4">
                        <p class="text-[11px] text-[#2C3E50] font-black uppercase tracking-wider">
                            Data <?= ($start + 1) ?> - <?= min(($start + count($users)), $total) ?> dari <?= $total ?> Entri
                        </p>
                        <div class="pagination-wrapper">
                            <?= $pagination ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

</body>

</html>