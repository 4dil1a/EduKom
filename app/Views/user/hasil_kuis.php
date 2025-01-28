<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .score-summary {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            text-align: center;
        }

        .score-summary div {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .score-summary h2 {
            margin: 0;
            font-size: 24px;
            color: #007bff;
        }

        .btn {
            display: block;
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .review {
            margin-top: 30px;
        }

        .review h3 {
            margin-bottom: 20px;
            text-align: center;
        }

        .questions {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .question {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            background: #f9f9f9;
        }

        .question.correct {
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .question.incorrect {
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .question h4 {
            margin: 0 0 10px 0;
            color: #333;
        }

        .question p {
            margin: 5px 0;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kuis - <?= esc($kuis['judul']) ?></h1>
        
        <div class="score-summary">
            <div>
                <h2><?= $score / 10 ?> Jawaban Benar</h2>
            </div>
            <div>
                <h2><?= (count($results) - $score / 10) ?> Jawaban Salah</h2>
            </div>
            <div>
                <h2>Total Skor: <?= $score ?></h2>
            </div>
        </div>
        
      

    
        <div class="review">
            <h3>Review Jawaban</h3>
            <div class="questions">
                <?php foreach ($results as $index => $result): ?>
                    <div class="question <?= $result['is_correct'] ? 'correct' : 'incorrect' ?>">
                        <h4>Pertanyaan <?= $index + 1 ?></h4>
                        <p><?= esc($result['pertanyaan']) ?></p>
                        <p>Jawaban Anda: <?= esc($result['jawaban_user'] ?? 'Tidak Dijawab') ?></p>
                        <p>Jawaban Benar: <?= esc($result['jawaban_benar']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


<a href="<?= site_url('kuis/kerjakan_ulang/' . $kuis['kuis_id']) ?>" class="btn">
    Kerjakan Ulang
</a>

<a href="<?= site_url('/kuis') ?>" class="btn">
    Kembali ke Daftar Kuis
</a>

    </div>
</body>
</html>
