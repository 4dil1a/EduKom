<?php

namespace App\Controllers;

use App\Models\KuisModel;
use App\Models\QuestionModel;
use App\Models\HasilModel;

class Kuis extends BaseController
{
    protected $kuisModel;
    protected $questionModel;
    protected $hasilModel;

    public function __construct()
    {
        $this->kuisModel = new KuisModel();
        $this->questionModel = new QuestionModel();
        $this->hasilModel = new HasilModel();
    }

    // Halaman utama kuis
    public function index()
    {
        $data['kuis'] = $this->kuisModel->getPublishedKuis();
        return view('user/kuis', $data);
    }

    // Halaman detail kuis
    public function detail($id)
    {
        $kuisModel = new KuisModel();
        $questionModel = new QuestionModel();

        // Ambil detail kuis
        $kuis = $kuisModel->find($id);

        if (!$kuis) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Kuis tidak ditemukan.');
        }

        // Ambil semua pertanyaan dan jawaban untuk kuis ini
        $pertanyaan = $questionModel->where('kuis_id', $id)->findAll();

        return view('user/detail_kuis', [
            'kuis' => $kuis,
            'pertanyaan' => $pertanyaan
        ]);
    }


    public function kerjakan_ulang($kuis_id)
{
    // Hapus hasil kuis sebelumnya
    $this->hasilModel
        ->where('kuis_id', $kuis_id)
        ->where('user_id', session()->get('user_id') ?? 1)
        ->delete();

    // Redirect ke halaman detail kuis untuk memulai ulang
    return redirect()->to(site_url("kuis/detail/{$kuis_id}"));
}

    public function submit()
{
    $kuisId = $this->request->getPost('kuis_id');
    $jawaban = $this->request->getPost('jawaban');

    $pertanyaan = $this->questionModel->where('kuis_id', $kuisId)->findAll();

    $score = 0;
    $totalQuestions = count($pertanyaan);
    $results = []; // Store results for review

    foreach ($pertanyaan as $q) {
        $userAnswer = $jawaban[$q['question_id']] ?? null;
        $isCorrect = $userAnswer === $q['jawaban_benar'];
        
        if ($isCorrect) {
            $score += 10;
        }

        // Add to results array
        $results[] = [
            'pertanyaan' => $q['pertanyaan'],
            'jawaban_user' => $userAnswer,
            'jawaban_benar' => $q['jawaban_benar'],
            'is_correct' => $isCorrect,
        ];
    }

    // Save to database
    $hasilData = [
        'kuis_id' => $kuisId,
        'user_id' => session()->get('user_id') ?? 1,
        'score' => $score,
        'total_soal' => $totalQuestions,
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $this->hasilModel->insert($hasilData);

    // Pass data to view
    $data = [
        'score' => $score,
        'total_score' => $totalQuestions * 10,
        'kuis' => $this->kuisModel->find($kuisId),
        'results' => $results, // Pass results to view
    ];

    return view('user/hasil_kuis', $data);
}
}
