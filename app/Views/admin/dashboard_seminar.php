<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-small {
            width: 90px;
            padding: 6px 10px;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .btn-small i {
            font-size: 0.75rem;
            margin-right: 4px;
        }
        
        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        
        table th,
        table td {
            border: none;
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        
        table tr:hover {
            background-color: #f9fafb;
        }
    </style>
</head>
<body class="bg-[#EEF5FF] h-screen flex">

    <!-- Sidebar and Header -->
    <?php include 'sidebar.php'; ?>
    <?php include 'header.php'; ?>
    <?php include 'footer.php'; ?>
    
    <!-- Main Content Wrapper with Bottom Padding -->
    <div class="flex-1 pl-[242px] px-8 py-8 pt-[90px] overflow-auto pb-[50px]">

        <!-- Header Section -->
        <h1 class="text-[24px] font-bold mb-5" style="color: #176B87;">Dashboard</h1>

        <!-- Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
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

        <div class="flex justify-between items-center mb-5">
            <h2 class="text-[24px] font-bold" style="color: #176B87;">Aktivitas Terbaru</h2>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <!-- Tabs Section -->
            <div class="flex border-b mb-4">
                <a href="<?= site_url('admin/dashboard') ?>" class="px-4 py-2 bg-gray-200 hover:bg-[#176B87] hover:text-white transition text-[#176B87] rounded-t-lg text-sm">
                    Materi
                </a>
                <a href="<?= site_url('admin/dashboard_seminar') ?>" class="px-4 py-2 border-t border-l border-r rounded-t-lg bg-[#176B87] hover:bg-[#176B87] hover:text-white transition text-white text-sm">
                    Info Seminar
                </a>
                <a href="<?= site_url('admin/dashboard_pengguna') ?>" class="px-4 py-2 bg-gray-200 hover:bg-[#176B87] hover:text-white transition text-[#176B87] rounded-t-lg text-sm">
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
                            <th class="border px-4 py-2 text-sm">Judul Acara</th>
                            <th class="border px-4 py-2 text-sm">Penyelenggara</th>
                            <th class="border px-4 py-2 text-sm">Tanggal Acara</th>
                            <th class="border px-4 py-2 text-sm">Status</th>
                            <th class="border px-4 py-2 w-32 text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($seminars as $seminar): ?>
                        <tr>
                            <td class="border px-4 py-2 text-sm"><?= $no++ ?></td>
                            <td class="border px-4 py-2 text-sm"><?= esc($seminar['judul']) ?></td>
                            <td class="border px-4 py-2 text-sm"><?= esc($seminar['penyelenggara']) ?></td>
                            <td class="border px-4 py-2 text-sm"><?= esc($seminar['tanggal']) ?></td>
                            <td class="border px-4 py-2 text-sm">
                                <span class="<?= $seminar['status'] === 'published' ? 'text-[#176B87]' : 'text-[#44F12D]' ?>">
                                    <?= ucfirst($seminar['status']) ?>
                                </span>
                            </td>
                            <td class="border px-4 py-2 flex space-x-3 text-sm">
                                <a href="<?= site_url('admin/editSeminar/' . $seminar['seminar_id'] . '?from=dashboard_seminar') ?>" 
                                   class="bg-[#176B87] text-white btn-small rounded text-center inline-flex items-center">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="#" 
                                   class="bg-red-500 text-white btn-small rounded text-center inline-flex items-center"
                                   onclick="confirmDeletion(<?= $seminar['seminar_id']; ?>)">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-right mt-4">
                <a href="<?= site_url('admin/seminar') ?>" class="text-[#176B87] text-sm hover:underline">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
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

        function confirmDeletion(id) {
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus seminar?',
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
                    window.location.href = '<?= site_url('admin/hapusSeminar/') ?>' + id + '?from=dashboard_seminar';
                }
            });
        }
    </script>

</body>
</html>