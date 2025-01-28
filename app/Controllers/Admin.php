<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SeminarModel;  // Pastikan untuk mengimport model Seminar
use App\Models\MateriModel;
use App\Models\KuisModel;
use App\Models\QuestionModel;

class Admin extends BaseController
{
    protected $userModel;
    protected $seminarModel;  // Tambahkan seminarModel
    protected $materiModel;
    protected $kuisModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->seminarModel = new SeminarModel();  // Inisialisasi SeminarModel
        $this->materiModel = new MateriModel();
        $this->kuisModel = new KuisModel();
    }

    // Menampilkan dashboard
    public function dashboard()
    {
        // Cek apakah user sudah login dan memiliki role admin
        if (session()->get('role') != 'admin') {
            return redirect()->to('/auth/login');
        }

        // Ambil jumlah pengguna untuk ditampilkan di dashboard
        $jumlahPengguna = $this->userModel->countAll();
        $jumlahSeminar = $this->seminarModel->countAll();
        $jumlahMateri = $this->materiModel->countAll();
        $jumlahKuis = $this->kuisModel->countAll();
    
        // Modify to get only 3 most recent items
        $materi = $this->materiModel->orderBy('created_at', 'DESC')->findAll(3);
        $kuis = $this->kuisModel->orderBy('created_at', 'DESC')->findAll(3);
    
        return view('admin/dashboard', [
            'jumlahPengguna' => $jumlahPengguna,
            'jumlahSeminar' => $jumlahSeminar,
            'jumlahMateri' => $jumlahMateri,
            'jumlahKuis' => $jumlahKuis,
            'materi' => $materi,
            'kuis' => $kuis,
        ]);
    }



    public function dashboardSeminar()
    {
        // Mendapatkan data seminar dari model
        $seminarModel = new SeminarModel();
        $seminars = $seminarModel->findAll();
    
        $jumlahPengguna = $this->userModel->countAll();
        $jumlahSeminar = $this->seminarModel->countAll();
        $jumlahMateri = $this->materiModel->countAll();
        $jumlahKuis = $this->kuisModel->countAll();
    
        // Get only 3 most recent seminars
        $seminars = $this->seminarModel->orderBy('created_at', 'DESC')->findAll(3);
    
        return view('admin/dashboard_seminar', [
            'jumlahPengguna' => $jumlahPengguna,
            'jumlahSeminar' => $jumlahSeminar,
            'jumlahMateri' => $jumlahMateri,
            'jumlahKuis' => $jumlahKuis,
            'seminars' => $seminars
        ]);
    }
    

    public function dashboardPengguna()
    {
        // Mendapatkan data seminar dari model
        $userModel = new UserModel();
        $pengguna = $userModel->findAll();
    
        // Ambil jumlah pengguna untuk ditampilkan di dashboard
        $jumlahPengguna = $this->userModel->countAll();
        $jumlahSeminar = $this->seminarModel->countAll();
        $jumlahMateri = $this->materiModel->countAll();
        $jumlahKuis = $this->kuisModel->countAll();
    
        // Get only 3 most recent users
        $pengguna = $this->userModel->orderBy('created_at', 'DESC')->findAll(3);
    
        return view('admin/dashboard_pengguna', [
            'jumlahPengguna' => $jumlahPengguna,
            'jumlahSeminar' => $jumlahSeminar,
            'jumlahMateri' => $jumlahMateri,
            'jumlahKuis' => $jumlahKuis,
            'pengguna' => $pengguna
        ]);
    }


    public function dashboardKuis()
    {
        $questionModel = new QuestionModel();
    
        $jumlahPengguna = $this->userModel->countAll();
        $jumlahSeminar = $this->seminarModel->countAll();
        $jumlahMateri = $this->materiModel->countAll();
        $jumlahKuis = $this->kuisModel->countAll();
    
        // Get only 3 most recent quizzes with question count
        $quizzes = $this->kuisModel->orderBy('created_at', 'DESC')->findAll(3);
        foreach ($quizzes as &$quiz) {
            $quiz['jumlah_soal'] = $questionModel->where('kuis_id', $quiz['kuis_id'])->countAllResults();
        }
    
        return view('admin/dashboard_kuis', [
            'jumlahPengguna' => $jumlahPengguna,
            'jumlahSeminar' => $jumlahSeminar,
            'jumlahMateri' => $jumlahMateri,
            'jumlahKuis' => $jumlahKuis,
            'quizzes' => $quizzes
        ]);
    }
    // Menampilkan halaman data pengguna
    public function dataPengguna()
    {
        // Cek apakah user sudah login dan memiliki role admin
        if (session()->get('role') != 'admin') {
            return redirect()->to('/auth/login');
        }
    
        // Ambil semua data pengguna dari database
        $users = $this->userModel->findAll();
    
        // Kirim data ke view data_pengguna
        return view('admin/data_pengguna', [
            'users' => $users
        ]);
    }
    
    

    // Fungsi untuk menghapus pengguna
    public function hapusPengguna($userId)
    {
        // Cek apakah user sudah login dan memiliki role admin
        if (session()->get('role') != 'admin') {
            return redirect()->to('/auth/login');
        }

        // Hapus data pengguna berdasarkan ID
        $user = $this->userModel->find($userId);

        // Jika data pengguna tidak ditemukan
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengguna tidak ditemukan');
        }

        // Menghapus data pengguna
        $this->userModel->delete($userId);

        // Set flash message untuk memberi tahu bahwa pengguna telah dihapus
        session()->setFlashdata('success', 'Pengguna berhasil dihapus');

        // Redirect kembali ke halaman data pengguna
        $referrer = $this->request->getServer('HTTP_REFERER');
        
        if (strpos($referrer, 'dashboard_pengguna') !== false) {
            return redirect()->to('/admin/dashboard_pengguna');
        } elseif (strpos($referrer, 'data_pengguna') !== false) {
            return redirect()->to('/admin/data_pengguna');
        }

        // Default fallback
        return redirect()->to('/admin/data_pengguna');
    }

    // Menampilkan halaman detail pengguna
    public function lihatPengguna($userId)
    {
        // Ambil data pengguna berdasarkan ID
        $user = $this->userModel->find($userId);

        // Jika data pengguna tidak ditemukan
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengguna tidak ditemukan');
        }

        $referrer = $this->request->getServer('HTTP_REFERER');
        
        // Determine the back URL based on the referrer
        $backUrl = '/admin/data_pengguna'; // Default fallback
        
        if (strpos($referrer, 'dashboard_pengguna') !== false) {
            $backUrl = '/admin/dashboard_pengguna';
        } elseif (strpos($referrer, 'data_pengguna') !== false) {
            $backUrl = '/admin/data_pengguna';
        } elseif (strpos($referrer, 'dashboard') !== false) {
            $backUrl = '/admin/dashboard';
        }

        // Kirim data ke view lihat_pengguna
        return view('admin/lihat_pengguna', [
            'user' => $user,
            'backUrl' => $backUrl
]);
}
}
