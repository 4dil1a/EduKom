<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Data Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
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

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
    <?php include 'header.php'; ?>
    <?php include 'footer.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 pl-[242px] px-8 py-8 pt-[90px] overflow-auto pb-[50px]">
        <h1 class="text-[24px] font-bold mb-4" style="color: #176B87;">Data Pengguna</h1>
        <div class="bg-white rounded-lg shadow p-6">
            <!-- Filter Pencarian dan Pilihan Jumlah Entri -->
            <div class="mt-4 mb-4 flex justify-between items-center">
                <div class="inline-flex items-center text-sm text-gray-600">
                    <span>Lihat</span>
                    <select id="entriesSelect" class="minimal-select mx-2" onchange="updateEntriesPerPage()">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="15">15</option>
                    </select>
                    <span>entri</span>
                </div>

                <div class="w-full max-w-xs">
                    <input 
                        type="text" 
                        id="search" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg" 
                        placeholder="Cari pengguna..."
                        oninput="filterUsers()"
                    >
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto mb-6">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-sm w-16">No</th>
                            <th class="px-6 py-3 text-left text-sm">Foto Profil</th>
                            <th class="px-6 py-3 text-left text-sm">Nama Lengkap</th>
                            <th class="px-6 py-3 text-left text-sm">Username</th>
                            <th class="px-6 py-3 text-left text-sm">Password</th>
                            <th class="px-6 py-3 text-left text-sm w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody"></tbody>
                </table>
            </div>

            <!-- Pagination and Entries Display -->
            <div class="flex justify-between items-center mt-4">
                <div class="text-sm text-gray-600">
                    Lihat <span id="currentEntries">0</span> dari <span id="totalEntries">0</span> entri
                </div>

                <div class="flex items-center space-x-2">
                    <button id="prevBtn" class="text-[#176B87] text-2xl font-semibold opacity-50 px-3 py-1" onclick="changePage('prev')" disabled>
                        &lt;
                    </button>
                    <span id="pageNumber" class="text-sm text-gray-600"></span>
                    <button id="nextBtn" class="text-[#176B87] text-2xl font-semibold opacity-50 px-3 py-1" onclick="changePage('next')">
                        &gt;
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    let users = <?= json_encode($users ?? []); ?>;
    let filteredUsers = [...users];
    let entriesPerPage = 10;
    let currentPage = 1;

    function confirmDelete(userId) {
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
                window.location.href = `/admin/hapusPengguna/${userId}`;
            }
        });
    }

    function renderTable() {
        const startIndex = (currentPage - 1) * entriesPerPage;
        const endIndex = Math.min(startIndex + entriesPerPage, filteredUsers.length);
        const tableBody = document.getElementById('userTableBody');
        tableBody.innerHTML = '';

        for (let i = startIndex; i < endIndex; i++) {
            const user = filteredUsers[i];
            const row = `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-800">${i + 1}</td>
                    <td class="px-6 py-4">
                        <img src="${user.foto_profil ? '<?= base_url('uploads/gambar/') ?>' + user.foto_profil : 'https://via.placeholder.com/50'}" alt="Foto Profil" class="w-12 h-12 rounded-full">
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800">${user.nama_lengkap}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">${user.username}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">${user.password}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="/admin/lihatPengguna/${user.user_id}" class="btn-small bg-[#176B87] text-white rounded-md hover:bg-[#105570] flex items-center gap-1">
                                <i class="fas fa-eye"></i>
                                <span>Lihat</span>
                            </a>
                            <button onclick="confirmDelete(${user.user_id})" class="btn-small bg-red-500 text-white rounded-md hover:bg-red-600 flex items-center gap-1">
                                <i class="fas fa-trash"></i>
                                <span>Hapus</span>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            tableBody.innerHTML += row;
        }

        document.getElementById('currentEntries').textContent = filteredUsers.length
            ? `${startIndex + 1}-${endIndex}`
            : 0;
        document.getElementById('totalEntries').textContent = filteredUsers.length;
        document.getElementById('pageNumber').textContent = `${currentPage}`;
        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = endIndex >= filteredUsers.length;
    }

    function updateEntriesPerPage() {
        entriesPerPage = parseInt(document.getElementById('entriesSelect').value);
        currentPage = 1;
        renderTable();
    }

    function changePage(direction) {
        if (direction === 'prev' && currentPage > 1) {
            currentPage--;
        } else if (direction === 'next' && (currentPage - 1) * entriesPerPage < filteredUsers.length) {
            currentPage++;
        }
        renderTable();
    }

    function filterUsers() {
        const searchValue = document.getElementById('search').value.toLowerCase();
        filteredUsers = users.filter(user =>
            user.nama_lengkap.toLowerCase().includes(searchValue) ||
            user.username.toLowerCase().includes(searchValue)
        );
        currentPage = 1;
        renderTable();
    }

    // Show success/error messages
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

    // Check for flash messages
    document.addEventListener('DOMContentLoaded', function() {
        <?php if(session()->getFlashdata('success')): ?>
            showSuccessMessage('<?= session()->getFlashdata('success') ?>');
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            showErrorMessage('<?= session()->getFlashdata('error') ?>');
        <?php endif; ?>

        renderTable();
    });
</script>

</body>
</html>