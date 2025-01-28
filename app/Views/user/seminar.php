<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduKom - Info Seminar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f4f8;
        }
        .navbar, footer {
            background-color: #006d77;
        }
        .seminar-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            overflow: hidden;
        }
        .seminar-card:hover {
            transform: translateY(-2px);
        }
        .seminar-image {
            border-radius: 12px;
            overflow: hidden;
        }
        .status-badge {
            background: #e2e8f0;
            color: #4a5568;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
        }
        .filter-dropdown {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 0.5rem;
            background: white;
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
        .pagination-button.active {
            background-color: #006d77;
            color: white;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mx-auto px-4 py-8">
    <!-- Search and Filter -->
    <div class="flex justify-between items-center mb-8">
        <div class="relative w-64">
            <input type="text" 
                   placeholder="Cari Event" 
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
            <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-gray-600">Urut berdasarkan:</span>
            <select class="filter-dropdown">
                <option>Terbaru</option>
                <option>Terlama</option>
                <option>A-Z</option>
                <option>Z-A</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if (!empty($seminars)): ?>
        <?php foreach ($seminars as $seminar): ?>
            <div class="seminar-card">
                <a href="<?= base_url('seminar/detail/' . $seminar['seminar_id']) ?>" class="block">
                   
                    <div class="course-image" style="overflow: hidden;">
                        <?php if ($seminar['poster'] && file_exists(FCPATH . $seminar['poster'])): ?>
                            <img src="<?= base_url($seminar['poster']) ?>" 
                                 alt="<?= esc($seminar['judul']) ?>"
                                 class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="p-6 text-white bg-[#7209b7]">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-bold mb-2"><?= esc($seminar['judul']) ?></h3>
                                    </div>
                                    <img src="<?= base_url('assets/images/canva-logo.png') ?>" 
                                         alt="Logo" 
                                         class="w-10 h-10 rounded-full bg-cyan-400">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-4">
                        <h4 class="font-semibold mb-2 hover:text-blue-600"><?= esc($seminar['judul']) ?></h4>
                        <p class="text-sm text-gray-600 mb-4">Oleh: <?= esc($seminar['penyelenggara']) ?></p>
                        <div class="flex justify-end">
                            <span class="status-badge"><?= ucfirst($seminar['status']) ?></span>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-gray-600">Belum ada seminar yang tersedia.</p>
    <?php endif; ?>
</div>




<!-- Pagination -->
<div class="flex justify-center space-x-2 mt-8">
    <button class="pagination-button active">1</button>
    <button class="pagination-button">2</button>
    <button class="pagination-button">3</button>
    <span class="pagination-button">...</span>
    <button class="pagination-button">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>

<footer class="text-white py-8">
    <div class="container mx-auto px-4">
        <div class="mb-6">
            <h3 class="text-xl font-bold mb-4">About Us</h3>
            <p class="text-sm">
                EduKom adalah platform pembelajaran interaktif yang 
                dirancang untuk membantu Anda menguasai keahlian 
                desain secara efektif. Dengan fokus pada Canva, kami 
                menyediakan materi edukatif dengan pendekatan praktis yang 
                mudah diikuti, cocok bagi pemula hingga menengah.
            </p>
        </div>
        <div class="flex space-x-4">
            <a href="#" class="hover:text-gray-200">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="hover:text-gray-200">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="#" class="hover:text-gray-200">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
    </div>
</footer>

<script>
    // Filter dropdown functionality
    const filterSelect = document.querySelector('.filter-dropdown');
    filterSelect.addEventListener('change', function() {
        // Implement sorting logic here
    });

    // Search functionality
    const searchInput = document.querySelector('input[placeholder="Cari Event"]');
    searchInput.addEventListener('input', function() {
        // Implement search logic here
    });

    // Pagination functionality
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
</script>

</body>
</html>
