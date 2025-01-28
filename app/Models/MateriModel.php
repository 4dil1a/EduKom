<?php

namespace App\Models;

use CodeIgniter\Model;

class MateriModel extends Model
{
    protected $table = 'materi'; // Nama tabel
    protected $primaryKey = 'materi_id'; // Primary key

    // Kolom yang dapat diisi
    protected $allowedFields = [
        'judul',
        'deskripsi',
        'gambar',
        'audio',
        'video',
        'penulis',
        'status',
        'unduh_materi',
        'created_at',
        'updated_at',
    ];

    // Gunakan timestamps
    protected $useTimestamps = true;

    /**
     * Ambil semua data materi
     */
    public function getMateri($id = null)
    {
        return $this->findAll();
    }

    /**
     * Ambil materi yang berstatus published
     */
    public function getPublishedMateri()
    {
        return $this->where('status', 'published')
                    ->orderBy('judul', 'DESC')
                    ->findAll();
    }

    /**
     * Cari materi berdasarkan kata kunci
     */
    public function searchMateri($keyword)
    {
        return $this->like('judul', $keyword)
                    ->where('status', 'published')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Ambil detail materi berdasarkan ID
     */
    public function getMateriById($id)
    {
        return $this->where('materi_id', $id)->first();
    }

    /**
     * Ambil sejumlah data materi yang dibatasi
     */
    public function getLimitedMateri($limit, $excludeId = null)
    {
        if ($excludeId) {
            $this->where('materi_id !=', $excludeId);
        }
        return $this->where('status', 'published')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
