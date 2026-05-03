<!-- application/views/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - EBookStore</title>
    <!-- Gunakan Bootstrap atau Tailwind untuk tampilan premium -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">Sign In</h3>

                    <!-- 1. Menampilkan Pesan Error (Flashdata) -->
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger small">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- 2. Form Open (Otomatis Handle CSRF) -->
                    <?php echo form_open('auth/login'); ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?= set_value('email'); ?>" placeholder="name@example.com">
                            <!-- Menampilkan error validasi per field -->
                            <small class="text-danger"><?= form_error('email'); ?></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••">
                            <small class="text-danger"><?= form_error('password'); ?></small>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Login</button>
                        </div>

                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>