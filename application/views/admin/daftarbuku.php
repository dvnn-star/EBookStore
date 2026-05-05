<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BookStore | Daftar Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="h-full bg-[#fbfcfd] text-slate-900 antialiased">

    <div class="flex min-h-screen">
        <!-- PANGGIL SIDEBAR PARTIAL -->
        <?php $this->load->view('components/sidebarAdmin'); ?>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200/60 flex items-center justify-between px-10 sticky top-0 z-10">
                <div>
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Manajemen Katalog</h2>
                    <p class="text-xs text-slate-500 font-medium">Kelola koleksi buku dan ketersediaan stok Anda.</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="<?= base_url('admin/tambah_buku') ?>" class="px-5 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Buku Baru
                    </a>
                </div>
            </header>

            <!-- Dashboard Content -->
            <section class="p-10 space-y-8">
                
                <!-- Table Container -->
                <div class="bg-white border border-slate-200/60 rounded-3xl shadow-sm overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/30">
                         <h3 class="font-bold text-slate-800 text-lg italic">Daftar Buku Tersedia</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[11px] uppercase tracking-widest text-slate-400 font-bold border-b border-slate-100 bg-slate-50/50">
                                    <th class="px-8 py-4">Informasi Buku</th>
                                    <th class="px-8 py-4">Kategori</th>
                                    <th class="px-8 py-4 text-right">Harga</th>
                                    <th class="px-8 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr class="group hover:bg-slate-50/80 transition-all">
                                            <td class="px-8 py-5">
                                                <div class="flex items-center gap-4">
                                         
                                                    <div>
                                                        <p class="text-sm font-bold text-slate-800 line-clamp-1 italic"><?= $user->judul_buku ?></p>
                                                        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tight"><?= $user->penulis ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5 text-sm text-slate-600 font-medium"><?= $user->kategori ?></td>
                                        
                                            <td class="px-8 py-5 text-right font-black text-slate-900 text-sm">
                                                Rp <?= number_format($book->harga, 0, ',', '.') ?>
                                            </td>
                                            <td class="px-8 py-5">
                                                <div class="flex items-center justify-center gap-1">
                                                    <a href="<?= base_url('admin/edit_buku/' . $book->id) ?>" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                    </a>
                                                    <button onclick="return confirm('Hapus buku ini?')" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="px-8 py-20 text-center italic text-slate-400 text-sm">Data buku tidak ditemukan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                            <p class="text-xs text-slate-500 font-medium">Menampilkan data ke-<?= ($start + 1) ?> sampai <?= count($books) + $start ?> dari <?= $total ?> entri</p>
                            <?= $pagination ?>
                        </div>
                    </div>
                </div>

            </section>
        </main>
    </div>

</body>
</html>