<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduKom - Video Materi</title>
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
                    <a href="<?= base_url('materi/detail/' . $materi['materi_id']) ?>" class="custom-button">
                        <i class="fas fa-arrow-left"></i> Kembali ke Detail Materi
                    </a>
                </div>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="mt-4 text-red-500">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="materi-content">
                <div class="aspect-w-16 aspect-h-9 mb-6">
                    <video controls class="w-full h-auto rounded-lg shadow-lg">
                        <source src="<?= base_url($materi['video']) ?>" type="video/mp4">
                        Browser Anda tidak mendukung pemutaran video.
                    </video>
                </div>
                <div class="mt-4">
                    <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
                    <p class="text-gray-700"><?= nl2br(htmlspecialchars_decode(esc($materi['deskripsi']))) ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>