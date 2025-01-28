<?php

namespace App\Controllers;

use App\Models\SeminarModel;

class Seminar extends BaseController
{
    protected $seminarModel;

    public function __construct()
    {
        // Inisialisasi SeminarModel
        $this->seminarModel = new SeminarModel();
    }

    public function index()
    {
        $data['seminars'] = $this->seminarModel
            ->where('status', 'published') // Hanya seminar dengan status "published"
            ->orderBy('created_at', 'DESC') // Urutkan berdasarkan tanggal terbaru
            ->paginate(9); // Batasi jumlah seminar per halaman

        $data['pager'] = $this->seminarModel->pager;

        return view('user/seminar', $data);
    }

    public function detail($seminar_id)
    {
        // Ambil data seminar berdasarkan ID
        $seminar = $this->seminarModel->find($seminar_id);

        if (!$seminar) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

    
        $data = [
            'seminar' => $seminar,
      
        ];

        return view('user/detail_seminar', $data);
    }
}