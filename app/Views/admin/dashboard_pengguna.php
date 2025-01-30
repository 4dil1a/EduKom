<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .card:hover {
            transform: translateY(-5px);
        }

        .btn-small {
            width: 80px;
            padding: 6px 10px;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .btn-small i {
            font-size: 0.75rem;
        }

        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        table th,
        table td {
            border: none;
            padding: 12px 24px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        table tr:hover {
            background-color: #f9fafb;
        }
    </style>
</head>
<body class="bg-[#EEF5FF] h-screen flex">

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
    <?php include 'header.php'; ?>
    <?php include 'footer.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 pl-[242px] px-8 py-8 pt-[90px] overflow-auto pb-[50px]">
        <!-- Header Section -->
        <h1 class="text-[24px] font-bold mb-5" style="color: #176B87;">Dashboard</h1>

        <!-- Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Card Materi -->
            <a href="<?= site_url('admin/materi') ?>" class="card block bg-white p-5 rounded-lg shadow hover:bg-blue-50 transition w-[230px]">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-[#176B87] text-white flex items-center justify-center rounded-md">
                        <i class="fas fa-book text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Materi</h3>
                        <p class="text-gray-500 text-sm"><?= $jumlahMateri ?> Materi</p>
                    </div>
                </div>
            </a>

            <!-- Card Seminar -->
            <a href="<?= site_url('admin/seminar') ?>" class="card block bg-white p-5 rounded-lg shadow hover:bg-blue-50 transition w-[230px]">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-[#176B87] text-white flex items-center justify-center rounded-md">
                        <i class="fas fa-info-circle text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Info Seminar</h3>
                        <p class="text-gray-500 text-sm"><?= $jumlahSeminar ?> Seminar</p>
                    </div>
                </div>
            </a>

            <!-- Card Pengguna -->
            <a href="<?= site_url('admin/data_pengguna') ?>" class="card block bg-white p-5 rounded-lg shadow hover:bg-blue-50 transition w-[230px]">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-[#176B87] text-white flex items-center justify-center rounded-md">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Pengguna</h3>
                        <p class="text-gray-500 text-sm"><?= $jumlahPengguna ?> Pengguna</p>
                    </div>
                </div>
            </a>

            <!-- Card Kuis -->
            <a href="<?= site_url('admin/kuis') ?>" class="card block bg-white p-5 rounded-lg shadow hover:bg-blue-50 transition w-[230px]">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-[#176B87] text-white flex items-center justify-center rounded-md">
                        <i class="fas fa-tasks text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Kuis</h3>
                        <p class="text-gray-500 text-sm"><?= $jumlahKuis ?> Kuis</p>
                    </div>
                </div>
            </a>
        </div>

        <h2 class="text-[24px] font-bold mb-5" style="color: #176B87;">Aktivitas Terbaru</h2>
        <div class="bg-white rounded-lg shadow p-6">
            <!-- Tabs -->
            <div class="flex border-b mb-4">
                <a href="<?= site_url('admin/dashboard') ?>" class="px-4 py-2 bg-gray-200 hover:bg-[#176B87] hover:text-white transition text-[#176B87] rounded-t-lg text-sm">
                    Materi
                </a>
                <a href="<?= site_url('admin/dashboard_seminar') ?>" class="px-4 py-2 bg-gray-200 hover:bg-[#176B87] hover:text-white transition text-[#176B87] rounded-t-lg text-sm">
                    Info Seminar
                </a>
                <a href="<?= site_url('admin/dashboard_pengguna') ?>" class="px-4 py-2 border-t border-l border-r rounded-t-lg bg-[#176B87] hover:bg-[#176B87] hover:text-white transition text-white text-sm">
                    Data Pengguna
                </a>
                <a href="<?= site_url('admin/dashboard_kuis') ?>" class="px-4 py-2 bg-gray-200 hover:bg-[#176B87] hover:text-white transition text-[#176B87] rounded-t-lg text-sm">
                    Kuis
                </a>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2 w-16 text-sm">No</th>
                            <th class="border px-4 py-2 text-sm">Foto Profil</th>
                            <th class="border px-4 py-2 text-sm">Nama Lengkap</th>
                            <th class="border px-4 py-2 text-sm">Username</th>
                            <th class="border px-4 py-2 text-sm">Password</th>
                            <th class="border px-4 py-2 w-32 text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($pengguna as $pengguna): ?>
                        <tr class="border-b border-gray-200 last:border-b-0 hover:bg-gray-50">
                            <td class="py-4 px-6 text-sm text-gray-800"><?= $no++ ?></td>
                            <td class="py-4 px-6">
                                <img src="<?= base_url('uploads/' . esc($pengguna['foto_profil'])) ?>" alt="Foto Profil" class="w-12 h-12 rounded-full">
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-800"><?= esc($pengguna['nama_lengkap']) ?></td>
                            <td class="py-4 px-6 text-sm text-gray-800"><?= esc($pengguna['username']) ?></td>
                            <td class="py-4 px-6 text-sm text-gray-800"><?= esc($pengguna['password']) ?></td>
                            <td class="py-4 px-6">
                                <div class="flex gap-2">
                                    <a href="<?= site_url('admin/lihatPengguna/' . $pengguna['user_id']) ?>" 
                                       class="bg-[#176B87] text-white btn-small rounded text-center inline-flex items-center">
                                        <i class="fas fa-eye"></i>
                                        <span>Lihat</span>
                                    </a>
                                    <a href="#" 
                                       class="bg-red-500 text-white btn-small rounded text-center inline-flex items-center"
                                       onclick="confirmDeletion(<?= $pengguna['user_id']; ?>)">
                                        <i class="fas fa-trash"></i>
                                        <span>Hapus</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Link to view all users -->
            <div class="text-right mt-4">
                <a href="<?= site_url('admin/data_pengguna'); ?>" class="text-[#176B87] text-sm">Lihat Semua <i class="fas fa-arrow-right ml-1"></i></a> 
            </div>
        </div>
    </div>

    <script>
        // Function to show SweetAlert success message
        function showSuccessMessage(message) {
            Swal.fire({
                title: 'Berhasil!',
                text: message,
                icon: 'success',
                confirmButtonColor: '#176B87',
                customClass: {
                    confirmButton: 'py-2 px-4 rounded-md'
                }
            });
        }

        // Function to show SweetAlert error message
        function showErrorMessage(message) {
            Swal.fire({
                title: 'Error!',
                text: message,
                icon: 'error',
                confirmButtonColor: '#DC2626',
                customClass: {
                    confirmButton: 'py-2 px-4 rounded-md text-white'
                }
            });
        }

        // Check for flash messages when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            <?php if(session()->getFlashdata('success')): ?>
                showSuccessMessage('<?= session()->getFlashdata('success') ?>');
            <?php endif; ?>

            <?php if(session()->getFlashdata('error')): ?>
                showErrorMessage('<?= session()->getFlashdata('error') ?>');
            <?php endif; ?>
        });

        // Delete Confirmation Function
        function confirmDeletion(id) {
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus pengguna?',
                text: '',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E5F6FF',
                cancelButtonColor: '#DC2626',
                confirmButtonText: '<span style="color: #176B87;">Ya</span>',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'py-2 px-4 rounded-md',
                    cancelButton: 'py-2 px-4 rounded-md text-white',
                    popup: 'rounded-md small-popup',
                    title: 'text-lg',
                    content: 'text-sm'
                },
                width: '350px',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= site_url('admin/hapusPengguna/') ?>' + id + '?from=dashboard_pengguna';
                }
            });
        }
    </script>

</body>
</html>