<?php

namespace App\Controllers;

use App\Models\SeminarModel;

class AdminSeminar extends BaseController
{
    public function index()
    {
        $seminarModel = new SeminarModel();
        // Ambil semua seminar termasuk tanggal
        $data['seminars'] = $seminarModel->getSeminars();
        return view('admin/seminar', $data);
    }

    public function tambahSeminar()
    {
        return view('admin/tambah_seminar');
    }

    public function simpanSeminar()
{
    $validation = \Config\Services::validation();
    $file = $this->request->getFile('poster');

     // Inisialisasi variabel path
     $posterPath = null;
     if ($this->request->getFile('poster')->isValid()) {
         $poster = $this->request->getFile('poster');
         $namaPoster = $poster->getRandomName();
         $posterPath = 'uploads/gambar/' . $namaPoster;
         $poster->move(FCPATH . 'uploads/gambar', $namaPoster);
     }

    // Simpan data seminar ke database, termasuk path file poster
    $seminarModel = new SeminarModel();
    $seminarModel->save([
        'judul' => $this->request->getPost('judul'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'penyelenggara' => $this->request->getPost('penyelenggara'),
        'bentuk_acara' => $this->request->getPost('bentuk_acara'),
        'tanggal' => $this->request->getPost('tanggal'),
        'jam' => $this->request->getPost('jam'),
        'status' => $this->request->getPost('status'),
        'poster' => $posterPath, // Menyimpan path file poster
    ]);

    return redirect()->to('/admin/seminar')->with('success', 'Seminar berhasil disimpan.');
}



public function editSeminar($seminar_id)
{
    // Ambil data seminar berdasarkan ID
    $seminarModel = new SeminarModel();
    $seminar = $seminarModel->find($seminar_id);
    
    // Jika seminar tidak ditemukan, arahkan ke halaman seminar
    if (!$seminar) {
        return redirect()->to('/admin/seminar')->with('error', 'Seminar tidak ditemukan');
    }

    // Kirim data seminar ke view
    return view('admin/edit_seminar', ['seminar' => $seminar]);
}


public function updateSeminar($seminar_id)
{
    // Validasi input
    if (!$this->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'penyelenggara' => 'required',
        'bentuk_acara' => 'required',
        'tanggal' => 'required',
        'jam' => 'required', // Validasi untuk jam
        'status' => 'required',
    ])) {
        return redirect()->to('/admin/editSeminar/' . $seminar_id)->withInput();
    }

    // Ambil data seminar yang akan diupdate
    $seminarModel = new SeminarModel();
    $seminar = $seminarModel->find($seminar_id);

    // Perbarui data seminar
    $data = [
        'judul' => $this->request->getPost('judul'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'penyelenggara' => $this->request->getPost('penyelenggara'),
        'bentuk_acara' => $this->request->getPost('bentuk_acara'),
        'tanggal' => $this->request->getPost('tanggal'),
        'jam' => $this->request->getPost('jam'), // Update field jam
        'status' => $this->request->getPost('status'),
    ];

    // Jika ada file poster baru, upload dan perbarui
    if ($this->request->getFile('poster')->isValid()) {
        $file = $this->request->getFile('poster');
        $newName = $file->getRandomName();
        $file->move('uploads/posters', $newName);

        // Tambahkan poster yang baru
        $data['poster'] = 'uploads/posters/' . $newName;
    }

    // Update data seminar di database
    $seminarModel->update($seminar_id, $data);

    // Redirect ke halaman seminar dengan pesan sukses
    return redirect()->to('/admin/seminar')->with('success', 'Seminar berhasil diperbarui!');
}

public function hapusSeminar($seminar_id)
{
    $referrer = $this->request->getGet('from') ?? 'seminar';
    $seminarModel = new \App\Models\SeminarModel();

    // Cek apakah seminar dengan ID yang diberikan ada
    $seminar = $seminarModel->find($seminar_id);
    
    if ($seminar) {
        // Hapus seminar dari database
        $seminarModel->delete($seminar_id);
        
        // Set flash message sukses
        session()->setFlashdata('message', 'Seminar berhasil dihapus.');
    } else {
        // Set flash message error jika seminar tidak ditemukan
        session()->setFlashdata('message', 'Seminar tidak ditemukan.');
    }

    switch ($referrer) {
        case 'dashboard_seminar':
            return redirect()->to('/admin/dashboard_seminar');
        case 'seminar':
            return redirect()->to('/admin/seminar');
        default:
            return redirect()->to('/admin/seminar');
}

    }
    
}
