<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduKom - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f4f8;
        }
        .navbar {
            background-color: #006d77;
        }
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            height: 350px;
            max-width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-2px);
        }
        .course-image {
            background: #7209b7;
            border-radius: 12px 12px 0 0;
            aspect-ratio: 16/9;
            height: 200px;
            overflow: hidden;
        }
        .header-overlay {
            background-color: rgba(23, 107, 135, 0.6);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        .header-content {
            position: relative;
            z-index: 2;
        }
        .custom-btn {
            background-color: #006d77;
            transition: background-color 0.3s;
        }
        .custom-btn:hover {
            background-color: #1d6d7a;
        }
        .course-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .card .p-4 {
            padding: 16px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        h3 {
            font-size: 1.125rem;
            font-weight: bold;
            color: #333;
            flex-grow: 1;
            margin-bottom: 8px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        p {
            font-size: 0.875rem;
            color: #555;
            margin-top: 8px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Hero Section -->
    <header class="relative">
        <div class="relative h-96 bg-cover bg-center" style="background-image: url('<?= base_url() ?>/bg.png');">
            <div class="header-overlay"></div>
            <div class="header-content flex flex-col items-start justify-center text-left text-white h-full pl-6">
                <h1 class="text-5xl font-bold">Selamat Datang di</h1>
                <h2 class="text-5xl font-bold">EduKom!</h2>
                <p class="mt-4 text-lg">Tingkatkan pengetahuan dan keterampilan digital Anda bersama EduKom!</p>
            </div>
        </div>
    </header>

    <!-- Materi Section -->
    <section class="container mx-auto -mt-20 px-4 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($materis as $materi): ?>
                <a href="<?= base_url('materi/detail/' . $materi['materi_id']) ?>" class="block">
                    <div class="card">
                        <!-- Menampilkan gambar -->
                        <div class="course-image">
                            <?php if ($materi['gambar'] && file_exists(FCPATH . $materi['gambar'])): ?>
                                <img src="<?= base_url($materi['gambar']) ?>" 
                                     alt="<?= esc($materi['judul']) ?>"
                                     class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="p-6 text-white bg-[#7209b7]">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-xl font-bold mb-2"><?= esc($materi['judul']) ?></h3>
                                        </div>
                                        <img src="<?= base_url('assets/images/canva-logo.png') ?>" 
                                             alt="Logo" 
                                             class="w-10 h-10 rounded-full bg-cyan-400">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- Konten kartu -->
                        <div class="p-4">
                            <!-- Judul Materi -->
                            <h3 class="text-lg font-bold text-gray-800"><?= esc($materi['judul']) ?></h3>
                            <!-- Tanggal Diterbitkan -->
                            <p class="text-sm text-gray-600 mt-1">Diterbitkan pada: <?= esc($materi['created_at']) ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <div class="text-center mt-8 mb-8">
        <a href="/materi" class="px-6 py-2 text-white rounded-lg custom-btn">
            <span class="font-bold">Lihat Semua</span> <i class="fa fa-arrow-right ml-2"></i>
        </a>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
