<?php

namespace App\Controllers;

use App\Models\MateriModel;

class Materi extends BaseController
{
    protected $materiModel;

    public function __construct()
    {
        // Inisialisasi MateriModel
        $this->materiModel = new MateriModel();
    }

    public function index()
    {
        $data['materis'] = $this->materiModel
            ->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->paginate(9);
        $data['pager'] = $this->materiModel->pager;

        return view('user/materi', $data);
    }

    public function detail($materi_id)
    {
        // Ambil data materi berdasarkan ID
        $materi = $this->materiModel->find($materi_id);
    
        if (!$materi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    
        // Ambil rekomendasi materi lainnya
        $materiLainnya = $this->materiModel
            ->where('materi_id !=', $materi_id) // Hindari materi saat ini
            ->where('status', 'published') // Hanya yang status published
            ->orderBy('created_at', 'DESC') // Urutkan berdasarkan tanggal terbaru
            ->limit(3) // Batasi jumlah materi yang ditampilkan
            ->findAll();
    
        $data = [
            'materi' => $materi,
            'materiLainnya' => $materiLainnya,
        ];
    
        return view('user/detail_materi', $data);
    }
    
    


    public function video($materi_id)
{
    // Ambil data materi berdasarkan ID
    $materi = $this->materiModel->find($materi_id);

    if (!$materi) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    // Debug: Cek nilai video dari database
    log_message('debug', 'Video path from database: ' . $materi['video']);

    // Cek apakah video tersedia
    if (empty($materi['video'])) {
        return view('user/video_materi', [
            'materi' => $materi,
            'title' => 'Video Tidak Tersedia',
            'error' => 'Maaf, video untuk materi ini belum tersedia.'
        ]);
    }

    $data = [
        'materi' => $materi,
        'title' => 'Tonton Video: ' . $materi['judul']
    ];

    return view('user/video_materi', $data);
}
    
    
    

    public function audio($materi_id)
    {
        $materi = $this->materiModel->find($materi_id);

        if (!$materi || empty($materi['audio'])) {
            return $this->response->setStatusCode(404)->setBody('Audio tidak ditemukan');
        }

        $audioPath = FCPATH . 'uploads/audio/' . $materi['audio'];

        if (!is_file($audioPath)) {
            return $this->response->setStatusCode(404)->setBody('File audio tidak ditemukan');
        }

        $this->response->setHeader('Content-Type', 'audio/mpeg');
        $this->response->setHeader('Content-length', filesize($audioPath));
        $this->response->setHeader('Content-Disposition', 'inline; filename="' . basename($audioPath) . '"');
        $this->response->setHeader('Accept-Ranges', 'bytes');
        $this->response->setHeader('X-Pad', 'avoid browser bug');
        $this->response->setHeader('Cache-Control', 'no-cache');

        readfile($audioPath);
        return $this->response;
    }


    public function unduh($materi_id)
    {
        $materi = $this->materiModel->find($materi_id);
        
        if (!$materi || empty($materi['unduh_materi'])) {
            return $this->response->setStatusCode(404)->setBody('Materi tidak ditemukan');
        }
    
        $pdfPath = FCPATH . $materi['unduh_materi'];
        
        if (!file_exists($pdfPath)) {
            return $this->response->setStatusCode(404)->setBody('File PDF tidak ditemukan');
        }
    
        return $this->response->setHeader('Content-Type', 'application/pdf')
                              ->setHeader('Content-Disposition', 'attachment; filename="' . basename($pdfPath) . '"')
                              ->setBody(file_get_contents($pdfPath));
    }
    

}