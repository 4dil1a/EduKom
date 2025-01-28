<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $course['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .close-btn {
            transition: transform 0.2s ease;
        }
        .close-btn:hover {
            transform: scale(1.1);
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 400px;
            border-radius: 10px;
            text-align: center;
        }
        .modal-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .modal-close:hover,
        .modal-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .blur-effect {
            filter: blur(2px);
        }
    </style>
    <script>
        function handleReadMore() {
            const isLoggedIn = false;
            if (!isLoggedIn) {
                const modal = document.getElementById("loginModal");
                modal.style.display = "block";
            } else {
                window.location.href = '/full-article';
            }
        }
        function closeModal() {
            const modal = document.getElementById("loginModal");
            modal.style.display = "none";
        }
        function handleClose() {
            window.history.back();
        }
    </script>
</head>
<body class="bg-gradient-to-r from-blue-200 to-indigo-300 flex items-center justify-center min-h-screen">
    <div class="bg-white max-w-3xl p-10 rounded-2xl shadow-2xl relative fade-in">
        <button onclick="handleClose()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 close-btn text-2xl">&times;</button>
        <h1 class="text-3xl font-extrabold text-gray-900 text-center mb-6 leading-tight">Belajar Design dengan Canva<br>untuk Pemula</h1>
        <p class="text-sm text-blue-500 mb-6 text-center">24 Januari 2025</p>
        <p class="text-gray-700 leading-relaxed text-lg">
            Artikel adalah bentuk karya tulis yang menyediakan informasi atau pandangan dari penulis. Biasanya, artikel berbentuk tulisan yang pendek, yaitu sekitar 350 hingga 2000 kata, meskipun begitu, ada juga artikel yang panjangnya melebihi 2000 kata. Panjangnya yang berbeda-beda, akan tergantung dari seberapa banyak informasi yang ingin disampaikan.
        </p>
        <p class="text-gray-700 leading-relaxed mt-6 text-lg">
            Artikel juga memiliki beberapa struktur yang menyusun penulisannya. Artikel yang baik memiliki tiga struktur seperti di bawah ini:
        </p>
        <ul class="list-disc pl-8 mt-6 text-gray-700 text-lg">
            <li><strong>Gagasan utama:</strong> ide utama atau isu yang ingin ditulis di dalam artikel.</li>
            <li><strong>Argumentasi atau pendapat:</strong> statement atau pendapat dari penulis atau pembuat artikel terhadap isu yang dituliskan.</li>
            <li class="blur-effect"><strong>Penegasan ulang:</strong> argumentasi yang dibuat untuk menegaskan kembali apa yang sedang dibahas, hal ini bisa berupa kesimpulan dari artikel yang ditulis.</li>
        </ul>
        <div class="text-center mt-8">
            <button onclick="handleReadMore()" class="bg-blue-600 text-white px-8 py-4 rounded-xl text-lg hover:bg-blue-700 transition-all shadow-lg">Baca Selengkapnya >></button>
        </div>
    </div>

    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <h2 class="text-2xl font-bold mb-4">Login Diperlukan</h2>
            <p>Silakan login atau daftar untuk melanjutkan.</p>
            <div class="mt-6">
                <button onclick="window.location.href='/auth/login'" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Login</button>
            </div>
        </div>
    </div>
</body>
</html>
