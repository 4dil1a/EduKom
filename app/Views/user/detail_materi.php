<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduKom - Materi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f4f8;
        }
        .navbar, footer {
            background-color: #006d77;
        }
        .materi-header {
            background-color: #7209b7;
            border-radius: 12px 12px 0 0;
            padding: 2rem;
        }
        .materi-content {
            background-color: white;
            border-radius: 0 0 12px 12px;
            padding: 2rem;
        }
        .materi-image {
            height: 300px;
            overflow: hidden;
            border-radius: 12px;
        }
        .materi-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .custom-button {
            background-color: #0077b6;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
        }
        .custom-button:hover {
            background-color: #023e8a;
        }
        .card {
            background-color: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .card .p-4 {
            padding: 1rem;
        }
        .materi-image {
            height: 300px;
            overflow: hidden;
            border-radius: 12px;
            background-color: #f3f4f6;
        }
        .materi-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            object-position: center;
        }
        strong {
            font-weight: bold;
        }
        em {
            font-style: italic;
        }
        u {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <div class="rounded-lg shadow-md overflow-hidden">
            <div class="materi-header text-white">
                <h1 class="text-3xl font-bold mb-2"><?= esc($materi['judul']) ?></h1>
                <p class="text-lg font-medium mb-4">Oleh: <?= esc($materi['penulis']) ?></p>
                <div class="flex space-x-4 mt-4">
                    <a href="<?= base_url('materi/video/' . $materi['materi_id']) ?>" class="custom-button">
                        <i class="fas fa-play-circle"></i> Tonton Video
                    </a>
                    <audio controls class="w-full">
                        <source src="<?= base_url($materi['audio']) ?>" type="audio/mpeg">
                        Browser Anda tidak mendukung pemutaran audio.
                    </audio>
                    <a href="<?= base_url('materi/unduh/' . $materi['materi_id']) ?>" class="custom-button">
                        <i class="fas fa-download"></i> Unduh Materi
                    </a>
                </div>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="mt-4 text-red-500">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="materi-content grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Bagian konten utama -->
                <div class="lg:col-span-2">
                    <div class="materi-image mb-6">
                        <?php if ($materi['gambar']): ?>
                            <img src="<?= base_url($materi['gambar']) ?>" alt="<?= esc($materi['judul']) ?>" 
                                 onerror="this.src='<?= base_url('assets/images/placeholder.jpg') ?>'">
                        <?php else: ?>
                            <img src="<?= base_url('assets/images/placeholder.jpg') ?>" alt="Default Image">
                        <?php endif; ?>
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-6">
                        <?= nl2br(htmlspecialchars_decode(esc($materi['deskripsi']))) ?>
                    </p>
                </div>

                <!-- Bagian materi lainnya -->
                <div class="grid grid-cols-1 gap-6">
                    <h2 class="text-xl font-bold mb-4">Materi Lainnya</h2>
                    <?php if (!empty($materiLainnya)): ?>
                        <?php foreach ($materiLainnya as $m): ?>
                            <div class="card">
                                <a href="<?= base_url('materi/detail/' . $m['materi_id']) ?>">
                                    <?php if ($m['gambar']): ?>
                                        <img src="<?= base_url($m['gambar']) ?>" alt="<?= esc($m['judul']) ?>"
                                             onerror="this.src='<?= base_url('assets/images/placeholder.jpg') ?>'">
                                    <?php else: ?>
                                        <img src="<?= base_url('assets/images/placeholder.jpg') ?>" alt="Default Image">
                                    <?php endif; ?>
                                    <div class="p-4">
                                        <h3 class="text-lg font-bold mb-2"><?= esc($m['judul']) ?></h3>
                                       
                                        <p class="text-sm text-gray-500"><?= date('D, d F Y', strtotime($m['created_at'])) ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-gray-600">Belum ada materi yang tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleAudio() {
            const audioPlayer = document.getElementById('audioPlayer');
            if (audioPlayer.classList.contains('hidden')) {
                audioPlayer.classList.remove('hidden');
                console.log('Audio player ditampilkan');
            } else {
                audioPlayer.classList.add('hidden');
                const audio = audioPlayer.querySelector('audio');
                if (audio) {
                    audio.pause();
                    audio.currentTime = 0;
                    console.log('Audio dihentikan dan player disembunyikan');
                }
            }
        }
    </script>
</body>
</html>