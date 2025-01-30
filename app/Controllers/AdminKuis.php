<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KuisModel;
use App\Models\QuestionModel;

class AdminKuis extends BaseController
{
    public function index()
    {
        $kuisModel = new KuisModel();
        $questionModel = new QuestionModel();

        $quizzes = $kuisModel->findAll();
        foreach ($quizzes as &$quiz) {
            $quiz['jumlah_soal'] = $questionModel->where('kuis_id', $quiz['kuis_id'])->countAllResults();
        }

        return view('admin/kuis', [
            'quizzes' => $quizzes,
        ]);
    }

    public function tambahKuis($kuisId = null)
    {
        $kuisModel = new KuisModel();
        $questionModel = new QuestionModel();

        $kuis = $kuisId ? $kuisModel->find($kuisId) : null;
        $soal = $kuisId ? $questionModel->getQuestionsByQuizId($kuisId) : [];

        return view('admin/tambah_kuis', [
            'kuis' => $kuis,
            'soal' => $soal,
        ]);
    }

    public function save()
    {
        $kuisModel = new KuisModel();
        $questionModel = new QuestionModel();

        $judul = $this->request->getPost('judul');
        $kuisId = $this->request->getPost('kuis_id');
        $status = $this->request->getPost('status');
        $pertanyaan = $this->request->getPost('pertanyaan');
        $jawaban_1 = $this->request->getPost('jawaban_1');
        $jawaban_2 = $this->request->getPost('jawaban_2');
        $jawaban_3 = $this->request->getPost('jawaban_3');
        $jawaban_4 = $this->request->getPost('jawaban_4');
        $jawaban_benar = $this->request->getPost('jawaban_benar');

        if (!$judul) {
            return redirect()->back()->with('error', 'Judul kuis harus diisi.')->withInput();
        }

        $dataKuis = [
            'judul' => $judul,
            'status' => $status ?? 'draft',
        ];

        if ($kuisId) {
            $kuisModel->update($kuisId, $dataKuis);
            $message = 'Kuis berhasil diperbarui.';
        } else {
            $kuisId = $kuisModel->insert($dataKuis);
            $message = 'Kuis berhasil ditambahkan.';
        }

        if ($pertanyaan && is_array($pertanyaan)) {
            foreach ($pertanyaan as $index => $pertanyaanItem) {
                if (isset($jawaban_1[$index], $jawaban_2[$index], $jawaban_3[$index], $jawaban_4[$index], $jawaban_benar[$index])) {
                    $dataSoal = [
                        'kuis_id' => $kuisId,
                        'pertanyaan' => $pertanyaanItem,
                        'jawaban_1' => $jawaban_1[$index],
                        'jawaban_2' => $jawaban_2[$index],
                        'jawaban_3' => $jawaban_3[$index],
                        'jawaban_4' => $jawaban_4[$index],
                        'jawaban_benar' => $jawaban_benar[$index],
                    ];
                    $questionModel->insert($dataSoal);
                }
            }
        }

        return redirect()->to('/admin/kuis')->with('success', $message);
    }

    public function editKuis($kuisId)
    {
        $referrer = $this->request->getGet('from') ?? 'kuis'; 
        session()->set('referrer', $referrer);

        $kuisModel = new KuisModel();
        $questionModel = new QuestionModel();

        $kuis = $kuisModel->find($kuisId);
        if (!$kuis) {
            return redirect()->to('/admin/' . $referrer)->with('error', 'Kuis tidak ditemukan');
        }

        $soal = $questionModel->where('kuis_id', $kuisId)->findAll();

        return view('admin/edit_kuis', [
            'kuis' => $kuis,
            'soal' => $soal,
            'referrer' => $referrer
        ]);
    }

    public function updateKuis($kuisId) 
    {
        $referrer = $this->request->getGet('from') ?? 'kuis';
        
        $kuisModel = new KuisModel();
        $questionModel = new QuestionModel();

        $kuisId = $this->request->getPost('kuis_id');
        $judul = $this->request->getPost('judul');
        $status = $this->request->getPost('status');
        $questionIds = $this->request->getPost('question_id');
        $pertanyaan = $this->request->getPost('pertanyaan');
        $jawaban_1 = $this->request->getPost('jawaban_1');
        $jawaban_2 = $this->request->getPost('jawaban_2');
        $jawaban_3 = $this->request->getPost('jawaban_3');
        $jawaban_4 = $this->request->getPost('jawaban_4');
        $jawaban_benar = $this->request->getPost('jawaban_benar');

        if (!$kuisId || !$judul) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        // Update kuis
        $kuisModel->update($kuisId, [
            'judul' => $judul,
            'status' => $status
        ]);

        // Update existing questions
        if ($questionIds && is_array($questionIds)) {
            foreach ($questionIds as $index => $qId) {
                if (isset($pertanyaan[$index])) {
                    $questionModel->update($qId, [
                        'pertanyaan' => $pertanyaan[$index],
                        'jawaban_1' => $jawaban_1[$index],
                        'jawaban_2' => $jawaban_2[$index],
                        'jawaban_3' => $jawaban_3[$index],
                        'jawaban_4' => $jawaban_4[$index],
                        'jawaban_benar' => $jawaban_benar[$index]
                    ]);
                }
            }
        }

        // Insert new questions
        $existingCount = count($questionIds ?? []);
        if ($pertanyaan && count($pertanyaan) > $existingCount) {
            for ($i = $existingCount; $i < count($pertanyaan); $i++) {
                $questionModel->insert([
                    'kuis_id' => $kuisId,
                    'pertanyaan' => $pertanyaan[$i],
                    'jawaban_1' => $jawaban_1[$i],
                    'jawaban_2' => $jawaban_2[$i],
                    'jawaban_3' => $jawaban_3[$i],
                    'jawaban_4' => $jawaban_4[$i],
                    'jawaban_benar' => $jawaban_benar[$i]
                ]);
            }
        }

        // Redirect based on referrer
        switch ($referrer) {
            case 'dashboard_kuis':
                return redirect()->to('/admin/dashboard_kuis')->with('success', 'Kuis berhasil diperbarui!');
            case 'kuis':
            default:
                return redirect()->to('/admin/kuis')->with('success', 'Kuis berhasil diperbarui!');
        }
    }

    public function delete($kuisId)
    {
        $referrer = $this->request->getGet('from') ?? 'kuis';
        $kuisModel = new KuisModel();
        $questionModel = new QuestionModel();

        // Delete associated questions first
        $questionModel->where('kuis_id', $kuisId)->delete();
        
        // Delete the quiz
        $kuisModel->delete($kuisId);

        $successMessage = 'Kuis beserta soal berhasil dihapus.';
        
        // Redirect based on referrer
        switch ($referrer) {
            case 'dashboard_kuis':
                return redirect()->to('/admin/dashboard_kuis')->with('success', $successMessage);
            case 'kuis':
            default:
                return redirect()->to('/admin/kuis')->with('success', $successMessage);
        }
    }
    public function deleteSoal($soalId)
    {
        $referrer = $this->request->getGet('from') ?? 'kuis';
        $questionModel = new QuestionModel();
        $questionModel->delete($soalId);
        return redirect()->back()->with('success', 'Soal berhasil dihapus.');
    }

    
}