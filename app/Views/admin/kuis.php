<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Data Kuis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .minimal-select {
            appearance: none;
            width: 45px;
            padding: 2px 12px 2px 4px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background: white;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 2px center;
            background-size: 12px;
        }

        .minimal-select:focus {
            outline: none;
            border-color: #176B87;
        }

        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        table th {
            background-color: white;
            color: #333;
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.875rem;
        }

        table td {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            background-color: white;
            font-size: 0.875rem;
        }

        table tr:hover td {
            background-color: #f8f9fa;
        }

        .status-published {
            color: #176B87;
        }

        .status-draft {
            color: #44F12D;
        }

        .btn-edit {
            background-color: #176B87;
            color: white;
            border-radius: 4px;
        }

        .btn-delete {
            background-color: #dc2626;
            color: white;
            border-radius: 4px;
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
        <h1 class="text-[24px] font-bold mb-4" style="color: #176B87;">Data Kuis</h1>
        <div class="bg-white rounded-lg shadow p-6">
            

            <!-- Tombol Tambah Data -->
            <div class="mt-4">
                <a href="<?= site_url('admin/tambahKuis') ?>" class="inline-flex items-center bg-[#176B87] text-white px-4 py-2 rounded shadow">
                    <span class="mr-2">+</span> Tambah Data
                </a>
            </div>

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
                        placeholder="Cari kuis..."
                        oninput="filterKuis()"
                    >
                </div>
            </div>

            <!-- Tabel Data Kuis -->
            <div class="overflow-x-auto mb-6">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="w-16 text-sm">No</th>
                            <th class="text-sm">Judul Kuis</th>
                            <th class="text-sm">Jumlah Soal</th>
                            <th class="text-sm">Status</th>
                            <th class="w-32 text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="kuisTableBody">
                        <?php foreach ($quizzes as $index => $quiz): ?>
                        <tr>
                            <td class="text-sm"><?= $index + 1 ?></td>
                            <td class="text-sm"><?= esc($quiz['judul']) ?></td>
                            <td class="text-sm"><?= esc($quiz['jumlah_soal']) ?></td>
                            <td class="text-sm">
                                <span class="<?= $quiz['status'] === 'publish' ? 'status-published' : 'status-draft' ?>">
                                    <?= ucfirst($quiz['status']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <a href="<?= site_url('admin/editKuis/' . $quiz['kuis_id'] . '?from=kuis') ?>" 
                                       class="btn-small btn-edit inline-flex items-center justify-center">
                                        <i class="fas fa-edit"></i> <span>Edit</span>
                                    </a>
                                    <a href="#" 
                                       class="btn-small btn-delete inline-flex items-center justify-center"
                                       onclick="confirmDeletion('<?= site_url('admin/hapusKuis/' . $quiz['kuis_id'] . '?from=kuis') ?>')">
                                        <i class="fas fa-trash"></i> <span>Hapus</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
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
    let kuisData = <?= json_encode($quizzes) ?>;
    let currentPage = 1;
    let entriesPerPage = 10;
    let filteredData = [...kuisData];

    function filterKuis() {
        const searchQuery = document.getElementById('search').value.toLowerCase();
        currentPage = 1;
        
        filteredData = kuisData.filter(quiz => {
            return quiz.judul.toLowerCase().includes(searchQuery);
        });

        updateTable(filteredData);
    }

    function updateEntriesPerPage() {
        entriesPerPage = parseInt(document.getElementById('entriesSelect').value);
        currentPage = 1;
        updateTable(filteredData);
    }

    function updateTable(data) {
        const startIndex = (currentPage - 1) * entriesPerPage;
        const endIndex = Math.min(startIndex + entriesPerPage, data.length);
        const selectedData = data.slice(startIndex, endIndex);

        const tableBody = document.getElementById('kuisTableBody');
        tableBody.innerHTML = '';

        selectedData.forEach((quiz, index) => {
            const statusClass = quiz.status === 'published' ? 'status-published' : 'status-draft';
            const row = document.createElement('tr');
            
            row.innerHTML = `
                <td class="text-sm">${startIndex + index + 1}</td>
                <td class="text-sm">${quiz.judul}</td>
                <td class="text-sm">${quiz.jumlah_soal}</td>
                <td class="text-sm">
                    <span class="${statusClass}">
                        ${quiz.status.charAt(0).toUpperCase() + quiz.status.slice(1)}
                    </span>
                </td>
                <td class="flex space-x-3 text-sm">
                    <a href="<?= site_url('admin/editKuis/') ?>${quiz.kuis_id}?from=kuis" 
                       class="btn-small btn-edit">
                        <i class="fas fa-edit"></i> <span>Edit</span>
                    </a>
                    <a href="#" 
                       class="btn-small btn-delete"
                       onclick="confirmDeletion('<?= site_url('admin/hapusKuis/') ?>${quiz.kuis_id}?from=kuis')">
                        <i class="fas fa-trash"></i> <span>Hapus</span>
                    </a>
                </td>
            `;
            tableBody.appendChild(row);
        });

        document.getElementById('currentEntries').textContent = endIndex - startIndex;
        document.getElementById('totalEntries').textContent = data.length;
        document.getElementById('pageNumber').textContent = `${currentPage}`;

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        prevBtn.disabled = currentPage === 1;
        prevBtn.classList.toggle('opacity-50', currentPage === 1);

        nextBtn.disabled = endIndex >= data.length;
        nextBtn.classList.toggle('opacity-50', endIndex >= data.length);
    }

    <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

    function confirmDeletion(url) {
        Swal.fire({
            title: 'Apakah anda yakin ingin menghapus kuis?',
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
                window.location.href = url;
            }
        });
    }

    function changePage(direction) {
        const totalPages = Math.ceil(filteredData.length / entriesPerPage);
        
        if (direction === 'prev' && currentPage > 1) {
            currentPage--;
        } else if (direction === 'next' && currentPage < totalPages) {
            currentPage++;
        }
        
        updateTable(filteredData);
    }

    // Initialize the table when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        updateTable(filteredData);
    });
    </script>

</body>
</html>