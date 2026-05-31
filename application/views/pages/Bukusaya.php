<?php $this->load->view('components/navbar');
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-[#F8F9FA]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-PUSTAKA | Rak Buku Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="text-[#2C3E50] antialiased min-h-screen flex flex-col bg-[#F8F9FA]">


    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        
        <div class="space-y-2">
            <h1 class="text-3xl font-black tracking-tight text-[#005B52]">Rak Buku Saya</h1>
            <p class="text-sm text-[#2C3E50]/70">Semua e-book yang Anda miliki terpusat di sini. Siap dibaca kapan saja.</p>
        </div>

        <?php if (empty($books)): ?>
            <div class="bg-[#FFFFFF] border border-[#2C3E50]/10 rounded-3xl p-12 text-center max-w-md mx-auto my-12 space-y-4 shadow-sm">
                <div class="w-16 h-16 bg-[#F8F9FA] text-[#005B52] rounded-2xl flex items-center justify-center text-2xl mx-auto font-bold">
                    📖  
                </div>
                <div class="space-y-1">
                    <h3 class="text-base font-bold text-[#2C3E50]">Rak Buku Masih Kosong</h3>
                    <p class="text-xs text-[#2C3E50]/60">Anda belum memiliki atau menyelesaikan pembayaran transaksi e-book apa pun saat ini.</p>
                </div>
                <a href="<?= base_url('catalog') ?>" class="inline-block px-5 py-2.5 bg-[#005B52] rounded-xl hover:bg-[#00443d] text-white font-bold text-xs shadow-md shadow-[#005B52]/10 transition-all active:scale-[0.98]">
                    Jelajahi Katalog E-Book
                </a>
            </div>
        <?php else: ?>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($books as $book): ?>
                    <div class="bg-[#FFFFFF] border border-[#2C3E50]/10 rounded-3xl p-5 shadow-sm hover:shadow-md hover:border-[#005B52]/30 transition-all flex flex-col justify-between group">
                        
                        <div class="space-y-4">
                            <div class="flex gap-4">
                                <div class="w-24 h-32 bg-[#F8F9FA] rounded-2xl border border-[#2C3E50]/10 overflow-hidden flex-shrink-0 shadow-sm relative group-hover:scale-[1.02] transition-all">
                                    <?php if ($book->gambar): ?>
                                        <img src="<?= base_url('uploads/books/' . $book->gambar) ?>" alt="Cover <?= $book->judul_buku ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-[10px] font-bold text-[#2C3E50]/40 uppercase bg-[#F8F9FA]">No Cover</div>
                                    <?php endif; ?>
                                </div>

                                <div class="space-y-1 min-w-0 flex flex-col justify-center">
                                    <span class="inline-block text-[9px] font-bold uppercase tracking-wider text-[#E67E22] bg-[#E67E22]/10 px-2 py-0.5 rounded-md self-start truncate max-w-full">
                                        <?= str_replace('&', ' & ', $book->kategori) ?>
                                    </span>
                                    <h2 class="text-sm font-bold text-[#2C3E50] line-clamp-2 leading-snug group-hover:text-[#005B52] transition-all" title="<?= $book->judul_buku ?>">
                                        <?= $book->judul_buku ?>
                                    </h2>
                                    <p class="text-xs text-[#2C3E50]/60 font-medium truncate">Oleh: <span class="text-[#2C3E50] font-semibold"><?= $book->penulis ?></span></p>
                                    <p class="text-[10px] text-[#2C3E50]/50 truncate">Penerbit: <?= $book->penerbit ?></p>
                                </div>
                            </div>

                            <div class="pt-2 border-t border-[#2C3E50]/5">
                                <p class="text-xs text-[#2C3E50]/80 line-clamp-3 leading-relaxed">
                                    <?= $book->deskripsi ? strip_tags($book->deskripsi) : 'Tidak ada deskripsi untuk buku ini.' ?>
                                </p>
                            </div>
                        </div>

                        <div class="pt-4 mt-4 border-t border-[#2C3E50]/5 flex items-center justify-between gap-4">
                            <span class="text-[10px] font-medium text-[#2C3E50]/50">
                                Diperoleh: <?= date('d M Y', strtotime($book->created_at)) ?>
                            </span>
                            
                            <a href="<?= base_url('library/read/' . $book->buku_id) ?>" class="px-4 py-2 bg-[#005B52] rounded-xl hover:bg-[#00443d] text-white font-bold text-xs shadow-sm transition-all active:scale-[0.98]">
                                Baca Sekarang →
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </main>

    <?php
        $this->load->view('components/Footer');
    ?>


</body>
</html> 