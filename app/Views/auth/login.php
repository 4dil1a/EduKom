<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-custom {
            background-color: #176B87;
        }
        .bg-overlay {
            background-color: rgba(23, 107, 135, 0.7);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative" style="background-image: url('<?= base_url() ?>/bg.png'); background-size: cover; background-position: center;">
    <!-- Background Overlay -->
    <div class="absolute inset-0 bg-overlay"></div>

    <!-- Login Card -->
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md relative z-10">
        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="<?= base_url() ?>/logo.png" alt="Logo" class="mx-auto w-16 h-16 mb-4">
            <h2 class="text-2xl font-bold text-[#176B87]">MASUK</h2>
        </div>

        <!-- Login Form -->
        <form method="post" action="<?= site_url('auth/loginAction'); ?>" class="space-y-6">
            <!-- Username Field -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input 
                    type="text" 
                    name="username" 
                    id="username"
                    required
                    placeholder="Username"
                    aria-label="Username"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#176B87] focus:border-[#176B87] transition duration-150 ease-in-out"
                >
            </div>

            <!-- Password Field -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input 
                    type="password" 
                    name="password" 
                    id="password"
                    required
                    placeholder="Password"
                    aria-label="Password"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#176B87] focus:border-[#176B87] transition duration-150 ease-in-out"
                >
            </div>

            <!-- reCAPTCHA -->
            <div class="g-recaptcha" data-sitekey="6LcLBrkqAAAAAOL6mCUid-rp_gKRtMJPl2t9f4xE"></div>

            <!-- Login Button -->
            <button 
                type="submit"
                class="w-full bg-[#176B87] text-white py-2 px-4 rounded-md hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-[#176B87] focus:ring-offset-2 transition duration-150 ease-in-out font-medium"
            >
                MASUK
            </button>
        </form>

        <!-- Links -->
        <div class="mt-6 flex items-center justify-between text-sm">
            <a href="<?= site_url('auth/lupapw'); ?>" class="text-[#176B87] hover:text-opacity-80">
                Lupa kata sandi?
            </a>
            <a href="<?= site_url('auth/register'); ?>" class="text-[#176B87] hover:text-opacity-80">
                Daftar
            </a>
        </div>

        <!-- Error Message -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- reCAPTCHA Script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
