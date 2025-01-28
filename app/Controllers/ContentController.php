<?php

namespace App\Controllers;

class ContentController extends BaseController
{
    public function kuis()
    {
        $data = [
            'title' => 'Judul Kuis',
            'description' => 'Deskripsi dan instruksi untuk kuis.'
        ];
        return view('kuis', $data);
    }

    public function materi()
    {
        $data = [
            'title' => 'Judul Materi',
            'description' => 'Deskripsi lengkap materi.'
        ];
        return view('materi', $data);
    }

    public function webinar()
    {
        $data = [
            'title' => 'Judul Webinar',
            'description' => 'Informasi lengkap tentang webinar, termasuk tanggal dan waktu pelaksanaan.'
        ];
        return view('webiner', $data);
    }
}
