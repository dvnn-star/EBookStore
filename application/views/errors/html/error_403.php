<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Dilarang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #1f2937;
        }

        .container {
            text-align: center;
            max-width: 500px;
            padding: 2rem;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 900;
            line-height: 1;
            color: #ef4444;
            margin-bottom: 1rem;
            letter-spacing: -0.05em;
        }

        h1 {
            font-size: 1.875rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        p {
            color: #6b7280;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-home {
            display: inline-block;
            background-color: #2563eb;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s ease;
        }

        .btn-home:hover {
            background-color: #1d4ed8;
        }

        /* Dekorasi Tambahan */
        .ghost {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="ghost">🚫</div>
        <div class="error-code">403</div>
        <h1>Akses Dilarang, Anjay.</h1>
        <p>Maaf, kamu tidak punya otoritas untuk masuk ke wilayah ini. Silakan kembali ke jalan yang benar atau hubungi admin jika kamu merasa ini kesalahan.</p>
        
        <a href="<?= base_url(); ?>" class="btn-home">Kembali ke Halaman Utama</a>
    </div>

</body>
</html>