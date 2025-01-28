<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keamanan Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <?php include 'navbar.php'; ?>

    <div class="max-w-6xl mx-auto p-4">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Profile Card -->
            <div class="w-full md:w-72 bg-white p-6 rounded-lg shadow text-center">
                <div class="mx-auto bg-gray-200 rounded-full w-32 h-32 flex items-center justify-center mb-4">
                    <?php if (session('foto_profile')): ?>
                        <img src="<?= base_url('uploads/profile/' . session('foto_profile')) ?>" alt="Profile" class="w-full h-full rounded-full object-cover">
                    <?php else: ?>
                        <svg class="w-16 h-16 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke-width="2" stroke-linecap="round" />
                            <circle cx="12" cy="7" r="4" stroke-width="2" />
                        </svg>
                    <?php endif; ?>
                </div>
                <p class="text-gray-600 mb-2"><?= session('username') ?></p>
                <h2 class="text-xl font-bold text-gray-800 mb-4"><?= session('nama_lengkap') ?></h2>

                <form action="<?= base_url('user/updatePhoto') ?>" method="post" enctype="multipart/form-data" class="mb-2">
                    <input type="file" name="foto_profile" id="foto_profile" class="hidden" onchange="this.form.submit()">
                    <button type="button" onclick="document.getElementById('foto_profile').click()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Upload
                    </button>
                </form>

                <?php if (session('foto_profile')): ?>
                    <form action="<?= base_url('user/deletePhoto') ?>" method="post">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Hapus
                        </button>
                    </form>
                <?php endif; ?>
            </div>

            <!-- Security Form Section -->
            <div class="flex-1 bg-white rounded-lg shadow p-6">
                <div class="border-b pb-4 mb-6">
                    <h2 class="text-xl text-blue-600 font-semibold mb-4">Profil</h2>
                    <div class="flex gap-4 text-blue-600 font-medium">
                        <a href="<?= base_url('user/editProfile') ?>" class="text-gray-500 hover:text-blue-600">Info User</a>
                        <a href="<?= base_url('user/keamanan') ?>" class="border-b-2 border-blue-600 pb-2">Keamanan</a>
                    </div>
                </div>

                <!-- Flash Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <!-- Password Update Form -->
               <!-- Form Password Update -->
<form action="<?= base_url('user/updatePassword') ?>" method="post" class="space-y-6">
    <div class="space-y-4">
        <!-- Old Password -->
        <div>
            <label for="old_password" class="block text-gray-600 mb-2">Password lama</label>
            <div class="relative">
                <input type="password" id="old_password" name="old_password" class="w-full p-2 pr-10 rounded-md bg-gray-50 border" required>
                <button type="button" class="absolute right-2 top-2.5 text-gray-500" onclick="togglePassword(this)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- New Password -->
        <div>
            <label for="new_password" class="block text-gray-600 mb-2">Password baru</label>
            <div class="relative">
                <input type="password" id="new_password" name="new_password" class="w-full p-2 pr-10 rounded-md bg-gray-50 border" required>
                <button type="button" class="absolute right-2 top-2.5 text-gray-500" onclick="togglePassword(this)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="confirm_password" class="block text-gray-600 mb-2">Konfirmasi password baru</label>
            <div class="relative">
                <input type="password" id="confirm_password" name="confirm_password" class="w-full p-2 pr-10 rounded-md bg-gray-50 border" required>
                <button type="button" class="absolute right-2 top-2.5 text-gray-500" onclick="togglePassword(this)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="flex gap-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Perbarui
        </button>
        <a href="<?= base_url('user/profile') ?>" class="text-gray-600 px-6 py-2 rounded border hover:bg-gray-50">
            Batal
        </a>
    </div>
</form>

            </div>
        </div>
    </div>

    <script>
        function togglePassword(button) {
            const input = button.parentElement.querySelector('input');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }
    </script>
</body>
</html>