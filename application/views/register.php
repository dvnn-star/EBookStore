<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EBookStore</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);

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

        <!-- LEFT SIDE -->
        <div class="flex flex-col justify-center items-center text-white p-6 md:p-10 bg-[#0b5c5d]">
            <h1 class="text-3xl font-bold mb-4" onclick="window.location.href='<?= base_url(); ?>'">EBookStore</h1>
            <p class="text-gray-100 text-center text-sm">
                Buat akun untuk mulai menjelajahi ribuan e-book terbaik.
            </p>
        </div>

        <!-- RIGHT SIDE -->
        <div class="bg-white p-8 md:p-10">

            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
                Create Account
            </h2>

            <!-- Error Flash Message -->
            <?php if($this->session->flashdata('error')): ?>
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                    <span class="font-semibold">✕</span> <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <!-- Success Flash Message -->
            <?php if($this->session->flashdata('success')): ?>
                <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                    <span class="font-semibold">✓</span> <?= $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php echo form_open('auth/register'); ?>

            <!-- Full Name (DIPERBAIKI: Sesuai dengan PHP validation 'full_name') -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Full Name
                </label>
                <input 
                    type="text" 
                    name="full_name"
                    value="<?= set_value('full_name'); ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b5c5d] focus:border-[#0b5c5d] focus:outline-none"
                    placeholder="Your full name"
                    required
                >
                <?php if(form_error('full_name')): ?>
                    <p class="text-red-500 text-xs mt-1">
                        <span class="font-semibold">⚠</span> <?= form_error('full_name'); ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email Address
                </label>
                <input 
                    type="email" 
                    name="email"
                    value="<?= set_value('email'); ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b5c5d] focus:border-[#0b5c5d] focus:outline-none"
                    placeholder="name@example.com"
                    required
                >
                <?php if(form_error('email')): ?>
                    <p class="text-red-500 text-xs mt-1">
                        <span class="font-semibold">⚠</span> <?= form_error('email'); ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password (Min. 6 characters)
                </label>

                <div class="relative">
                    <input 
                        id="password"
                        type="password" 
                        name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b5c5d] focus:border-[#0b5c5d] focus:outline-none pr-12"
                        placeholder="••••••••"
                        minlength="6"
                        required
                    >
                    <button 
                        type="button"
                        onclick="togglePassword('password', this)"
                        class="absolute right-3 top-2.5 text-gray-500 hover:text-[#0b5c5d] text-xs font-semibold transition"
                    >
                        Show
                    </button>
                </div>

                <?php if(form_error('password')): ?>
                    <p class="text-red-500 text-xs mt-1">
                        <span class="font-semibold">⚠</span> <?= form_error('password'); ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Confirm Password (DIPERBAIKI: Sesuai dengan PHP validation 'confirm_password') -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Confirm Password
                </label>

                <div class="relative">
                    <input 
                        id="confirm_password"
                        type="password" 
                        name="confirm_password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b5c5d] focus:border-[#0b5c5d] focus:outline-none pr-12"
                        placeholder="••••••••"
                        minlength="6"
                        required
                    >
                    <button 
                        type="button"
                        onclick="togglePassword('confirm_password', this)"
                        class="absolute right-3 top-2.5 text-gray-500 hover:text-[#0b5c5d] text-xs font-semibold transition"
                    >
                        Show
                    </button>
                </div>

                <?php if(form_error('confirm_password')): ?>
                    <p class="text-red-500 text-xs mt-1">
                        <span class="font-semibold">⚠</span> <?= form_error('confirm_password'); ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit"
                class="w-full bg-[#f3821a] text-white font-semibold py-2.5 rounded-lg hover:bg-[#d67012] hover:scale-105 transition duration-200"
            >
                Create Account
            </button>

            <?php echo form_close(); ?>

            <!-- Link to Login -->
            <p class="text-center text-sm text-gray-600 mt-6">
                Already have an account?
                <a href="<?= base_url('login'); ?>" 
                   class="text-[#f3821a] font-semibold hover:underline transition">
                    Login here
                </a>
            </p>

        </div>
    </div>

</div>

</body>
</html>