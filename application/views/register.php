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

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700">

<div class="min-h-screen flex items-center justify-center px-4 py-6 sm:px-6">

    <div class="w-full max-w-5xl mx-auto 
                bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden 
                grid grid-cols-1 md:grid-cols-2">

        <!-- LEFT SIDE -->
        <div class="flex flex-col justify-center items-center text-white p-6 md:p-10 bg-gradient-to-br from-black/70 to-gray-900/70">
            <h1 class="text-3xl font-bold mb-4">EBookStore</h1>
            <p class="text-gray-300 text-center text-sm">
                Buat akun untuk mulai menjelajahi ribuan e-book terbaik.
            </p>
        </div>

        <!-- RIGHT SIDE -->
        <div class="bg-white p-8 md:p-10">

            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
                Create Account
            </h2>

            <?php if($this->session->flashdata('error')): ?>
                <div class="mb-4 text-sm text-red-600 bg-red-100 p-3 rounded-lg">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <?php echo form_open('auth/register'); ?>

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Full Name
                </label>
                <input 
                    type="text" 
                    name="name"
                    value="<?= set_value('name'); ?>"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-black focus:outline-none"
                    placeholder="Your name"
                    required
                >
                <p class="text-red-500 text-xs mt-1">
                    <?= form_error('name'); ?>
                </p>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input 
                    type="email" 
                    name="email"
                    value="<?= set_value('email'); ?>"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-black focus:outline-none"
                    placeholder="name@example.com"
                    required
                >
                <p class="text-red-500 text-xs mt-1">
                    <?= form_error('email'); ?>
                </p>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>

                <div class="relative">
                    <input 
                        id="password"
                        type="password" 
                        name="password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-black focus:outline-none pr-10"
                        placeholder="••••••••"
                        required
                    >
                    <button 
                        type="button"
                        onclick="togglePassword('password', this)"
                        class="absolute right-3 top-2.5 text-gray-500 hover:text-black text-sm"
                    >
                        Show
                    </button>
                </div>

                <p class="text-red-500 text-xs mt-1">
                    <?= form_error('password'); ?>
                </p>
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Confirm Password
                </label>

                <div class="relative">
                    <input 
                        id="password2"
                        type="password" 
                        name="password2"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-black focus:outline-none pr-10"
                        placeholder="••••••••"
                        required
                    >
                    <button 
                        type="button"
                        onclick="togglePassword('password2', this)"
                        class="absolute right-3 top-2.5 text-gray-500 hover:text-black text-sm"
                    >
                        Show
                    </button>
                </div>

                <p class="text-red-500 text-xs mt-1">
                    <?= form_error('password2'); ?>
                </p>
            </div>

            <!-- Button -->
            <button 
                type="submit"
                class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 transition duration-200"
            >
                Register
            </button>

            <?php echo form_close(); ?>

            <!-- Back to login -->
            <p class="text-center text-sm text-gray-600 mt-4">
                Already have an account?
                <a href="<?= base_url('login'); ?>" 
                   class="text-blue-500 font-semibold hover:underline">
                    Login
                </a>
            </p>

        </div>
    </div>

</div>

</body>
</html>