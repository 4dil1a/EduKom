<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
       function submitFormWithStatus(value) {
            document.getElementById('status').value = value;
            document.getElementById('materiForm').submit();
        }
       
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

        function initializeTextEditor() {
            const textarea = document.getElementById('deskripsi');
            const content = textarea.value;
            
            const editableDiv = document.createElement('div');
            editableDiv.id = 'deskripsi';
            editableDiv.className = textarea.className;
            editableDiv.contentEditable = true;
            editableDiv.innerHTML = content;
            
            const hiddenTextarea = document.createElement('textarea');
            hiddenTextarea.name = 'deskripsi';
            hiddenTextarea.style.display = 'none';
            hiddenTextarea.value = content;
            hiddenTextarea.required = true;
            
            textarea.parentNode.replaceChild(editableDiv, textarea);
            editableDiv.parentNode.appendChild(hiddenTextarea);
            
            editableDiv.addEventListener('input', () => {
                hiddenTextarea.value = editableDiv.innerHTML;
            });

            const form = document.getElementById('materiForm');
            form.addEventListener('submit', (e) => {
                hiddenTextarea.value = editableDiv.innerHTML;
            });
        }

        function formatText(command, value = null) {
            document.execCommand(command, false, value);
            const editableDiv = document.getElementById('deskripsi');
            const hiddenTextarea = document.querySelector('textarea[name="deskripsi"]');
            hiddenTextarea.value = editableDiv.innerHTML;
            editableDiv.focus();
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

        .line-above {
            border-top: 2px solid #ccc;
            margin-bottom: 10px;
        }

        #deskripsi {
            min-height: 376px;
            max-height: 376px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
            background-color: white;
            overflow-y: auto;
            overflow-x: hidden;
            word-wrap: break-word;
            white-space: pre-wrap;
            word-break: break-word;
            line-height: 1.5;
        }

        #deskripsi:focus {
            outline: none;
            border-color: #176B87;
        }

        .highlight-card {
            padding: 10px;
            background-color: rgba(23, 107, 135, 0.2);
            border: 1px solid #176B87;
            border-radius: 4px;
            margin-top: 10px;
        }

        .highlight-card p {
            margin: 0;
            font-size: 0.875rem;
            color: #176B87;
        }

        .toolbar button {
            margin-right: 10px;
            padding: 4px 8px;
            font-size: 0.875rem;
            background-color: #176B87;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .toolbar button:hover {
            background-color: #105570;
        }

        /* Updated: Make icons white */
        .toolbar button i {
            color: white;
        }

        .highlight-card {
            background-color: rgba(23, 107, 135, 0.2);
            border: 1px solid #176B87;
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
            $referrer = isset($_GET['from']) ? $_GET['from'] : (session()->get('referrer') ?? 'materi');
            $backUrl = site_url('admin/' . $referrer);
            ?>

            <a href="<?= $backUrl ?>" class="text-[24px] text-gray-600 hover:text-gray-800 font-bold">
                <i class="fas fa-arrow-left"></i> 
            </a>
            <h1 class="text-[24px] font-bold" style="color: #176B87;">Edit Materi</h1>
        </div>
        <div class="bg-white rounded-lg shadow p-6 h-[600px]">
            <!-- Change this line in edit_materi.php -->
            <form id="materiForm" action="<?= site_url('admin/updateMateri/' . $materi['materi_id'] . '?from=' . $referrer) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="flex flex-wrap gap-6">
                    <div class="flex-[2]">
                        <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input 
                            type="text" 
                            id="judul" 
                            name="judul" 
                            class="mt-1 p-2 w-full border border-gray-300 rounded" 
                            value="<?= old('judul', $materi['judul']) ?>" 
                            required>
                        <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('judul') ?></div>
                    </div>

                    <div class="flex-[1] mt-[25px]">
                        <div class="relative inline-block text-left dropdown">
                            <button type="button" class="px-4 py-2 text-sm text-white bg-[#176B87] rounded-md hover:bg-[#105570]">
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
                        
                        <input type="hidden" id="status" name="status" value="<?= old('status', $materi['status']) ?>">
                    </div>
                </div>

                <div class="flex flex-wrap gap-6">
                    <div class="flex-[2]">
                        <div class="mt-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <div class="highlight-card">
                                <div class="toolbar">
                                    <button type="button" onclick="formatText('undo')" class="text-white">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                    <button type="button" onclick="formatText('redo')" class="text-white">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                    <button type="button" onclick="formatText('bold')" class="text-white">
                                        <i class="fas fa-bold"></i>
                                    </button>
                                    <button type="button" onclick="formatText('italic')" class="text-white">
                                        <i class="fas fa-italic"></i>
                                    </button>
                                    <button type="button" onclick="formatText('underline')" class="text-white">
                                        <i class="fas fa-underline"></i>
                                    </button>
                                    <button type="button" onclick="formatText('justifyleft')" class="text-white">
                                        <i class="fas fa-align-left"></i>
                                    </button>
                                    <button type="button" onclick="formatText('justifyright')" class="text-white">
                                        <i class="fas fa-align-right"></i>
                                    </button>
                                    <button type="button" onclick="formatText('justifyfull')" class="text-white">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                </div>
                            </div>
                            <textarea id="deskripsi" name="deskripsi" class="input-small mt-1 p-2 w-full h-[376px] border border-gray-300 rounded" required><?= old('deskripsi', $materi['deskripsi']) ?></textarea>
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('deskripsi') ?></div>
                        </div>
                    </div>

                    <div class="flex-[1]">
                        <div class="mt-4">
                            <label for="gambar" class="block text-sm font-medium text-gray-700">Unggah Gambar</label>
                            <?php if ($materi['gambar']) : ?>
                                <div class="mt-2">
                                    <img src="<?= base_url($materi['gambar']) ?>" alt="Gambar Materi" class="w-32 h-32 object-cover rounded">
                                    
                                </div>
                            <?php endif; ?>
                            <input type="file" id="gambar" name="gambar" class="mt-1 p-2 w-full border border-gray-300 rounded" accept="image/*">
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('gambar') ?></div>
                        </div>
                        <div class="mt-4">
                            <label for="audio" class="block text-sm font-medium text-gray-700">Unggah Audio</label>
                            <?php if ($materi['audio']) : ?>
                                <div class="mt-2">
                                    <audio controls class="w-full">
                                        <source src="<?= base_url($materi['audio']) ?>" type="audio/mpeg">
                                        Browser Anda tidak mendukung pemutaran audio.
                                    </audio>
                                    
                                </div>
                            <?php endif; ?>
                            <input type="file" id="audio" name="audio" class="mt-1 p-2 w-full border border-gray-300 rounded" accept="audio/*">
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('audio') ?></div>
                        </div>
                        <div class="mt-4">
                            <label for="video" class="block text-sm font-medium text-gray-700">Unggah Video</label>
                            <?php if ($materi['video']) : ?>
                                <div class="mt-2">
                                    <video controls class="w-full">
                                        <source src="<?= base_url($materi['video']) ?>" type="video/mp4">
                                        Browser Anda tidak mendukung pemutaran video.
                                    </video>
                                    
                                </div>
                            <?php endif; ?>
                            <input type="file" id="video" name="video" class="mt-1 p-2 w-full border border-gray-300 rounded" accept="video/*">
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('video') ?></div>
                        </div>
                        <div class="mt-4">
                            <label for="unduh_materi" class="block text-sm font-medium text-gray-700">Unggah Materi (PDF)</label>
                            <?php if ($materi['unduh_materi']) : ?>
                                <div class="mt-2">
                                    <a href="<?= base_url($materi['unduh_materi']) ?>" target="_blank" class="text-blue-500 hover:underline">Lihat PDF</a>
                                    
                                </div>
                            <?php endif; ?>
                            <input type="file" id="unduh_materi" name="unduh_materi" class="mt-1 p-2 w-full border border-gray-300 rounded" accept="application/pdf">
                            <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('unduh_materi') ?></div>
                        </div>

                        <div class="mt-4">
    <div class="mb-8"> <!-- Tambahkan margin-bottom yang cukup -->
        <label for="penulis" class="block text-sm font-medium text-gray-700">Penulis</label>
        <input type="text" id="penulis" name="penulis" class="mt-1 p-2 w-full border border-gray-300 rounded" value="<?= old('penulis', $materi['penulis']) ?>" required>
        <div class="text-red-500 text-sm"><?= \Config\Services::validation()->getError('penulis') ?></div>
    </div>
</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>