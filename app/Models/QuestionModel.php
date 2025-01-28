<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    // Menentukan nama tabel yang akan digunakan
    protected $table = 'questions';

    // Menentukan primary key untuk tabel
    protected $primaryKey = 'question_id';

    // Menentukan kolom yang boleh diisi (insert/update)
    protected $allowedFields = [
        'kuis_id', 
        'pertanyaan', 
        'jawaban_1', 
        'jawaban_2', 
        'jawaban_3', 
        'jawaban_4', 
        'jawaban_benar',
        'created_at',
        'updated_at'
    ];

    // Menambahkan timestamp otomatis (created_at dan updated_at)
    protected $useTimestamps = true;

    // Menentukan format waktu untuk timestamps
    protected $dateFormat = 'datetime';


    // Validasi untuk memastikan data soal yang dikirimkan lengkap
   // Validasi untuk memastikan data soal yang dikirimkan lengkap
protected $validationRules = [
    'kuis_id' => 'required|integer',
    'pertanyaan' => 'required|string',
    'jawaban_1' => 'required|string',
    'jawaban_2' => 'required|string',
    'jawaban_3' => 'required|string',
    'jawaban_4' => 'required|string',
    'jawaban_benar' => 'required|string'
];


   // Menentukan pesan error validasi
protected $validationMessages = [
    'kuis_id' => [
        'required' => 'ID kuis harus diisi.',
        'integer' => 'ID kuis harus berupa angka.',
    ],
    'pertanyaan' => [
        'required' => 'Pertanyaan harus diisi.',
        'string' => 'Pertanyaan harus berupa teks.',
    ],
    'jawaban_1' => [
        'required' => 'Jawaban 1 harus diisi.',
        'string' => 'Jawaban 1 harus berupa teks.',
    ],
    'jawaban_2' => [
        'required' => 'Jawaban 2 harus diisi.',
        'string' => 'Jawaban 2 harus berupa teks.',
    ],
    'jawaban_3' => [
        'required' => 'Jawaban 3 harus diisi.',
        'string' => 'Jawaban 3 harus berupa teks.',
    ],
    'jawaban_4' => [
        'required' => 'Jawaban 4 harus diisi.',
        'string' => 'Jawaban 4 harus berupa teks.',
    ],
    'jawaban_benar' => [
        'required' => 'Jawaban benar harus dipilih.',
        'string' => 'Jawaban benar harus berupa teks.',
       
    ],
];

public function insertQuestions($data)
{
    return $this->insertBatch($data); // insertBatch sudah cukup jika format data benar
}


    // Fungsi untuk mengambil soal berdasarkan kuis_id
    public function getQuestionsByQuizId($kuis_id)
    {
        return $this->where('kuis_id', $kuis_id)->findAll();
    }

    // Fungsi untuk mengambil soal berdasarkan ID
public function fetchQuestionById($id)
{
    return $this->find($id);
}


// Fungsi untuk menghapus soal berdasarkan ID
public function removeQuestionById($id)
{
    return $this->delete($id);
}

}
