<?php

namespace App\Models;

use CodeIgniter\Model;

class SeminarModel extends Model
{
    protected $table = 'seminars';
    protected $primaryKey = 'seminar_id';

    protected $allowedFields = [
        'judul',
        'deskripsi',
        'penyelenggara',
        'bentuk_acara',
        'tanggal',
        'poster',
        'jam',
        'status',
        'created_at',
        'updated_at'
    ];

    // Tambahkan fungsi untuk mendapatkan semua data seminar
    public function getSeminars()
    {
        return $this->findAll(); // Mengambil semua data seminar
    }

    public function updateSeminar($seminar_id, $data)
{
    return $this->update($seminar_id, $data);
}

public function getPublishedSeminars()
{
    return $this->where('status', 'published')
                ->orderBy('tanggal', 'DESC')
                ->findAll();
}

}
