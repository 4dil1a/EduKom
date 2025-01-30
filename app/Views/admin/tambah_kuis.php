<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kuis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        let jumlahSoal = <?= isset($soal) ? count($soal) : 0; ?>;

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
            document.getElementById('status').value = value;
            document.getElementById('kuisForm').submit();
        }
        function clearForm() {
            if (confirm('Apakah Anda yakin ingin menghapus semua perubahan?')) {
                const container = document.getElementById('pertanyaan-container');
                container.innerHTML = '';
                jumlahSoal = 0;
                document.getElementById('judul').value = '';
                document.getElementById('status').value = '';
                
                // Remove any error highlighting
                document.querySelectorAll('.border-red-500').forEach(field => {
                    field.classList.remove('border-red-500');
                });
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

        #pertanyaan-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
    </style>
</head>
<body class="bg-[#EEF5FF] h-screen flex">
    <?php include 'sidebar.php'; ?>
    <?php include 'header.php'; ?>
    <?php include 'footer.php'; ?>

    <div class="flex-1 pl-[242px] px-8 py-8 pt-[90px] overflow-auto pb-[50px]">
        <div class="flex items-center gap-3 mb-3">
            <a href="<?= site_url('admin/kuis') ?>" class="text-[24px] text-gray-600 hover:text-gray-800 font-bold">
                <i class="fas fa-arrow-left"></i> 
            </a>
            <h1 class="text-[24px] font-bold" style="color: #176B87;">Tambah Kuis</h1>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6 pb-20">
            <form id="kuisForm" action="<?= site_url('admin/kuis/save') ?>" method="post" class="space-y-6">
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul Kuis:</label>
                    <input type="text" name="judul" id="judul" 
                           value="<?= isset($_POST['judul']) ? $_POST['judul'] : '' ?>" 
                           class="input-small mt-1 p-2 w-full border border-gray-300 rounded" 
                           required>
                </div>

                <div id="pertanyaan-container" class="space-y-4">
                    <?php
                    if (isset($_POST['pertanyaan'])) {
                        foreach ($_POST['pertanyaan'] as $index => $pertanyaan) {
                            echo '<div class="bg-gray-50 p-4 rounded-lg mb-4 shadow">';
                            echo '<div class="pertanyaan-item">';
                            echo '<h3 class="text-lg font-semibold text-gray-700 mb-2">Pertanyaan ' . ($index + 1) . '</h3>';
                            echo '<div class="mb-4">';
                            echo '<label class="block text-sm font-medium text-gray-700">Pertanyaan:</label>';
                            echo '<input type="text" name="pertanyaan[]" value="' . htmlspecialchars($pertanyaan) . '" 
                                  class="input-small mt-1 p-2 w-full border border-gray-300 rounded" required></div>';
                            
                            echo '<div class="space-y-3">';
                            for ($i = 1; $i <= 4; $i++) {
                                echo '<div>';
                                echo '<label class="block text-sm font-medium text-gray-700">Jawaban ' . $i . ':</label>';
                                echo '<input type="text" name="jawaban_' . $i . '[]" value="' . htmlspecialchars($_POST['jawaban_' . $i][$index]) . '" 
                                      class="input-small mt-1 p-2 w-full border border-gray-300 rounded" required>';
                                echo '</div>';
                            }
                            echo '</div>';

                            echo '<div class="mt-4">';
                            echo '<label class="block text-sm font-medium text-gray-700">Jawaban Benar:</label>';
                            echo '<input type="text" name="jawaban_benar[]" value="' . htmlspecialchars($_POST['jawaban_benar'][$index]) . '" 
                                  class="input-small mt-1 p-2 w-full border border-gray-300 rounded" required>';
                            echo '</div>';
                            
                            echo '<button type="button" onclick="hapusPertanyaan(this)" 
                                    class="mt-4 text-red-500 hover:text-red-700">Hapus Soal</button>';
                            echo '</div></div>';
                        }
                    }
                    ?>
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

            checkEmptyContainer();
            updateQuestionNumbers();
        });
    </script>
</body>
</html>