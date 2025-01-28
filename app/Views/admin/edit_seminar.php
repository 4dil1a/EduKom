<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Seminar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Function to submit form with selected status
        function submitFormWithStatus(value) {
            document.getElementById('status').value = value;
            document.getElementById('seminarForm').submit();
        }

        // Function to clear the form
        function clearForm() {
            if (confirm('Apakah Anda yakin ingin menghapus semua isian form?')) {
                document.getElementById('seminarForm').reset();
                document.getElementById('status').value = '';
            }
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
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Updated input styling for smaller text with increased specificity */
        input[type="text"], 
        input[type="date"], 
        input[type="file"], 
        textarea#deskripsi {
            font-size: 0.875rem !important; /* 14px with !important to ensure it's applied */
            font-family: inherit;
            color: #000;
            font-weight: normal;
            line-height: normal;
        }

        /* Additional specific styling for textarea to ensure consistency */
        textarea#deskripsi {
            resize: none;
            min-height: 362px;
            font-size: 0.875rem !important;
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
            <?php
            // Get the referrer from URL parameter or session
            $referrer = isset($_GET['from']) ? $_GET['from'] : (session()->get('referrer') ?? 'seminar');
            
            // Determine the back URL based on referrer
            $backUrl = site_url('admin/' . $referrer);
            ?>
            <a href="<?= $backUrl ?>" class="text-[24px] text-gray-600 hover:text-gray-800 font-bold">
                <i class="fas fa-arrow-left"></i> 
            </a>
            <h1 class="text-[24px] font-bold" style="color: #176B87;">Edit Seminar</h1>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6 h-[640px]">
            <!-- Form Edit Seminar -->
            <form id="seminarForm" action="<?= site_url('admin/updateSeminar/' . $seminar['seminar_id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="referrer" value="<?= $referrer ?>">

                <!-- Layout Form -->
                <div class="flex flex-wrap gap-6">
                    <!-- Left Column -->
                    <div class="flex-1">
                        <div class="mt-4">
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" id="judul" name="judul" class="mt-1 p-2 w-full border border-gray-300 rounded" 
                                value="<?= old('judul', $seminar['judul']) ?>" required>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('judul') ?></div>
                        </div>

                        <div class="mt-4">
                            <label for="penyelenggara" class="block text-sm font-medium text-gray-700">Penyelenggara</label>
                            <input type="text" id="penyelenggara" name="penyelenggara" class="mt-1 p-2 w-full border border-gray-300 rounded" 
                                value="<?= old('penyelenggara', $seminar['penyelenggara']) ?>" required>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('penyelenggara') ?></div>
                        </div>

                        <div class="mt-4">
                            <label for="bentuk_acara" class="block text-sm font-medium text-gray-700">Bentuk Acara</label>
                            <input type="text" id="bentuk_acara" name="bentuk_acara" class="mt-1 p-2 w-full border border-gray-300 rounded" 
                                value="<?= old('bentuk_acara', $seminar['bentuk_acara']) ?>" required>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('bentuk_acara') ?></div>
                        </div>

                        <div class="mt-4">
                            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="mt-1 p-2 w-full border border-gray-300 rounded" 
                                value="<?= old('tanggal', $seminar['tanggal']) ?>" required>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('tanggal') ?></div>
                        </div>
                        <div class="flex-[1]">
    <!-- Field Unggah Poster -->
    <div class="mt-4">
        <label for="poster" class="block text-sm font-medium text-gray-700">Unggah Poster</label>
        <?php if ($seminar['poster']) : ?>
            <div class="mt-2">
                <img src="<?= base_url($seminar['poster']) ?>" alt="Poster Seminar" class="w-32 h-32 object-cover rounded">
            </div>
        <?php endif; ?>
        <input type="file" id="poster" name="poster" class="mt-1 p-2 w-full border border-gray-300 rounded" accept="image/*">
        <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('poster') ?></div>
    </div>

    <!-- Field Jam -->
    <div class="mt-4">
        <label for="jam" class="block text-sm font-medium text-gray-700">Jam</label>
        <input 
            type="time" 
            id="jam" 
            name="jam" 
            class="mt-1 p-2 w-full border border-gray-300 rounded" 
            value="<?= old('jam', $seminar['jam']) ?>" 
            required>
        <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('jam') ?></div>
    </div>
</div>
                    </div>

                    <!-- Right Column (Description) -->
                    <div class="flex-1">
                        <div class="mt-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" class="mt-1 p-2 w-full h-[362px] border border-gray-300 rounded" 
                                required><?= old('deskripsi', $seminar['deskripsi']) ?></textarea>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('deskripsi') ?></div>
                        </div>
                    </div>
                </div>

                <!-- Status and Action Buttons -->
                <div class="mt-6 flex items-center gap-4">
                    <!-- Dropdown Button -->
                    <div class="relative inline-block text-left dropdown">
                        <button type="button" class="px-4 py-2 text-sm text-white bg-[#176B87] rounded-md hover:bg-[#105570] flex items-center gap-1">
                            Pilih Status
                        </button>
                        <div class="absolute right-0 mt-2 w-36 bg-white rounded shadow dropdown-content">
                            <ul>
                                <li>
                                    <button type="button" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 w-full text-left" 
                                        onclick="submitFormWithStatus('published')">
                                        Published
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 w-full text-left" 
                                        onclick="submitFormWithStatus('draft')">
                                        Draft
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" id="status" name="status" value="<?= old('status', $seminar['status']) ?>">

                    <!-- Clear Button -->
                    <button type="button" onclick="clearForm()" 
                        class="px-4 py-2 text-sm text-white bg-red-500 rounded-md hover:bg-red-600 flex items-center gap-1">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>