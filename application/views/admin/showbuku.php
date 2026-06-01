<?php 
define('book_path','assets/images/Buku/');
?>

<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BookStore | Edit Buku</title>
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
            <!-- Alert Flash Data -->
            <div class="px-10 mt-8">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="flex items-center p-4 mb-4 text-emerald-800 border-t-4 border-emerald-500 bg-emerald-50 rounded-2xl shadow-sm shadow-emerald-500/10">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="ml-3 text-sm font-bold uppercase tracking-wide">
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="flex items-center p-4 mb-4 text-rose-800 border-t-4 border-rose-500 bg-rose-50 rounded-2xl shadow-sm shadow-rose-500/10">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="ml-3 text-sm font-bold uppercase tracking-wide">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200/60 flex items-center justify-between px-10 sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <a href="<?= base_url('DaftarBuku') ?>" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Edit Katalog: <?= html_escape($buku->judul_buku) ?></h2>
                </div>
            </header>

            <section class="p-10">
                <div class="max-w-5xl mx-auto bg-white border border-slate-200/60 rounded-[2.5rem] shadow-sm p-12">

                    <?= form_open_multipart('DaftarBuku/update_buku/' . $buku->id); ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                        <!-- Kiri: Upload Gambar -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Gambar Sampul</label>
                            <div class="relative group">
                                <img src="<?= base_url(book_path . $buku->gambar) ?>" class="w-full h-full object-cover rounded-3xl shadow-md border border-slate-100">
                                <div class="mt-4">
                                    <input type="file" name="gambar" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                                </div>
                            </div>
                        </div>

                        <!-- Kanan: Form Fields -->
                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Judul -->
                            <div class="md:col-span-2 space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase">Judul Buku</label>
                                <input type="text" name="judul_buku" value="<?= html_escape($buku->judul_buku) ?>" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500/20 outline-none">
                            </div>

                            <!-- Penulis & Penerbit -->
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase">Penulis</label>
                                <input type="text" name="penulis" value="<?= html_escape($buku->penulis) ?>" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase">Penerbit</label>
                                <input type="text" name="penerbit" value="<?= html_escape($buku->penerbit) ?>" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none">
                            </div>

                            <!-- Harga & Halaman -->
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase">Harga (Rp)</label>
                                <input type="number" step="0.01" name="harga" value="<?= $buku->harga ?>" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl font-bold text-indigo-600 outline-none">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase">Jumlah Halaman</label>
                                <input type="number" name="halaman" value="<?= $buku->halaman ?>" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none">
                            </div>

                            <!-- Rating & Kategori -->
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase">Rating (0-255)</label>
                                <input type="number" name="rating" min="0" max="255" value="<?= $buku->rating ?>" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase">Kategori (Enum)</label>
                                <select name="kategori" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none appearance-none">
                                    <option value="bisnis&ekonomi" <?= $buku->kategori == 'bisnis&ekonomi' ? 'selected' : '' ?>>Bisnis & Ekonomi</option>
                                    <option value="fiksi" <?= $buku->kategori == 'fiksi' ? 'selected' : '' ?>>Fiksi</option>
                                    <option value="edukasi" <?= $buku->kategori == 'edukasi' ? 'selected' : '' ?>>Edukasi</option>
                                    <option value="sejarah" <?= $buku->kategori == 'sejarah' ? 'selected' : '' ?>>Sejarah</option>
                                </select>
                            </div>

                            <!-- Deskripsi -->
                            <div class="md:col-span-2 space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase">Deskripsi</label>
                                <textarea name="deskripsi" rows="4" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none resize-none"><?= html_escape($buku->deskripsi) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 flex items-center justify-end gap-4 border-t border-slate-50 pt-8">
                        <p class="text-xs text-slate-400 mr-auto italic">Total Terjual: <?= $buku->total_terjual ?> unit</p>
                        <a href="<?= base_url('DaftarBuku/') ?>" class="px-8 py-3 text-sm font-bold text-slate-400">Batal</a>
                        <button type="submit" class="px-10 py-3 bg-slate-900 text-white text-sm font-bold rounded-2xl hover:bg-slate-800 shadow-xl shadow-slate-900/20 transition-all">
                            Update Data
                        </button>
                    </div>
                    <?= form_close(); ?>

                </div>
            </section>
        </main>
    </div>
</body>

</html>