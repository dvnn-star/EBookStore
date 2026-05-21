<?php $this->load->view('components/navbar');
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EBookStore | Rak Buku Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="text-slate-900 antialiased min-h-screen flex flex-col">

    <!-- HEADER / NAVIGATION AREA -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-xl font-black tracking-tight text-indigo-600">EBook<span class="text-slate-800">Store</span></span>
                <span class="text-xs font-semibold bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-full">Koleksi Saya</span>
            </div>
            <a href="<?= base_url('catalog') ?>" class="text-xs font-bold text-slate-500 hover:text-indigo-600 transition-all">
                ← Kembali Belanja
            </a>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        
        <!-- WELCOME BANNER / TITLE -->
        <div class="space-y-2">
            <h1 class="text-3xl font-black tracking-tight text-slate-800">Rak Buku Saya</h1>
            <p class="text-sm text-slate-500">Semua e-book yang Anda miliki terpusat di sini. Siap dibaca kapan saja.</p>
        </div>

        <?php if (empty($books)): ?>
            <!-- KONDISI JIKA RAK BUKU MASIH KOSONG -->
            <div class="bg-white border border-slate-200 rounded-3xl p-12 text-center max-w-md mx-auto my-12 space-y-4 shadow-sm">
                <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-2xl flex items-center justify-center text-2xl mx-auto font-bold">
                    📖
                </div>
                <div class="space-y-1">
                    <h3 class="text-base font-bold text-slate-700">Rak Buku Masih Kosong</h3>
                    <p class="text-xs text-slate-400">Anda belum memiliki atau menyelesaikan pembayaran transaksi e-book apa pun saat ini.</p>
                </div>
                <a href="<?= base_url('catalog') ?>" class="inline-block px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/10 transition-all active:scale-[0.98]">
                    Jelajahi Katalog E-Book
                </a>
            </div>
        <?php else: ?>
            
            <!-- GRID DAFTAR BUKU -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($books as $book): ?>
                    <!-- CARD BUKU -->
                    <div class="bg-white border border-slate-200 rounded-3xl p-5 shadow-sm hover:shadow-md hover:border-slate-300 transition-all flex flex-col justify-between group">
                        
                        <div class="space-y-4">
                            <!-- Bagian Atas: Gambar dan Metadata Utama -->
                            <div class="flex gap-4">
                                <!-- Cover Buku -->
                                <div class="w-24 h-32 bg-slate-100 rounded-2xl border border-slate-200 overflow-hidden flex-shrink-0 shadow-sm relative group-hover:scale-[1.02] transition-all">
                                    <?php if ($book->gambar): ?>
                                        <img src="<?= base_url('uploads/books/' . $book->gambar) ?>" alt="Cover <?= $book->judul_buku ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-[10px] font-bold text-slate-400 uppercase bg-slate-100">No Cover</div>
                                    <?php endif; ?>
                                </div>

                                <!-- Detail Teks Kanan -->
                                <div class="space-y-1 min-w-0 flex flex-col justify-center">
                                    <!-- Badge Kategori -->
                                    <span class="inline-block text-[9px] font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md self-start truncate max-w-full">
                                        <?= str_replace('&', ' & ', $book->kategori) ?>
                                    </span>
                                    <!-- Judul Buku -->
                                    <h2 class="text-sm font-bold text-slate-800 line-clamp-2 leading-snug group-hover:text-indigo-600 transition-all" title="<?= $book->judul_buku ?>">
                                        <?= $book->judul_buku ?>
                                    </h2>
                                    <!-- Penulis -->
                                    <p class="text-xs text-slate-400 font-medium truncate">Oleh: <span class="text-slate-600 font-semibold"><?= $book->penulis ?></span></p>
                                    <!-- Penerbit -->
                                    <p class="text-[10px] text-slate-400 truncate">Penerbit: <?= $book->penerbit ?></p>
                                </div>
                            </div>

                            <!-- Deskripsi Singkat -->
                            <div class="pt-2 border-t border-slate-100">
                                <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">
                                    <?= $book->deskripsi ? strip_tags($book->deskripsi) : 'Tidak ada deskripsi untuk buku ini.' ?>
                                </p>
                            </div>
                        </div>

                        <!-- Bagian Bawah: Tombol Aksi & Waktu Kepemilikan -->
                        <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between gap-4">
                            <span class="text-[10px] font-medium text-slate-400">
                                Diperoleh: <?= date('d M Y', strtotime($book->created_at)) ?>
                            </span>
                            
                            <!-- Tombol Baca Akses File Ebook -->
                            <a href="<?= base_url('library/read/' . $book->buku_id) ?>" class="px-4 py-2 bg-slate-950 hover:bg-indigo-600 text-white font-bold text-xs rounded-xl shadow-sm transition-all active:scale-[0.98]">
                                Baca Sekarang →
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-200 mt-12 py-6 text-center text-xs text-slate-400 font-medium">
        &copy; <?= date('Y') ?> EBookStore Sistem Hak Milik Digital. All rights reserved.
    </footer>

</body>
</html>