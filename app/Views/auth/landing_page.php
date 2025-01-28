<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduKom - Platform Pembelajaran Interaktif</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .blur-bg {
            filter: blur(2px);
            transition: filter 0.3s;
        }
        
        .card-hover:hover .blur-bg {
            filter: blur(0);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar with Logo -->
    <div class="absolute top-0 w-full flex justify-between items-center px-4 py-4 z-50">
        <!-- Add Logo Image Next to EduKom Text -->
        <div class="flex items-center space-x-2">
        <img src="<?= base_url('logo.png'); ?>" alt="EduKom Logo" class="h-8"> <!-- Logo Image -->

            <h1 class="text-2xl font-bold text-white">EduKom</h1>
        </div>
        <div class="flex space-x-4">
            <a href="<?= site_url('auth/login'); ?>" class="bg-transparent border-2 border-white text-white px-4 py-2 rounded hover:bg-white hover:text-blue-600 transition-colors duration-300">Login</a>
            <a href="<?= site_url('auth/register'); ?>" class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-gray-100 transition-colors duration-300">Daftar</a>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-cover bg-center h-96 relative" style="background-image: url('<?= base_url() ?>/bg.png');">
        <div class="absolute inset-0 bg-blue-500 opacity-50 filter blur-md z-0"></div>
        <div class="relative h-full flex justify-center items-center z-10">
            <div class="text-center text-white">
                <h2 class="text-4xl font-bold mb-4">Platform Pembelajaran Interaktif</h2>
                <p class="text-lg">Tingkatkan keterampilan Anda bersama EduKom</p>
            </div>
        </div>
    </section>

    <!-- Course Cards Section -->
    <section class="container mx-auto -mt-20 px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <a href="<?= site_url('courses/detail/1'); ?>" class="transform hover:-translate-y-1 transition-transform duration-300 card-hover">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="relative overflow-hidden h-48">
                        <img src="<?= base_url() ?>/bg1.jpg" alt="Kursus 1" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h4 class="text-lg font-bold text-blue-600">Belajar Design dengan Canva untuk Pemula</h4>
                        <p class="text-gray-600 text-sm mt-2">Januari 2024</p>
                    </div>
                </div>
            </a>

            <!-- Card 2 -->
            <a href="<?= site_url('courses/detail/2'); ?>" class="transform hover:-translate-y-1 transition-transform duration-300 card-hover">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="relative overflow-hidden h-48">
                        <img src="<?= base_url() ?>/bg2.jpg" alt="Kursus 2" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h4 class="text-lg font-bold text-blue-600">Kursus Web Development</h4>
                        <p class="text-gray-600 text-sm mt-2">Januari 2024</p>
                    </div>
                </div>
            </a>

            <!-- Card 3 -->
            <a href="<?= site_url('courses/detail/3'); ?>" class="transform hover:-translate-y-1 transition-transform duration-300 card-hover">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="relative overflow-hidden h-48">
                        <img src="<?= base_url() ?>/bg3.jpg" alt="Kursus 3" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h4 class="text-lg font-bold text-blue-600">Kursus Desain Grafis</h4>
                        <p class="text-gray-600 text-sm mt-2">Januari 2024</p>
                    </div>
                </div>
            </a>

            <!-- Card 4 -->
            <a href="<?= site_url('courses/detail/4'); ?>" class="transform hover:-translate-y-1 transition-transform duration-300 card-hover">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="relative overflow-hidden h-48">
                        <img src="<?= base_url() ?>/bg4.jpg" alt="Kursus 4" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h4 class="text-lg font-bold text-blue-600">Kursus Digital Marketing</h4>
                        <p class="text-gray-600 text-sm mt-2">Januari 2024</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Get Started Button -->
        <div class="text-center mt-8">
            <a href="<?= site_url('auth/login'); ?>" class="bg-blue-600 text-white px-12 py-4 text-xl rounded-full hover:bg-blue-700 transition-colors duration-300">
                Get Started → 
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-12 mt-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h4 class="text-xl font-bold mb-4">About Us</h4>
                <p class="text-white/90 mb-8">
                    EduKom adalah platform pembelajaran interaktif yang difasilitasi oleh Dinas Komunikasi dan Informatika (Kominfo) 
                    Kabupaten Pekalongan untuk masyarakat umum. Aplikasi ini menyediakan materi edukatif seputar keamanan data, 
                    transformasi digital, kecerdasan buatan (AI), dan berbagai topik lain terkait teknologi modern.
                </p>
                <div class="border-t border-white/20 pt-8">
                    <h4 class="text-xl font-bold mb-4">Ikuti Kami</h4>
                    <div class="flex justify-center space-x-6 mb-8">
                        <a href="#" class="text-white hover:text-gray-200 text-2xl"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white hover:text-gray-200 text-2xl"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white hover:text-gray-200 text-2xl"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <small>© 2024 All Rights Reserved Dinas Komunikasi dan Informatika Kabupaten Pekalongan</small>
            </div>
        </div>
    </footer>
</body>
</html>
