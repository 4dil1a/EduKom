<!-- app/Views/profile/index.php -->
<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduKom - Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="h-full">
<?php include 'navbar.php'; ?>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Column -->
            <div class="col-span-1">
              
            <!-- Profile Card -->
<!-- Profile Card -->
<div class="bg-white rounded-lg shadow p-6 text-center">
    <!-- app/Views/profile/index.php -->
    <div class="mx-auto w-24 h-24 bg-gray-200 rounded-full overflow-hidden mb-4">
    <?php if (session('foto_profil')) : ?>
        <img src="<?= base_url('uploads/gambar/' . session('foto_profil')) ?>" 
             alt="Profile Photo" 
             class="w-full h-full object-cover">
    <?php else : ?>
        <i class="fas fa-user text-4xl text-gray-400 mt-6"></i>
    <?php endif; ?>
</div>

    <h2 class="text-xl font-semibold mb-4"><?= session('nama_lengkap') ?></h2>
    <div class="flex justify-center space-x-3">
        <button 
            class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
            onclick="window.location.href='/user/editProfile'">
            Edit Profil
        </button>
        <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
    </div>
</div>


                <!-- Contact Info -->
                <div class="bg-white rounded-lg shadow p-6 mt-6">
                    <div class="space-y-4">
                    <div>
                        <p class="text-gray-600">No HP</p>
                        <p class="font-medium"><?= session('no_hp'); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600">Email</p>
                        <p class="font-medium"><?= session('email'); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600">Facebook</p>
                        <p class="font-medium"><?= session('fb'); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600">Instagram</p>
                        <p class="font-medium"><?= session('ig'); ?></p>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-span-1 md:col-span-2">
                <!-- Profile Details -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4">Profil</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600">Nama Lengkap</p>
                            <p class="font-medium"><?= session('nama_lengkap'); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-600">Username</p>
                            <p class="font-medium"><?= session('username'); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-600">Alamat</p>
                            <p class="font-medium"><?= session('alamat'); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-600">Jenis Kelamin</p>
                            <p class="font-medium"><?= session('jenis_kelamin') == 'L' ? 'Laki-laki' : 'Perempuan'; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Hasil kuis -->
               <!-- Hasil kuis -->
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold mb-4">Riwayat Kuis</h3>
    <?php if (!empty($quiz_results)): ?>
        <div class="divide-y divide-gray-200">
            <?php foreach ($quiz_results as $result): ?>
                <div class="py-3">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium"><?= $result['judul'] ?></p>
                            <p class="text-sm text-gray-500">
                                <?= date('d M Y H:i', strtotime($result['created_at'])) ?>
                            </p>
                        </div>
                        <span class="text-lg font-bold 
                            <?= $result['score'] >= 70 ? 'text-green-600' : 'text-red-600' ?>">
                            <?= $result['score'] ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-gray-500 text-center">Belum ada riwayat kuis</p>
    <?php endif; ?>
</div>


            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#006d77] text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h3 class="text-xl font-bold mb-4">About Us</h3>
            <p class="mb-6">
                EduKom adalah platform pembelajaran Edukatif yang dikhususkan pada Dinas Komunikasi dan Informatika. 
                Digunakan untuk memberikan pelayanan pembelajaran digital kepada masyarakat dengan berbagai aktivitas 
                edukasi serta keamanan data.
            </p>
            <div class="flex space-x-6">
                <a href="#" class="hover:opacity-80">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
                <a href="#" class="hover:opacity-80">
                    <i class="fab fa-facebook fa-lg"></i>
                </a>
                <a href="#" class="hover:opacity-80">
                    <i class="fab fa-youtube fa-lg"></i>
                </a>
            </div>
        </div>
    </footer>
</body>
</html>