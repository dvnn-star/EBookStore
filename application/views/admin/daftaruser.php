<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BookStore | Daftar Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-[#fbfcfd] text-slate-900 antialiased">

    <div class="flex min-h-screen">
        <?php $this->load->view('components/sidebarAdmin'); ?>

        <main class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200/60 flex items-center justify-between px-10 sticky top-0 z-10">
                <div>
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Manajemen Pengguna</h2>
                    <p class="text-[11px] text-slate-500 font-medium uppercase tracking-wider">Otoritas Akses & Pengaturan Akun</p>
                </div>
                <a href="<?= base_url('admin/tambah_user') ?>" class="px-5 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20 flex items-center gap-2 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah User
                </a>
            </header>

            <section class="p-8 lg:p-10">
                <!-- Table Container -->
                <div class="bg-white border border-slate-200/60 rounded-[2rem] shadow-sm overflow-hidden">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/30 flex justify-between items-center">
                        <h3 class="font-bold text-slate-700 text-sm uppercase tracking-widest">Database Pengguna</h3>
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-lg border border-indigo-100">Total: <?= $total ?></span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[10px] uppercase tracking-[0.15em] text-slate-400 font-extrabold border-b border-slate-100 bg-slate-50/50">
                                    <th class="px-8 py-4">Informasi User</th>
                                    <th class="px-8 py-4">Alamat Email</th>
                                    <th class="px-8 py-4">Status Akses</th>
                                    <th class="px-8 py-4 text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr class="group hover:bg-slate-50/50 transition-colors">
                                            <!-- Nama & ID -->
                                            <td class="px-8 py-5">
                                                <div class="flex flex-col">
                                                    <span class="text-sm font-bold text-slate-800 group-hover:text-indigo-600 transition-colors"><?= html_escape($user->name) ?></span>
                                                    <span class="text-[10px] text-slate-400 font-mono tracking-tighter">UID: #<?= $user->id ?></span>
                                                </div>
                                            </td>

                                            <!-- Email -->
                                            <td class="px-8 py-5">
                                                <span class="text-sm text-slate-600 font-medium"><?= html_escape($user->email) ?></span>
                                            </td>

                                            <!-- Role Badge -->
                                            <td class="px-8 py-5">
                                                <?php
                                                $isAdmin = (strtolower($user->role) === 'admin');
                                                $roleStyles = $isAdmin
                                                    ? 'bg-indigo-50 text-indigo-600 border-indigo-100'
                                                    : 'bg-emerald-50 text-emerald-600 border-emerald-100';
                                                ?>
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tight border <?= $roleStyles ?>">
                                                    <span class="w-1.5 h-1.5 rounded-full mr-2 <?= $isAdmin ? 'bg-indigo-500' : 'bg-emerald-500' ?>"></span>
                                                    <?= html_escape($user->role) ?>
                                                </span>
                                            </td>

                                            <!-- Action Buttons (Sudah Diperbaiki) -->
                                            <td class="px-8 py-5">
                                                <div class="flex items-center justify-center gap-3">
                                                    <!-- EDIT -->
                                                    <a href="<?= base_url('DaftarUser/edit/' . $user->id) ?>"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[12px] font-bold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-all active:scale-95">
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
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[12px] font-bold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-all active:scale-95">
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
                                                <p class="text-sm font-medium text-slate-400 italic">Tidak ada data pengguna yang ditemukan dalam sistem.</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                        <p class="text-[11px] text-slate-500 font-bold uppercase tracking-wider">
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