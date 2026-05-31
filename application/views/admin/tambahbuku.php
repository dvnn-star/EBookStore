<?php $old = $this->session->flashdata('old_input'); ?>

<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA | Tambah Buku</title>
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
                <div>
                    <h2 class="text-xl font-bold text-[#0D5C56] tracking-tight">Tambah Koleksi Baru</h2>
                    <p class="text-[11px] text-[#2C3E50] font-bold uppercase tracking-wider opacity-90">Lengkapi Informasi Inventaris Buku</p>
                </div>
                <a href="<?= base_url('DaftarBuku') ?>" class="text-sm font-bold text-[#E67E22] hover:text-[#D35400] transition-colors flex items-center gap-2 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                    <p class="text-xl text-red-700 font-serif font-bold"><?= $this->session->flashdata('error'); ?></p>
                <?php endif; ?>

                <div class="bg-[#FFFFFF] border border-[#2C3E50]/20 rounded-[2rem] shadow-md overflow-hidden">
                    <div class="px-8 py-5 border-b border-[#2C3E50]/20 bg-[#F8F9FA]">
                        <h3 class="font-bold text-[#0D5C56] text-sm uppercase tracking-widest">Formulir Buku</h3>
                    </div>

                    <?= form_open_multipart('DaftarBuku/admin/TambahBuku', ['class' => 'p-8 space-y-6']) ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-[#2C3E50] uppercase tracking-wider ml-1">
                                Judul Buku
                            </label>
                            <input
                                type="text"
                                name="judul_buku"
                                value="<?= isset($old['judul_buku']) ? html_escape($old['judul_buku']) : '' ?>"
                                placeholder="Contoh: Atomic Habits"
                                class="w-full px-4 py-3 bg-[#F8F9FA] border <?= form_error('judul_buku') ? 'border-red-500 ring-1 ring-red-500' : 'border-[#2C3E50]/40' ?> rounded-xl focus:ring-2 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] outline-none transition-all text-sm font-semibold placeholder-[#2C3E50]/50">
                            <?= form_error('judul_buku', '<p class="text-red-600 text-xs font-bold mt-1 ml-1">', '</p>') ?>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-[#2C3E50] uppercase tracking-wider ml-1">
                                Penulis / Author
                            </label>
                            <input
                                type="text"
                                name="penulis"
                                value="<?= isset($old['penulis']) ? html_escape($old['penulis']) : '' ?>"
                                placeholder="Nama penulis"
                                class="w-full px-4 py-3 bg-[#F8F9FA] border <?= form_error('penulis') ? 'border-red-500 ring-1 ring-red-500' : 'border-[#2C3E50]/40' ?> rounded-xl focus:ring-2 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] outline-none transition-all text-sm font-semibold placeholder-[#2C3E50]/50">
                            <?= form_error('penulis', '<p class="text-red-600 text-xs font-bold mt-1 ml-1">', '</p>') ?>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-[#2C3E50] uppercase tracking-wider ml-1">
                                Kategori
                            </label>
                            <div class="relative">
                                <select
                                    name="kategori"
                                    class="w-full px-4 py-3 bg-[#F8F9FA] border <?= form_error('kategori') ? 'border-red-500 ring-1 ring-red-500' : 'border-[#2C3E50]/40' ?> rounded-xl focus:ring-2 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] outline-none transition-all text-sm font-semibold appearance-none">
                                    <option value="bisnis&ekonomi" <?= set_select('kategori', 'bisnis&ekonomi') ?>>Bisnis & Ekonomi</option>
                                    <option value="fiksi" <?= set_select('kategori', 'fiksi') ?>>Fiksi</option>
                                    <option value="sejarah" <?= set_select('kategori', 'sejarah') ?>>Sejarah</option>
                                    <option value="edukasi" <?= set_select('kategori', 'edukasi') ?>>Edukasi</option>
                                    <option value="pengembangan-diri" <?= set_select('kategori', 'pengembangan-diri') ?>>Pengembangan Diri</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-[#2C3E50]">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                            <?= form_error('kategori', '<p class="text-red-600 text-xs font-bold mt-1 ml-1">', '</p>') ?>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-[#2C3E50] uppercase tracking-wider ml-1">
                                Penerbit
                            </label>
                            <input
                                type="text"
                                name="penerbit"
                                value="<?= isset($old['penerbit']) ? html_escape($old['penerbit']) : '' ?>"
                                placeholder="Nama penerbit"
                                class="w-full px-4 py-3 bg-[#F8F9FA] border <?= form_error('penerbit') ? 'border-red-500 ring-1 ring-red-500' : 'border-[#2C3E50]/40' ?> rounded-xl focus:ring-2 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] outline-none transition-all text-sm font-semibold placeholder-[#2C3E50]/50">
                            <?= form_error('penerbit', '<p class="text-red-600 text-xs font-bold mt-1 ml-1">', '</p>') ?>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-[#2C3E50] uppercase tracking-wider ml-1">
                                Harga (Rp)
                            </label>
                            <input
                                type="number"
                                name="harga"
                                value="<?= isset($old['harga']) ? html_escape($old['harga']) : '' ?>"
                                placeholder="Contoh: 95000"
                                class="w-full px-4 py-3 bg-[#F8F9FA] border <?= form_error('harga') ? 'border-red-500 ring-1 ring-red-500' : 'border-[#2C3E50]/40' ?> rounded-xl focus:ring-2 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] outline-none transition-all text-sm font-bold font-mono placeholder-[#2C3E50]/50">
                            <?= form_error('harga', '<p class="text-red-600 text-xs font-bold mt-1 ml-1">', '</p>') ?>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-[#2C3E50] uppercase tracking-wider ml-1">
                                Halaman
                            </label>
                            <input
                                type="number"
                                name="halaman"
                                value="<?= isset($old['halaman']) ? html_escape($old['halaman']) : '' ?>"
                                placeholder="0"
                                class="w-full px-4 py-3 bg-[#F8F9FA] border <?= form_error('halaman') ? 'border-red-500 ring-1 ring-red-500' : 'border-[#2C3E50]/40' ?> rounded-xl focus:ring-2 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] outline-none transition-all text-sm font-semibold placeholder-[#2C3E50]/50">
                            <?= form_error('halaman', '<p class="text-red-600 text-xs font-bold mt-1 ml-1">', '</p>') ?>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-[#2C3E50] uppercase tracking-wider ml-1">
                                Rating
                            </label>
                            <input
                                type="number"
                                name="rating"
                                value="<?= isset($old['rating']) ? html_escape($old['rating']) : '' ?>"
                                min="1"
                                max="5"
                                placeholder="5"
                                class="w-full px-4 py-3 bg-[#F8F9FA] border <?= form_error('rating') ? 'border-red-500 ring-1 ring-red-500' : 'border-[#2C3E50]/40' ?> rounded-xl focus:ring-2 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] outline-none transition-all text-sm font-semibold placeholder-[#2C3E50]/50">
                            <?= form_error('rating', '<p class="text-red-600 text-xs font-bold mt-1 ml-1">', '</p>') ?>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-[#2C3E50] uppercase tracking-wider ml-1">
                                Cover Buku (JPG/PNG)
                            </label>
                            <input
                                type="file"
                                name="gambar"
                                class="block w-full text-sm text-[#2C3E50] font-medium border <?= form_error('gambar') ? 'border-red-500 ring-1 ring-red-500' : 'border-[#2C3E50]/40' ?> bg-[#F8F9FA] rounded-xl p-2 file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#005B52]/10 file:text-[#005B52] hover:file:bg-[#005B52]/20">
                            <?= form_error('gambar', '<p class="text-red-600 text-xs font-bold mt-1 ml-1">', '</p>') ?>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-[#2C3E50] uppercase tracking-wider ml-1">
                            Sinopsis / Deskripsi
                        </label>
                        <textarea
                            name="deskripsi"
                            rows="4"
                            placeholder="Tuliskan deskripsi singkat mengenai isi buku..."
                            class="w-full px-4 py-3 bg-[#F8F9FA] border <?= form_error('deskripsi') ? 'border-red-500 ring-1 ring-red-500' : 'border-[#2C3E50]/40' ?> rounded-xl focus:ring-2 focus:ring-[#005B52]/20 focus:border-[#005B52] text-[#2C3E50] outline-none transition-all text-sm font-semibold resize-none placeholder-[#2C3E50]/50"><?= set_value('deskripsi') ?></textarea>
                        <?= form_error('deskripsi', '<p class="text-red-600 text-xs font-bold mt-1 ml-1">', '</p>') ?>
                    </div>

                    <div class="pt-4 flex items-center gap-3">
                        <button type="submit" class="flex-1 md:flex-none px-10 py-3.5 bg-[#005B52] text-white text-sm font-bold rounded-xl shadow-lg shadow-[#005B52]/20 hover:bg-[#00443d] active:scale-95 transition-all">
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