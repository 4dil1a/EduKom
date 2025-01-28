<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Seminar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Function to submit form with selected status
        function submitFormWithStatus(value) {
            const form = document.getElementById('seminarForm');
            const statusInput = document.getElementById('status');
            const requiredFields = form.querySelectorAll('[required]');
            
            // Set the status value
            statusInput.value = value;
            
            // Check if all required fields are filled
            let isValid = true;
            requiredFields.forEach(field => {
                if (!field.value) {
                    isValid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            if (isValid) {
                form.submit();
            } else {
                alert('Harap isi semua field yang diperlukan');
            }
        }

        // Function to clear the form
        function clearForm() {
            document.getElementById('seminarForm').reset();
            document.getElementById('status').value = ''; // Clear status value
            // Remove any error highlighting
            document.querySelectorAll('.border-red-500').forEach(field => {
                field.classList.remove('border-red-500');
            });
        }
    </script>
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

        .dropdown-content {
            display: none;
            position: absolute;
            z-index: 10;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Add smaller text size for input values */
        .input-small {
            font-size: 0.875rem; /* 14px */
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
        <div class="flex items-center gap-3 mb-3">
            <a href="<?= site_url('admin/seminar') ?>" class="text-[24px] text-gray-600 hover:text-gray-800 font-bold">
                <i class="fas fa-arrow-left"></i> 
            </a>
            <h1 class="text-[24px] font-bold" style="color: #176B87;">Tambah Seminar</h1>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6 h-[640px]">
            <!-- Form Tambah Seminar -->
            <form id="seminarForm" action="<?= site_url('admin/simpanSeminar') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Layout Form -->
                <div class="flex flex-wrap gap-6">
                    <!-- Left Column -->
                    <div class="flex-1">
                        <div class="mt-4">
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" id="judul" name="judul" class="input-small mt-1 p-2 w-full border border-gray-300 rounded" value="<?= old('judul') ?>" required>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('judul') ?></div>
                        </div>

                        <div class="mt-4">
                            <label for="penyelenggara" class="block text-sm font-medium text-gray-700">Penyelenggara</label>
                            <input type="text" id="penyelenggara" name="penyelenggara" class="input-small mt-1 p-2 w-full border border-gray-300 rounded" value="<?= old('penyelenggara') ?>" required>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('penyelenggara') ?></div>
                        </div>

                        <div class="mt-4">
                            <label for="bentuk_acara" class="block text-sm font-medium text-gray-700">Bentuk Acara</label>
                            <input type="text" id="bentuk_acara" name="bentuk_acara" class="input-small mt-1 p-2 w-full border border-gray-300 rounded" value="<?= old('bentuk_acara') ?>" required>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('bentuk_acara') ?></div>
                        </div>

                        <div class="mt-4">
                            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="input-small mt-1 p-2 w-full border border-gray-300 rounded" value="<?= old('tanggal') ?>" required>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('tanggal') ?></div>
                        </div>
                        <div class="mt-4">
                            <label for="jam" class="block text-sm font-medium text-gray-700">Jam</label>
                            <input type="time" id="jam" name="jam" class="input-small mt-1 p-2 w-full border border-gray-300 rounded" value="<?= old('jam') ?>" required>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('jam') ?></div>
                        </div>

                        <div class="mt-4">
                            <label for="poster" class="block text-sm font-medium text-gray-700">Unggah Poster</label>
                            <input type="file" id="poster" name="poster" class="input-small mt-1 p-2 w-full border border-gray-300 rounded" accept="image/*" required>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('poster') ?></div>
                        </div>
                    </div>

                    <!-- Right Column (Description) -->
                    <div class="flex-1">
                        <div class="mt-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" class="input-small mt-1 p-2 w-full h-[376px] border border-gray-300 rounded" required><?= old('deskripsi') ?></textarea>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('deskripsi') ?></div>
                        </div>
                    </div>
                </div>

                <!-- Status and Clear Button -->
                <div class="mt-6 flex items-center gap-4">
                    <!-- Dropdown Button -->
                    <div class="relative inline-block text-left dropdown">
                        <button type="button" class="px-4 py-2 text-sm text-white bg-[#176B87] rounded-md hover:bg-[#105570] flex items-center gap-1">
                            Pilih Status
                        </button>
                        <div class="dropdown-content absolute right-0 mt-2 w-36 bg-white rounded shadow">
                            <ul>
                                <li>
                                    <button type="button" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 w-full text-left" onclick="submitFormWithStatus('published')">
                                        Published
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 w-full text-left" onclick="submitFormWithStatus('draft')">
                                        Draft
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" id="status" name="status" value="<?= old('status') ?>">

                    <!-- Clear Button -->
                    <button type="button" onclick="clearForm()" class="px-4 py-2 text-sm text-white bg-red-500 rounded-md hover:bg-red-600 flex items-center gap-1">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dropdown = document.querySelector('.dropdown');
            const dropdownContent = document.querySelector('.dropdown-content');
            let timer;

            dropdown.addEventListener('mouseenter', () => {
                dropdownContent.style.display = 'block';
                clearTimeout(timer);
            });

            dropdownContent.addEventListener('mouseenter', () => {
                clearTimeout(timer);
            });

            dropdown.addEventListener('mouseleave', () => {
                timer = setTimeout(() => {
                    dropdownContent.style.display = 'none';
                }, 30000);
            });

            dropdownContent.addEventListener('mouseleave', () => {
                timer = setTimeout(() => {
                    dropdownContent.style.display = 'none';
                }, 30000);
            });
        });
    </script>
</body>
</html>