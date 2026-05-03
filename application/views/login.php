<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EBookStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
function togglePassword() {
    const input = document.getElementById("password");
    const btn = event.target;

    if (input.type === "password") {
        input.type = "text";
        btn.innerText = "Hide";
    } else {
        input.type = "password";
        btn.innerText = "Show";
    }
}
</script>

</head>
<body class="bg-gray-50">

<div class="min-h-screen flex items-center justify-center px-4 py-6 sm:px-6">

    <div class="w-full max-w-5xl mx-auto 
            bg-white rounded-2xl shadow-2xl overflow-hidden 
            grid grid-cols-1 md:grid-cols-2">

        <!-- LEFT SIDE (Branding / Info) -->
        <div class="order-2 md:order-1 flex flex-col justify-center items-center text-white p-6 md:p-10 bg-[#0b5c5d]">
            <h1 class="text-3xl font-bold mb-4">EBookStore</h1>
            <p class="text-gray-100 text-center text-sm">
                Jelajahi ribuan e-book terbaik dari berbagai kategori.
                Belajar, berkembang, dan temukan wawasan baru.
            </p>
        </div>

        <!-- RIGHT SIDE (Form) -->
        <div class="order-1 md:order-2 bg-white p-8 md:p-10">

            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
                Sign In
            </h2>

            <!-- Flash Error -->
            <?php if($this->session->flashdata('error')): ?>
                <div class="mb-4 text-sm text-red-600 bg-red-100 p-3 rounded-lg text-red-700">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <?php echo form_open('auth/login'); ?>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input 
                    type="email" 
                    name="email"
                    value="<?= set_value('email'); ?>"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#0b5c5d] focus:outline-none"
                    placeholder="name@example.com"
                    required
                >
                <p class="text-red-500 text-xs mt-1">
                    <?= form_error('email'); ?>
                </p>
                    
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                Password
                </label>

                    <div class="relative">
                        <input 
                        id="password"
                        type="password" 
                        name="password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#0b5c5d] focus:outline-none pr-10"
                        placeholder="••••••••"
                        required
                        >
                        <!-- Toggle Button -->
                        <button 
                            type="button"
                            onclick="togglePassword()"
                            class="absolute right-3 top-2.5 text-gray-500 hover:text-[#0b5c5d] text-sm"
                        >
                            Show
                        </button>
                    </div>

                <p class="text-red-500 text-xs mt-1">
                    <?= form_error('password'); ?>
                </p>
            </div>

            <!-- Button -->
            <button 
                type="submit"
                class="w-full bg-[#f3821a] text-white py-2 rounded-lg hover:bg-[#d67012] hover:scale-105 transition duration-200"
            >
                Login
            </button>
            <?php 
            if(validation_errors()):?>
                <div style="color: orange;">
                    <?= validation_errors(); ?>

                </div>
            <?php endif; ?>
            <!-- Register Link -->
            <p class="text-center text-sm text-gray-600 mt-4">
                Jika tidak ada akun,
                <a href="<?= base_url('/register'); ?>" 
                   class="text-[#f3821a] font-semibold hover:underline">
                    Register
                </a>
            </p>

            <?php echo form_close(); ?>

        </div>
    </div>

</div>

</body>
</html>