<?php $old = $this->session->flashdata('old_input'); ?>

<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BookStore | Tambah Buku</title>
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
        <!-- Sidebar -->
        <?php $this->load->view('components/sidebarAdmin'); ?>

        <main class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200/60 flex items-center justify-between px-10 sticky top-0 z-10">
                <div>
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Tambah Koleksi Baru</h2>
                    <p class="text-[11px] text-slate-500 font-medium uppercase tracking-wider">Lengkapi Informasi Inventaris Buku</p>
                </div>
                <a href="<?= base_url('DaftarBuku') ?>" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar
                </a>
            </header>

            <section class="p-8 lg:p-10 max-w-5xl">
                <?php if ($this->session->flashdata('success')) : ?>
                    <?= $this->session->flashdata('success'); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')) : ?>

                    <p class="text-xl text-red-600 font-serif font-bold"><?= $this->session->flashdata('error'); ?></p>
                <?php endif; ?>

                <!-- Form Card -->
                <div class="bg-white border border-slate-200/60 rounded-[2rem] shadow-sm overflow-hidden">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/30">
                        <h3 class="font-bold text-slate-700 text-sm uppercase tracking-widest">Formulir Buku</h3>
                    </div>

                    <!-- Gunakan form_open_multipart untuk upload file -->
                    <?= form_open_multipart('DaftarBuku/admin/TambahBuku', ['class' => 'p-8 space-y-6']) ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Judul Buku -->
                        <!-- Judul Buku -->
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">
                                Judul Buku
                            </label>

                            <input
                                type="text"
                                name="judul_buku"
                                value="<?= isset($old['judul_buku']) ? html_escape($old['judul_buku']) : '' ?>"
                                placeholder="Contoh: Atomic Habits"
                                class="w-full px-4 py-3 bg-slate-50 border <?= form_error('judul_buku') ? 'border-red-500' : 'border-slate-200' ?> rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium">

                            <?= form_error(
                                'judul_buku',
                                '<p class="text-red-500 text-xs font-semibold mt-1 ml-1">',
                                '</p>'
                            ) ?>
                        </div>

                        <!-- Penulis -->
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">
                                Penulis / Author
                            </label>

                            <input
                                type="text"
                                name="penulis"
                                value="<?= isset($old['penulis']) ? html_escape($old['penulis']) : '' ?>"
                                placeholder=" Nama penulis"
                                class="w-full px-4 py-3 bg-slate-50 border <?= form_error('penulis') ? 'border-red-500' : 'border-slate-200' ?> rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium">

                            <?= form_error(
                                'penulis',
                                '<p class="text-red-500 text-xs font-semibold mt-1 ml-1">',
                                '</p>'
                            ) ?>
                        </div>

                        <!-- Kategori -->
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">
                                Kategori
                            </label>

                            <select
                                name="kategori"
                                class="w-full px-4 py-3 bg-slate-50 border <?= form_error('kategori') ? 'border-red-500' : 'border-slate-200' ?> rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium appearance-none">


                                <option value="bisnis&ekonomi" <?= set_select('kategori', 'bisnis&ekonomi') ?>>
                                    Bisnis & Ekonomi
                                </option>

                                <option value="fiksi" <?= set_select('kategori', 'fiksi') ?>>
                                    Fiksi
                                </option>

                                <option value="sejarah" <?= set_select('kategori', 'sejarah') ?>>
                                    Sejarah
                                </option>

                                <option value="edukasi" <?= set_select('kategori', 'edukasi') ?>>
                                    Edukasi
                                </option>

                                <option value="pengembangan-diri" <?= set_select('kategori', 'pengembangan-diri') ?>>
                                    Pengembangan Diri
                                </option>
                            </select>

                            <?= form_error(
                                'kategori',
                                '<p class="text-red-500 text-xs font-semibold mt-1 ml-1">',
                                '</p>'
                            ) ?>
                        </div>

                        <!-- Penerbit -->
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">
                                Penerbit
                            </label>

                            <input
                                type="text"
                                name="penerbit"
                                value="<?= isset($old['penerbit']) ? html_escape($old['penerbit']) : '' ?>"
                                placeholder=" Nama penerbit"
                                class="w-full px-4 py-3 bg-slate-50 border <?= form_error('penerbit') ? 'border-red-500' : 'border-slate-200' ?> rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium">

                            <?= form_error(
                                'penerbit',
                                '<p class="text-red-500 text-xs font-semibold mt-1 ml-1">',
                                '</p>'
                            ) ?>
                        </div>

                        <!-- Harga -->
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">
                                Harga (Rp)
                            </label>

                            <input
                                type="number"
                                name="harga"
                                value="<?= isset($old['harga']) ? html_escape($old['harga']) : '' ?>"
                                placeholder="Contoh: 95000"
                                class="w-full px-4 py-3 bg-slate-50 border <?= form_error('harga') ? 'border-red-500' : 'border-slate-200' ?> rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium font-mono">

                            <?= form_error(
                                'harga',
                                '<p class="text-red-500 text-xs font-semibold mt-1 ml-1">',
                                '</p>'
                            ) ?>
                        </div>

                        <!-- Halaman -->
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">
                                Halaman
                            </label>

                            <input
                                type="number"
                                name="halaman"
                                value="<?= isset($old['halaman']) ? html_escape($old['halaman']) : '' ?>"
                                placeholder="0"
                                class="w-full px-4 py-3 bg-slate-50 border <?= form_error('halaman') ? 'border-red-500' : 'border-slate-200' ?> rounded-xl">

                            <?= form_error(
                                'halaman',
                                '<p class="text-red-500 text-xs font-semibold mt-1 ml-1">',
                                '</p>'
                            ) ?>
                        </div>

                        <!-- Rating -->
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">
                                Rating
                            </label>

                            <input
                                type="number"
                                name="rating"
                                value="<?= isset($old['rating']) ? html_escape($old['rating']) : '' ?>"
                                min="1"
                                max="5"
                                placeholder="5"
                                class="w-full px-4 py-3 bg-slate-50 border <?= form_error('rating') ? 'border-red-500' : 'border-slate-200' ?> rounded-xl">

                            <?= form_error(
                                'rating',
                                '<p class="text-red-500 text-xs font-semibold mt-1 ml-1">',
                                '</p>'
                            ) ?>
                        </div>

                        <!-- Deskripsi -->
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">
                                Sinopsis / Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                rows="4"
                                placeholder="Tuliskan deskripsi singkat mengenai isi buku..."
                                class="w-full px-4 py-3 bg-slate-50 border <?= form_error('deskripsi') ? 'border-red-500' : 'border-slate-200' ?> rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-medium resize-none"><?= set_value('deskripsi') ?></textarea>

                            <?= form_error(
                                'deskripsi',
                                '<p class="text-red-500 text-xs font-semibold mt-1 ml-1">',
                                '</p>'
                            ) ?>
                        </div>

                        <!-- Upload Gambar -->
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">
                                Cover Buku (JPG/PNG)
                            </label>

                            <input
                                type="file"
                                name="gambar"
                                class="block w-full text-sm text-slate-500 border <?= form_error('gambar') ? 'border-red-500' : 'border-slate-200' ?> bg-slate-50 rounded-xl p-1">

                            <?= form_error(
                                'gambar',
                                '<p class="text-red-500 text-xs font-semibold mt-1 ml-1">',
                                '</p>'
                            ) ?>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-4 flex items-center gap-3">
                            <button type="submit" class="flex-1 md:flex-none px-10 py-3.5 bg-indigo-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-600/20 hover:bg-indigo-700 active:scale-95 transition-all">
                                Simpan Data Buku
                            </button>
                          
                        </div>

                        <?= form_close() ?>
                    </div>
            </section>
        </main>
    </div>

</body>

</html>