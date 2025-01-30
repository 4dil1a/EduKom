<?php

namespace App\Controllers;

use App\Models\SeminarModel;

class AdminSeminar extends BaseController
{
    public function index()
    {
        $seminarModel = new SeminarModel();
        $data['seminars'] = $seminarModel->getSeminars();
        // Add flash message to view data
        $data['message'] = session()->getFlashdata('message');
        $data['success'] = session()->getFlashdata('success');
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

        // Simpan data seminar ke database
        $seminarModel = new SeminarModel();
        $seminarModel->save([
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'penyelenggara' => $this->request->getPost('penyelenggara'),
            'bentuk_acara' => $this->request->getPost('bentuk_acara'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
            'status' => $this->request->getPost('status'),
            'poster' => $posterPath,
        ]);

        // Get the referrer page
        $referrer = $this->request->getGet('from') ?? 'seminar';
        
        // Set success message
        session()->setFlashdata('success', 'Seminar berhasil disimpan.');
        
        // Redirect based on referrer
        if ($referrer === 'dashboard_seminar') {
            return redirect()->to('/admin/dashboard_seminar')->with('success', 'Seminar berhasil diperbarui');
        } else {
            return redirect()->to('/admin/seminar')->with('success', 'Seminar berhasil diperbarui');
        }
    }

    public function editSeminar($seminar_id)
    {
        $seminarModel = new SeminarModel();
        $seminar = $seminarModel->find($seminar_id);
        
        if (!$seminar) {
            session()->setFlashdata('error', 'Seminar tidak ditemukan');
            return $this->redirectWithReferrer($this->request->getGet('from'));
        }

        $data = [
            'seminar' => $seminar,
            'from' => $this->request->getGet('from') ?? 'seminar'
        ];

        return view('admin/edit_seminar', $data);
    }

    public function updateSeminar($seminar_id)
{
    // Get the referrer from the URL parameter
    $referrer = $this->request->getGet('from') ?? 'seminar';

    // Validasi input
    if (!$this->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'penyelenggara' => 'required',
        'bentuk_acara' => 'required',
        'tanggal' => 'required',
        'jam' => 'required',
        'status' => 'required',
    ])) {
        return redirect()->to('/admin/editSeminar/' . $seminar_id . '?from=' . $referrer)->withInput();
    }

    $seminarModel = new SeminarModel();
    $seminar = $seminarModel->find($seminar_id);

    if (!$seminar) {
        session()->setFlashdata('error', 'Seminar tidak ditemukan');
        return $this->redirectWithReferrer($referrer);
    }

    $data = [
        'judul' => $this->request->getPost('judul'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'penyelenggara' => $this->request->getPost('penyelenggara'),
        'bentuk_acara' => $this->request->getPost('bentuk_acara'),
        'tanggal' => $this->request->getPost('tanggal'),
        'jam' => $this->request->getPost('jam'),
        'status' => $this->request->getPost('status'),
    ];

    // Handle poster upload
    if ($this->request->getFile('poster')->isValid()) {
        $file = $this->request->getFile('poster');
        $newName = $file->getRandomName();
        $file->move('uploads/posters', $newName);
        $data['poster'] = 'uploads/posters/' . $newName;
    }

    // Update seminar
    $seminarModel->update($seminar_id, $data);
    
    // Set flash message
    session()->setFlashdata('success', 'Seminar berhasil diperbarui');
    
    // Redirect based on referrer
    if ($referrer === 'dashboard_seminar') {
        return redirect()->to('/admin/dashboard_seminar')->with('success', 'Seminar berhasil diperbarui');
    } else {
        return redirect()->to('/admin/seminar')->with('success', 'Seminar berhasil diperbarui');
    }
}
}