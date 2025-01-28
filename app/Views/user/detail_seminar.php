<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Seminar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Poster -->
            <div class="w-full h-96 overflow-hidden">
            <?php if ($seminar['poster']): ?>
        <img src="<?= base_url($seminar['poster']) ?>" alt="<?= esc($seminar['judul']) ?>" 
             onerror="this.src='<?= base_url('assets/images/placeholder.jpg') ?>'" >
    <?php else: ?>
        <img src="<?= base_url('assets/images/placeholder.jpg') ?>" alt="Default Image">
    <?php endif; ?>
            </div>

            <!-- Konten Detail -->
            <div class="p-6">
                <!-- Judul -->
                <h1 class="text-3xl font-bold text-gray-800 mb-4">
                    <?= esc($seminar['judul']) ?>
                </h1>

                <!-- Penyelenggara -->
                <div class="text-gray-600 mb-4">
                    <strong>Diselenggarakan oleh:</strong> 
                    <?= esc($seminar['penyelenggara']) ?>
                </div>

                <!-- Deskripsi -->
                <div class="text-gray-700 leading-relaxed">
                    <?= nl2br(esc($seminar['deskripsi'])) ?>
                </div>

                <!-- Detail Tambahan -->
                <div class="mt-6 border-t pt-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <strong>Tanggal:</strong> 
                            <?= date('d F Y', strtotime($seminar['tanggal'])) ?>
                        </div>
                        <div>
                            <strong>Bentuk Acara:</strong> 
                            <?= esc($seminar['bentuk_acara']) ?>
                        </div>
                        <div>
                            <strong>Jam:</strong> 
                            <?= esc($seminar['jam']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>