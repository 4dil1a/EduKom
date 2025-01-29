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

        // Time picker functionality
        function initTimePicker() {
            const timeInput = document.getElementById('jam');
            const timeDropdown = document.getElementById('timeDropdown');
            let selectedHour = '10';
            let selectedMinute = '00';
            let selectedPeriod = 'AM';

            // Initialize with existing value if present
            if (timeInput.value) {
                const time = new Date(`2000-01-01 ${timeInput.value}`);
                selectedHour = time.getHours() > 12 ? 
                    String(time.getHours() - 12).padStart(2, '0') : 
                    String(time.getHours()).padStart(2, '0');
                selectedMinute = String(time.getMinutes()).padStart(2, '0');
                selectedPeriod = time.getHours() >= 12 ? 'PM' : 'AM';
                timeInput.value = `${selectedHour}:${selectedMinute} ${selectedPeriod}`;
            }

            // Create time options
            function createTimeOptions() {
                const hours = Array.from({ length: 12 }, (_, i) => String(i + 1).padStart(2, '0'));
                const minutes = Array.from({ length: 60 }, (_, i) => String(i).padStart(2, '0'));
                const periods = ['AM', 'PM'];

                const hoursHtml = hours.map(hour => `
                    <div class="time-option hour-option px-4 py-1 text-xs cursor-pointer hover:bg-blue-50" data-value="${hour}">
                        ${hour}
                    </div>
                `).join('');

                const minutesHtml = minutes.map(minute => `
                    <div class="time-option minute-option px-4 py-1 text-xs cursor-pointer hover:bg-blue-50" data-value="${minute}">
                        ${minute}
                    </div>
                `).join('');

                const periodsHtml = periods.map(period => `
                    <div class="time-option period-option px-4 py-1 text-xs cursor-pointer hover:bg-blue-50" data-value="${period}">
                        ${period}
                    </div>
                `).join('');

                return `
                    <div class="grid grid-cols-3 gap-0 w-[200px] bg-white border rounded-xl shadow-lg">
                        <div class="max-h-48 overflow-y-auto border-r">${hoursHtml}</div>
                        <div class="max-h-48 overflow-y-auto border-r">${minutesHtml}</div>
                        <div>${periodsHtml}</div>
                    </div>
                `;
            }

            // Toggle dropdown
            timeInput.addEventListener('click', (e) => {
                e.stopPropagation();
                timeDropdown.innerHTML = createTimeOptions();
                timeDropdown.style.display = timeDropdown.style.display === 'none' ? 'block' : 'none';
                highlightSelected();
            });

            // Handle option selection
            timeDropdown.addEventListener('click', (e) => {
                const option = e.target.closest('.time-option');
                if (!option) return;

                if (option.classList.contains('hour-option')) {
                    selectedHour = option.dataset.value;
                } else if (option.classList.contains('minute-option')) {
                    selectedMinute = option.dataset.value;
                } else if (option.classList.contains('period-option')) {
                    selectedPeriod = option.dataset.value;
                }

                timeInput.value = `${selectedHour}:${selectedMinute} ${selectedPeriod}`;
                highlightSelected();
            });

            // Highlight selected options
            function highlightSelected() {
                document.querySelectorAll('.time-option').forEach(option => {
                    if ((option.classList.contains('hour-option') && option.dataset.value === selectedHour) ||
                        (option.classList.contains('minute-option') && option.dataset.value === selectedMinute) ||
                        (option.classList.contains('period-option') && option.dataset.value === selectedPeriod)) {
                        option.classList.add('bg-blue-500', 'text-white');
                    } else {
                        option.classList.remove('bg-blue-500', 'text-white');
                    }
                });
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!timeInput.contains(e.target) && !timeDropdown.contains(e.target)) {
                    timeDropdown.style.display = 'none';
                }
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
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        input[type="text"], 
        input[type="date"], 
        input[type="file"], 
        textarea#deskripsi {
            font-size: 0.875rem !important;
            font-family: inherit;
            color: #000;
            font-weight: normal;
            line-height: normal;
        }

        .time-picker-dropdown {
            display: none;
            position: absolute;
            z-index: 50;
            margin-top: 4px;
            width: 200px;
        }

        .time-option:hover {
            background-color: #EBF5FF;
        }

        textarea#deskripsi {
            resize: none;
            min-height: 482px; /* Increased from 362px */
            font-size: 0.875rem !important;
        }
    </style>
</head>
<body class="bg-[#EEF5FF] h-screen flex" onload="initTimePicker()">

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
    <?php include 'header.php'; ?>
    <?php include 'footer.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 pl-[242px] px-8 py-8 pt-[90px] overflow-auto pb-[50px]">
        <div class="flex items-center gap-3 mb-3">
            <?php
            $referrer = isset($_GET['from']) ? $_GET['from'] : (session()->get('referrer') ?? 'seminar');
            $backUrl = site_url('admin/' . $referrer);
            ?>
            <a href="<?= $backUrl ?>" class="text-[24px] text-gray-600 hover:text-gray-800 font-bold">
                <i class="fas fa-arrow-left"></i> 
            </a>
            <h1 class="text-[24px] font-bold" style="color: #176B87;">Edit Seminar</h1>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6 h-[760px]"> <!-- Increased from 640px to 760px -->
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

                        <div class="mt-4 relative">
                            <label for="jam" class="block text-sm font-medium text-gray-700">Jam</label>
                            <input type="text" id="jam" name="jam" class="input-small mt-1 p-2 w-full border border-gray-300 rounded-xl cursor-pointer bg-white" value="<?= old('jam', $seminar['jam']) ?>" required readonly>
                            <div id="timeDropdown" class="time-picker-dropdown"></div>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('jam') ?></div>
                        </div>
                    </div>

                    <!-- Right Column (Description) -->
                    <div class="flex-1">
                        <div class="mt-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" class="mt-1 p-2 w-full border border-gray-300 rounded" 
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