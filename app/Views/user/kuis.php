<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edukom";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil kuis dengan status published
$sql = "SELECT * FROM kuis WHERE status = 'published'";
$result = $conn->query($sql);

$quizzes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $quizzes[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis Publik - EduKom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .quiz-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .quiz-thumbnail {
            background-color: #6c63ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            padding: 20px;
            font-size: 1.2rem;
            text-align: center;
        }
    </style>
</head>
<body class="bg-gray-100">

<?php include 'navbar.php'; ?>

<div class="container mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Kuis</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($quizzes)): ?>
            <?php foreach ($quizzes as $quiz): ?>
                <div class="quiz-card">
                    <div class="quiz-thumbnail">
                        <span><?= htmlspecialchars($quiz['judul']); ?></span>
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold mb-2"><?= htmlspecialchars($quiz['judul']); ?></h2>
                        
                        <p class="text-sm text-gray-600 mt-2">20 menit</p>
                        <a href="<?= site_url('kuis/detail/' . $quiz['kuis_id']); ?>" class="inline-block mt-4 px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded hover:bg-teal-700">
                            Mulai >>
                        </a>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-600">Belum ada kuis yang dipublikasikan.</p>
        <?php endif; ?>
    </div>

    <div class="text-center mt-8">
        <a href="#" class="px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded hover:bg-teal-700">Lainnya >></a>
    </div>
</div>
</body>
</html>
