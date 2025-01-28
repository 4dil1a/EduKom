<!-- edit_profile.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php include 'navbar.php'; ?>
<body class="bg-gray-50">
    <div class="max-w-6xl mx-auto p-4">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Profile Card -->
            <div class="w-full md:w-72 bg-white p-6 rounded-lg shadow text-center">
                <div class="mx-auto bg-gray-200 rounded-full w-32 h-32 flex items-center justify-center mb-4">
                    <?php if(session('foto_profile')): ?>
                        <img src="<?= base_url('uploads/profile/' . session('foto_profile')) ?>" alt="Profile" class="w-full h-full rounded-full object-cover">
                    <?php else: ?>
                        <svg class="w-16 h-16 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="12" cy="7" r="4" stroke-width="2"/>
                        </svg>
                    <?php endif; ?>
                </div>
                <p class="text-gray-600 mb-2"><?= session('username') ?></p>
                <h2 class="text-xl font-bold text-gray-800 mb-4"><?= session('nama_lengkap') ?></h2>
                <form action="<?= base_url('user/updatePhoto') ?>" method="post" enctype="multipart/form-data" class="mb-2">
    <input type="file" 
           name="foto_profile" 
           id="foto_profile" 
           class="hidden" 
           accept="image/*"
           onchange="this.form.submit()">
    <label for="foto_profile" 
           class="bg-blue-600 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-700">
        Upload Photo
    </label>
</form>
                <?php if(session('foto_profile')): ?>
                    <form action="<?= base_url('user/deletePhoto') ?>" method="post">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
                    </form>
                <?php endif; ?>
            </div>

            <!-- Form Section -->
            <div class="flex-1 bg-white rounded-lg shadow p-6">
                <div class="border-b pb-4 mb-6">
                    <h2 class="text-xl text-blue-600 font-semibold mb-4">Profil</h2>
                    <div class="flex gap-4 text-blue-600 font-medium">
                        <a href="<?= base_url('user/profile') ?>" class="border-b-2 border-blue-600 pb-2">Info User</a>
                        <a href="<?= base_url('user/keamanan') ?>" class="text-gray-500">Keamanan</a>
                    </div>
                </div>

                <?php if(session()->getFlashdata('success')): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('user/updateProfile') ?>" method="post" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-600 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="w-full p-2 rounded-md bg-gray-50 border" 
                                value="<?= session('nama_lengkap') ?>" required>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-2">Username</label>
                            <input type="text" name="username" class="w-full p-2 rounded-md bg-gray-50 border" 
                                value="<?= session('username') ?>" readonly>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-2">Alamat</label>
                            <input type="text" name="alamat" class="w-full p-2 rounded-md bg-gray-50 border" 
                                value="<?= session('alamat') ?>">
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-2">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full p-2 rounded-md bg-gray-50 border">
                                <option value="L" <?= session('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= session('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-blue-600 font-semibold mb-4">Media Sosial</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-600 mb-2">No. Hp</label>
                                <input type="tel" name="no_hp" class="w-full p-2 rounded-md bg-gray-50 border" 
                                    value="<?= session('no_hp') ?>">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Instagram</label>
                                <input type="text" name="ig" class="w-full p-2 rounded-md bg-gray-50 border" 
                                    value="<?= session('ig') ?>">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Email</label>
                                <input type="email" name="email" class="w-full p-2 rounded-md bg-gray-50 border" 
                                    value="<?= session('email') ?>">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Facebook</label>
                                <input type="text" name="fb" class="w-full p-2 rounded-md bg-gray-50 border" 
                                    value="<?= session('fb') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                            Perbarui
                        </button>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
