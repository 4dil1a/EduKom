<?php

namespace App\Controllers;

use App\Models\KuisModel;
use App\Models\QuestionModel;

class DetailKuis extends BaseController
{
    public function detailkuis($id)
    {
        // Memuat model Kuis dan Pertanyaan
        $kuisModel = new KuisModel();
        $questionModel = new QuestionModel();

        // Ambil detail kuis berdasarkan ID
        $kuis = $kuisModel->find($id);

        if (!$kuis) {
            return redirect()->to('/user/detail_kuis')->with('error', 'Kuis tidak ditemukan.');
        }

        // Ambil pertanyaan berdasarkan ID kuis
        $questions = $questionModel->where('kuis_id', $id)->findAll();

        // Kirim data ke view
        return view('detail_kuis', [
            'kuis' => $kuis,
            'questions' => $questions,
        ]);
    }
}
