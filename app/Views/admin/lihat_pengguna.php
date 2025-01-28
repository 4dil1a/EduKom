<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#EEF5FF] h-screen flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <?php include 'header.php'; ?>
        <?php include 'footer.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 pl-[242px] px-8 py-8 pt-[90px] overflow-auto pb-[50px]">
        <div class="flex items-center gap-3 mb-3">
            <a href="<?= $backUrl ?>" class="text-[24px] text-gray-600 hover:text-gray-800 font-bold">
                <i class="fas fa-arrow-left"></i> 
            </a>
            <h1 class="text-[24px] font-bold" style="color: #176B87;">Lihat Data</h1>
        </div>
            <!-- Card Wrapper -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" value="<?= esc($user['nama_lengkap']) ?>" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 p-2" readonly />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                <input type="text" value="<?= esc($user['alamat']) ?>" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 p-2" readonly />
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" value="<?= esc($user['username']) ?>" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 p-2" readonly />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <input type="text" value="<?= esc($user['jenis_kelamin']) ?>" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 p-2" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Media Sosial</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">No. Hp</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-green-600">
                                            <i class="fas fa-phone-alt"></i>
                                        </span>
                                        <input type="text" value="<?= esc($user['no_hp']) ?>" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border-gray-300 bg-gray-50" readonly />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="text" value="<?= esc($user['email']) ?>" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border-gray-300 bg-gray-50" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Instagram</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-pink-500">
                                            <i class="fab fa-instagram"></i>
                                        </span>
                                        <input type="text" value="<?= esc($user['ig']) ?>" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border-gray-300 bg-gray-50" readonly />
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Facebook</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-blue-600">
                                            <i class="fab fa-facebook-f"></i>
                                        </span>
                                        <input type="text" value="<?= esc($user['fb']) ?>" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border-gray-300 bg-gray-50" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Keamanan</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="text" value="<?= esc($user['password']) ?>" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 p-2" readonly />
                        </div>
                    </div>

                    <!-- Additional user details if needed -->
                    <?php if (isset($user['role'])): ?>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <input type="text" value="<?= esc($user['role']) ?>" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 p-2" readonly />
                    </div>
                    <?php endif; ?>

                    <?php if (isset($user['created_at'])): ?>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Dibuat pada</label>
                        <input type="text" value="<?= esc($user['created_at']) ?>" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 p-2" readonly />
                    </div>
                    <?php endif; ?>

                    <?php if (isset($user['updated_at'])): ?>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Terakhir diupdate</label>
                        <input type="text" value="<?= esc($user['updated_at']) ?>" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 p-2" readonly />
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
</body>
</html>
