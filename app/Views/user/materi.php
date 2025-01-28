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
        .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.2s;
        cursor: pointer;
        overflow: hidden;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    /* Tambahkan hover effect untuk gambar */
    .card:hover .course-image img {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
      
        .course-image {
        aspect-ratio: 16/9;
        position: relative;
        border-radius: 12px 12px 0 0;
        overflow: hidden;
        background-color: #7209b7;
    }
    
    .course-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
        .pagination-button {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background-color: white;
            color: #006d77;
            transition: all 0.2s;
        }
        .pagination-button:hover {
            background-color: #e0f2f1;
        }
        .pagination-button.active {
            background-color: #006d77;
            color: white;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
    <!-- Materi Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if (!empty($materis)): ?>
        <?php foreach ($materis as $materi): ?>
            <div class="card">
                <a href="<?= base_url('materi/detail/' . $materi['materi_id']) ?>" class="block">
                    <!-- Ubah bagian image -->
                    <div class="course-image" style="overflow: hidden;">
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
                    <div class="p-4">
                        <h4 class="font-semibold mb-2"><?= esc($materi['judul']) ?></h4>
                        <p class="text-sm text-gray-600">
                            <?= date('D, d F Y', strtotime($materi['created_at'])) ?>
                        </p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-gray-600 col-span-full">Belum ada materi yang tersedia.</p>
    <?php endif; ?>
</div>
</div>



        <!-- Pagination -->
        <div class="flex justify-center space-x-2 mt-8 mb-8">
            <button class="pagination-button active">1</button>
            <button class="pagination-button">2</button>
            <button class="pagination-button">3</button>
            <span class="pagination-button">...</span>
            <button class="pagination-button">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        // Pagination interactivity
        document.querySelectorAll('.pagination-button').forEach(button => {
            button.addEventListener('click', function() {
                if (this.textContent !== '...') {
                    document.querySelectorAll('.pagination-button').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');
                }
            });
        });

        // Search functionality
        const searchInput = document.querySelector('input[placeholder="Cari Materi"]');
        searchInput.addEventListener('input', function() {
            // Implement search logic here
            const searchTerm = this.value.toLowerCase();
            // Filter cards based on search term
        });
    </script>
</body>
</html>