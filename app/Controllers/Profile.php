<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\HasilModel;
use CodeIgniter\Controller;

class Profile extends Controller
{

    
    public function profile($userId)
    {
        // Cek apakah user sudah login dan ID di session sesuai dengan ID yang ada di URL
        if (session()->get('user_id') != $userId) {
            return redirect()->to('/auth/login');
        }

        $userModel = new UserModel();
        $hasilModel = new HasilModel();

        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/auth/login');
        }

        // Fetch quiz results with related kuis information
        $data['quiz_results'] = $hasilModel
            ->select('hasil.score, kuis.judul, hasil.created_at')
            ->join('kuis', 'kuis.kuis_id = hasil.kuis_id')
            ->where('hasil.user_id', $userId)
            ->orderBy('hasil.created_at', 'DESC')
            ->findAll();

        return view('user/profile', $data);
    }
}