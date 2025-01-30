<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kuis</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

            initializeTextEditor();
        });

       function submitFormWithStatus(value) {
            document.getElementById('status').value = value;
            document.getElementById('kuisForm').submit();
        }

        let jumlahSoal = <?= isset($soal) ? count($soal) : 0 ?>;

        function tambahPertanyaan() {
            if (jumlahSoal >= 10) {
                alert("Jumlah soal maksimal 10.");
                return;
            }

            const container = document.getElementById('pertanyaan-container');
            const form = document.createElement('div');
            form.classList.add('bg-gray-50', 'p-4', 'rounded-lg', 'mb-4', 'shadow');

            form.innerHTML = `
                <div class="pertanyaan-item">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Pertanyaan ${jumlahSoal + 1}</h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pertanyaan:</label>
                        <input type="text" name="pertanyaan[]" 
                               class="input-small mt-1 p-2 w-full border border-gray-300 rounded" 
                               required>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jawaban 1:</label>
                            <input type="text" name="jawaban_1[]" 
                                   class="input-small mt-1 p-2 w-full border border-gray-300 rounded" 
                                   required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jawaban 2:</label>
                            <input type="text" name="jawaban_2[]" 
                                   class="input-small mt-1 p-2 w-full border border-gray-300 rounded" 
                                   required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jawaban 3:</label>
                            <input type="text" name="jawaban_3[]" 
                                   class="input-small mt-1 p-2 w-full border border-gray-300 rounded" 
                                   required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jawaban 4:</label>
                            <input type="text" name="jawaban_4[]" 
                                   class="input-small mt-1 p-2 w-full border border-gray-300 rounded" 
                                   required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Jawaban Benar:</label>
                        <input type="text" name="jawaban_benar[]" 
                               class="input-small mt-1 p-2 w-full border border-gray-300 rounded" 
                               required>
                    </div>
                    <button type="button" onclick="hapusPertanyaan(this)" 
                            class="mt-4 text-red-500 hover:text-red-700">Hapus Soal</button>
                </div>
            `;

            container.appendChild(form);
            jumlahSoal++;
            updateQuestionNumbers();
        }

        function hapusPertanyaan(button) {
            const soalForm = button.closest('.pertanyaan-item').parentElement;
            soalForm.remove();
            jumlahSoal--;
            
            updateQuestionNumbers();
            checkEmptyContainer();
        }

        function updateQuestionNumbers() {
            const container = document.getElementById('pertanyaan-container');
            const questions = container.getElementsByClassName('pertanyaan-item');
            
            for (let i = 0; i < questions.length; i++) {
                const header = questions[i].querySelector('h3');
                header.textContent = `Pertanyaan ${i + 1}`;
            }
        }

        function checkEmptyContainer() {
            const container = document.getElementById('pertanyaan-container');
            if (jumlahSoal === 0) {
                container.innerHTML = '';
            }
        }

        function submitFormWithStatus(value) {
            const form = document.getElementById('kuisForm');
            const statusInput = document.getElementById('status');
            const requiredFields = form.querySelectorAll('[required]');
            
            statusInput.value = value;
            
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

        function clearForm() {
            if (confirm('Apakah Anda yakin ingin menghapus semua perubahan?')) {
                const container = document.getElementById('pertanyaan-container');
                container.innerHTML = '';
                jumlahSoal = 0;
                document.getElementById('judul').value = '';
                document.getElementById('status').value = '';
            }
        }
    </script>
    <style>
        .dropdown-content {
            display: none;
            position: absolute;
            z-index: 10;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .input-small {
            font-size: 0.875rem;
        }
    </style>
</head>
<body class="bg-[#EEF5FF] h-screen flex">
    <?php include 'sidebar.php'; ?>
    <?php include 'header.php'; ?>
    <?php include 'footer.php'; ?>

    <div class="flex-1 pl-[242px] px-8 py-8 pt-[90px] overflow-auto pb-[50px]">
        <div class="flex items-center gap-3 mb-3">
        <?php
            $referrer = isset($_GET['from']) ? $_GET['from'] : (session()->get('referrer') ?? 'kuis');
            $backUrl = site_url('admin/' . $referrer);
        ?>
            <a href="<?= $backUrl ?>" class="text-[24px] text-gray-600 hover:text-gray-800 font-bold">
                <i class="fas fa-arrow-left"></i> 
            </a>
            <h1 class="text-[24px] font-bold" style="color: #176B87;">Edit Kuis</h1>
        </div>
        
        <div class="bg-white rounded-lg shadow px-8 pt-[2px] pb-20">
            <form id="kuisForm" action="<?= site_url('admin/updateKuis/' . $kuis['kuis_id'] . '?from=' . $referrer) ?>" method="post" class="space-y-8">
                <?= csrf_field() ?>
                <input type="hidden" name="kuis_id" value="<?= $kuis['kuis_id'] ?>">
                
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul Kuis:</label>
                    <input type="text" name="judul" id="judul" 
                           value="<?= isset($kuis['judul']) ? $kuis['judul'] : '' ?>" 
                           class="input-small mt-1 p-2 w-full border border-gray-300 rounded" 
                           required>
                </div>

                <div id="pertanyaan-container" class="space-y-6"> <!-- Increased space between questions -->
                    <?php foreach ($soal as $index => $question): ?>
                        <div class="bg-gray-50 p-4 rounded-lg mb-4 shadow">
                            <div class="pertanyaan-item">
                                <input type="hidden" name="question_id[]" value="<?= $question['question_id'] ?>">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Pertanyaan <?= $index + 1 ?></h3>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Pertanyaan:</label>
                                    <input type="text" name="pertanyaan[]" 
                                           value="<?= htmlspecialchars($question['pertanyaan']) ?>" 
                                           class="input-small mt-1 p-2 w-full border border-gray-300 rounded" 
                                           required>
                                </div>
                                <div class="space-y-3">
                                    <?php for ($i = 1; $i <= 4; $i++): ?>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Jawaban <?= $i ?>:</label>
                                            <input type="text" name="jawaban_<?= $i ?>[]" 
                                                   value="<?= htmlspecialchars($question['jawaban_' . $i]) ?>" 
                                                   class="input-small mt-1 p-2 w-full border border-gray-300 rounded" 
                                                   required>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700">Jawaban Benar:</label>
                                    <input type="text" name="jawaban_benar[]" 
                                           value="<?= htmlspecialchars($question['jawaban_benar']) ?>" 
                                           class="input-small mt-1 p-2 w-full border border-gray-300 rounded" 
                                           required>
                                </div>
                                <button type="button" onclick="hapusPertanyaan(this)" 
                                        class="mt-4 text-red-500 hover:text-red-700">Hapus Soal</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="flex items-center mb-4">
                    <button type="button" onclick="tambahPertanyaan()" 
                            class="px-4 py-2 text-sm text-white bg-[#176B87] rounded-md hover:bg-[#105570] flex items-center gap-1">
                        Tambah Pertanyaan
                    </button>
                </div>

                <div class="mt-6 flex justify-end gap-4">
                    <div class="relative inline-block text-left dropdown">
                        <button type="button" class="px-4 py-2 text-sm text-white bg-[#176B87] rounded-md hover:bg-[#105570] flex items-center gap-1">
                            Pilih Status
                        </button>
                        <div class="dropdown-content absolute right-0 mt-2 w-36 bg-white rounded shadow">
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
                    <input type="hidden" id="status" name="status" value="<?= old('status') ?>">

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