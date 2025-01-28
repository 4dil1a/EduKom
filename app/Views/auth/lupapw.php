<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-overlay {
            background-color: rgba(23, 107, 135, 0.7);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center" style="background-image: url('<?= base_url() ?>/bg.png'); background-size: cover; background-position: center;">
    <!-- Background Overlay -->
    <div class="absolute inset-0 bg-overlay"></div>

    <!-- Lupa Password Card -->
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md relative z-10">
        <!-- Title -->
        <div class="text-center mb-6">
            <img src="<?= base_url() ?>/logo.png" alt="Logo" class="mx-auto w-16 h-16 mb-4">
            <h2 class="text-2xl font-bold text-[#176B87]">LUPA PASSWORD</h2>
        </div>

        <!-- Information Text -->
        <p class="text-center text-gray-700 mb-6">Jika Anda lupa password, silakan hubungi admin untuk bantuan.</p>

        <!-- Contact Button -->
        <div class="flex justify-center mb-6">
            <a href="https://wa.me/6289646303500" style="text-decoration: none;">
                <button 
                    type="button" 
                    class="bg-[#176B87] text-white py-2 px-4 rounded-md hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-[#176B87] focus:ring-offset-2 transition duration-150 ease-in-out font-medium"
                >
                    Hubungi Admin
                </button>
            </a>
        </div>

        <!-- Back to Login Link -->
        <div class="text-center">
            <a href="<?= site_url('auth/login'); ?>" class="text-[#176B87] hover:text-opacity-80">
                Kembali ke Login
            </a>
        </div>
    </div>
</body>
</html>