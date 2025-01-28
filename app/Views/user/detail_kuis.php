<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($kuis['judul']); ?> - EduKom</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4"><?= htmlspecialchars($kuis['judul']); ?></h1>

        <form id="quizForm" method="POST" action="<?= site_url('kuis/submit'); ?>">
            <input type="hidden" name="kuis_id" value="<?= $kuis['kuis_id']; ?>">
            
            <?php foreach ($pertanyaan as $index => $q): ?>
                <div class="mb-6 p-4 border rounded-lg">
                    <h2 class="text-lg font-semibold mb-3">
                        Soal <?= $index + 1; ?>: <?= htmlspecialchars($q['pertanyaan']); ?>
                    </h2>
                    
                    <div class="space-y-2">
                        <?php 
                        $choices = [
                            ['label' => 'A', 'value' => $q['jawaban_1']],
                            ['label' => 'B', 'value' => $q['jawaban_2']],
                            ['label' => 'C', 'value' => $q['jawaban_3']],
                            ['label' => 'D', 'value' => $q['jawaban_4']]
                        ];
                        ?>
                        
                        <?php foreach ($choices as $choice): ?>
                            <div class="flex items-center">
                                <input 
                                    type="radio" 
                                    id="soal-<?= $q['question_id'] ?>-<?= $choice['label'] ?>" 
                                    name="jawaban[<?= $q['question_id'] ?>]" 
                                    value="<?= $choice['value'] ?>" 
                                    class="mr-3"
                                >
                                <label 
                                    for="soal-<?= $q['question_id'] ?>-<?= $choice['label'] ?>" 
                                    class="flex-1"
                                >
                                    <?= $choice['label'] ?>. <?= htmlspecialchars($choice['value']) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="text-center mt-6">
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600"
                >
                    Selesaikan Kuis
                </button>
            </div>
        </form>
    </div>

    <script>
    document.getElementById('quizForm').addEventListener('submit', function(e) {
        const questions = document.querySelectorAll('input[type="radio"][name^="jawaban"]');
        const questionGroups = {};

        questions.forEach(radio => {
            const name = radio.getAttribute('name');
            if (!questionGroups[name]) {
                questionGroups[name] = [];
            }
            questionGroups[name].push(radio);
        });

        let allAnswered = true;
        Object.values(questionGroups).forEach(group => {
            const answered = group.some(radio => radio.checked);
            if (!answered) {
                allAnswered = false;
            }
        });

        if (!allAnswered) {
            e.preventDefault();
            alert('Harap jawab semua pertanyaan sebelum menyelesaikan kuis.');
        }
    });
    </script>
</body>
</html>