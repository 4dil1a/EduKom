<?php

namespace App\Models;

use CodeIgniter\Model;

class KuisModel extends Model
{
    protected $table = 'kuis'; // Nama tabel sesuai dengan database terbaru
    protected $primaryKey = 'kuis_id'; // Primary key dari tabel
    protected $allowedFields = [
        'judul', 'status','created_at', 'updated_at'
    ]; // Hanya kolom yang diizinkan untuk diubah/ditambahkan

    
    public function saveKuis($data)
    {
        if (!isset($data['kuis_id'])) {
            // Insert jika kuis_id tidak ada
            return $this->insert($data);
        }

        // Update jika kuis_id ada
        return $this->update($data['kuis_id'], $data);
    }

    /**
     * Ambil semua kuis dari database.
     * 
     * @return array
     */
    public function getAllQuizzes()
    {
        return $this->findAll();
    }

    /**
     * Ambil kuis berdasarkan ID.
     * 
     * @param int $id
     * @return array|null
     */
    public function getQuizById($id)
    {
        return $this->find($id);
    }

    /**
     * Hapus kuis berdasarkan ID.
     * 
     * @param int $id
     * @return bool
     */
    public function deleteQuiz($id)
    {
        return $this->delete($id);
    }

    public function getPublishedKuis()
{
    return $this->where('status', 'published')
                ->orderBy('judul', 'DESC')
                ->findAll();
}

}