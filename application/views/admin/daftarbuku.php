<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BookStore | Daftar Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="<?= base_url('assets/vendor/sweetalert2/sweetalert2.min.js') ?>"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>

<body class="h-full bg-[#FFFFFF] text-[#1F2937] antialiased">

    <div class="flex min-h-screen bg-neutral-50/50">
        <?php $this->load->view('components/sidebarAdmin'); ?>
        <?php if ($this->session->flashdata('success')) : ?>
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil ditambahkan',
                    icon: 'success'
                });
            </script>
        <?php endif; ?>
        <main class="flex-1 flex flex-col">
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-neutral-200 flex items-center justify-between px-10 sticky top-0 z-10">
                <div>
                    <h2 class="text-xl font-bold text-[#1F2937] tracking-tight">Manajemen Katalog</h2>
                    <p class="text-xs text-neutral-600 font-semibold">Kelola koleksi buku dan ketersediaan stok Anda.</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="<?= base_url('DaftarBuku/tambah_buku') ?>" class="px-5 py-2.5 text-sm font-bold text-white bg-[#005B52] rounded-xl hover:bg-[#00443d] transition-all shadow-lg shadow-[#005B52]/10 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buku Baru
                    </a>
                </div>
            </header>

            <section class="p-10 space-y-8">

                <div class="bg-white border border-neutral-200 rounded-3xl shadow-sm overflow-hidden">
                    <div class="px-8 py-6 border-b border-neutral-200 bg-neutral-50/50">
                        <h3 class="font-bold text-[#1F2937] text-lg">Daftar Buku Tersedia</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[11px] uppercase tracking-widest text-neutral-500 font-bold border-b border-neutral-200 bg-neutral-50">
                                    <th class="px-8 py-4">Informasi Buku</th>
                                    <th class="px-8 py-4">Kategori</th>
                                    <th class="px-8 py-4 text-right">Harga</th>
                                    <th class="px-8 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-100">
                                <?php if (!empty($books)): ?>
                                    <?php foreach ($books as $book): ?>
                                        <tr class="group hover:bg-neutral-50 transition-all">
                                            <td class="px-8 py-5">
                                                <div class="flex items-center gap-4">
                                                    <div>
                                                        <p class="text-sm font-bold text-[#1F2937] line-clamp-1"><?= $book->judul_buku ?></p>
                                                        <p class="text-[10px] text-neutral-500 font-bold uppercase tracking-wide mt-0.5"><?= $book->penulis ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5 text-sm text-neutral-600 font-semibold"><?= $book->kategori ?></td>

                                            <td class="px-8 py-5 text-right font-black text-[#FF8A00] text-sm">
                                                Rp <?= number_format($book->harga, 0, ',', '.') ?>
                                            </td>
                                            <td class="px-8 py-5">
                                                <div class="flex items-center justify-center gap-1">
                                                    <div class="flex items-center gap-2">

                                                        <a href="<?= base_url('DaftarBuku/edit/' . $book->id) ?>"
                                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-bold text-[#005B52] bg-[#005B52]/10 hover:bg-[#005B52]/20 rounded-lg transition">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                            <span>Edit</span>
                                                        </a>

                                                        <?= form_open('DaftarBuku/delete/' . $book->id, [
                                                            'onsubmit' => "return confirm('Data akan dihapus permanen. Lanjutkan?')",
                                                            'class'    => 'inline'
                                                        ]) ?>
                                                        <button type="submit"
                                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-bold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            <span>Hapus</span>
                                                        </button>
                                                        <?= form_close() ?>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="px-8 py-20 text-center font-medium text-neutral-500 text-sm">Data buku tidak ditemukan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-8 py-6 bg-neutral-50 border-t border-neutral-200">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                            <p class="text-xs text-neutral-600 font-semibold">Menampilkan data ke-<?= ($start + 1) ?> sampai <?= count($books) + $start ?> dari <?= $total ?> entri</p>
                            <div class="pagination-custom text-[#005B52] font-bold">
                                <?= $pagination ?>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </main>
    </div>

</body>

</html>