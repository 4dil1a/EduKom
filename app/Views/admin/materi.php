<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Data Materi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        /* Loading Animation */
        .loading-spinner {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        .loading-spinner::after {
            content: '';
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #176B87;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Overlay */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>
<body class="bg-[#EEF5FF] h-screen flex">
    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
    <?php include 'header.php'; ?>
    <?php include 'footer.php'; ?>

    <!-- Loading Spinner and Overlay -->
    <div class="loading-spinner"></div>
    <div class="overlay"></div>

    <!-- Main Content -->
    <div class="flex-1 pl-[242px] px-8 py-8 pt-[90px] overflow-auto pb-[50px]">
        <h1 class="text-[24px] font-bold mb-4" style="color: #176B87;">Data Materi</h1>
        <div class="bg-white rounded-lg shadow p-6">
            <!-- Add Button -->
            <div class="mt-4">
                <a href="<?= site_url('admin/tambahMateri?from=materi') ?>" 
                   class="inline-flex items-center bg-[#176B87] text-white px-4 py-2 rounded shadow">
                    <i class="fas fa-plus mr-2"></i> Tambah Data
                </a>
            </div>

            <!-- Filter and Search -->
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
                        placeholder="Cari materi..."
                        oninput="filterMateri()"
                    >
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto mb-6">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="w-16 text-sm">No</th>
                            <th class="text-sm">Judul Materi</th>
                            <th class="text-sm">Penulis</th>
                            <th class="text-sm">Status</th>
                            <th class="w-32 text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="materiTableBody"></tbody>
                </table>
            </div>

            <!-- Pagination -->
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
        let materiData = <?= json_encode($materi) ?>;
        let currentPage = 1;
        let entriesPerPage = 10;
        let filteredData = [...materiData];

        function showLoading() {
            document.querySelector('.loading-spinner').style.display = 'block';
            document.querySelector('.overlay').style.display = 'block';
        }

        function hideLoading() {
            document.querySelector('.loading-spinner').style.display = 'none';
            document.querySelector('.overlay').style.display = 'none';
        }

        function confirmDelete(materiId) {
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus materi?',
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
                    showLoading();
                    window.location.href = `<?= site_url('admin/hapusMateri/') ?>${materiId}?from=materi`;
                }
            });
        }

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

        function filterMateri() {
            const searchQuery = document.getElementById('search').value.toLowerCase();
            currentPage = 1;
            
            filteredData = materiData.filter(item => {
                return item.judul.toLowerCase().includes(searchQuery) ||
                       item.penulis.toLowerCase().includes(searchQuery);
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

            const tableBody = document.getElementById('materiTableBody');
            tableBody.innerHTML = '';

            selectedData.forEach((item, index) => {
                const statusClass = item.status === 'published' ? 'status-published' : 'status-draft';
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td class="text-sm">${startIndex + index + 1}</td>
                    <td class="text-sm">${item.judul}</td>
                    <td class="text-sm">${item.penulis}</td>
                    <td class="text-sm">
                        <span class="${statusClass}">
                            ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                        </span>
                    </td>
                    <td class="flex space-x-3 text-sm">
                        <a href="<?= site_url('admin/editMateri/') ?>${item.materi_id}?from=materi" 
                           class="btn-small btn-edit">
                            <i class="fas fa-edit"></i> <span>Edit</span>
                        </a>
                        <button onclick="confirmDelete('${item.materi_id}')"
                                class="btn-small btn-delete">
                            <i class="fas fa-trash"></i> <span>Hapus</span>
                        </button>
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

        function changePage(direction) {
            const totalPages = Math.ceil(filteredData.length / entriesPerPage);
            
            if (direction === 'prev' && currentPage > 1) {
                currentPage--;
            } else if (direction === 'next' && currentPage < totalPages) {
                currentPage++;
            }
            
            updateTable(filteredData);
        }

        // Initialize table and check for flash messages
        document.addEventListener('DOMContentLoaded', function() {
            updateTable(filteredData);

            <?php if(session()->getFlashdata('success')): ?>
                showSuccessMessage('<?= session()->getFlashdata('success') ?>');
            <?php endif; ?>

            <?php if(session()->getFlashdata('error')): ?>
                showErrorMessage('<?= session()->getFlashdata('error') ?>');
            <?php endif; ?>
        });

        // Add loading spinner for navigation actions
        document.addEventListener('click', function(e) {
            if (e.target.tagName === 'A' && !e.target.getAttribute('onclick')) {
                showLoading();
            }
        });
    </script>
</body>
</html>