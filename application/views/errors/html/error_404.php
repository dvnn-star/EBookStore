<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: #f9fafb;
            color: #111827;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
            padding: 20px;
        }

        .error-container {
            max-width: 600px;
            width: 100%;
        }

        .error-code {
            font-size: 10rem;
            font-weight: 900;
            color: #e5e7eb;
            position: relative;
            line-height: 1;
            margin-bottom: -20px;
            z-index: 0;
        }

        .content-box {
            position: relative;
            z-index: 1;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: #111827;
        }

        .message {
            font-size: 1.125rem;
            color: #4b5563;
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background-color: #f3f4f6;
        }

        /* Debug info untuk developer (CodeIgniter message) */
        .debug-info {
            margin-top: 3rem;
            font-family: monospace;
            font-size: 0.8rem;
            color: #9ca3af;
            background: #f3f4f6;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <div class="content-box">
            <h1>Halaman Hilang, Bro.</h1>
            <p class="message">
                Sepertinya kamu tersesat atau link yang kamu tuju sudah dihapus. 
                Jangan panik, kamu bisa balik lagi ke dashboard atau lapor admin.
            </p>
            
            <div class="btn-group">
                <a href="/EBookStore/"	 class="btn btn-primary">Ke Beranda</a>
                <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        <!-- Tetap menyertakan variabel CI3 untuk keperluan debugging -->
        <div class="debug-info">
            Sistem: <?php echo strip_tags($message); ?>
        </div>
    </div>
</body>
</html>