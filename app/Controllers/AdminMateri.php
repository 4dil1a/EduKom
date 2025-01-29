<?php

namespace App\Controllers;

use App\Models\MateriModel;

class AdminMateri extends BaseController
{
    protected $materiModel;

    public function __construct()
    {
        $this->materiModel = new MateriModel();
    }

    public function index()
    {
        $data['materi'] = $this->materiModel->findAll(); // Ambil semua data materi
        return view('admin/materi', $data);
    }

    public function tambahMateri()
    {
        return view('admin/tambah_materi');
    }
    public function simpanMateri()
    {
        // Validasi input
        $validationRules = [
            'judul' => 'required|min_length[3]|max_length[255]',
            'deskripsi' => 'required',
            'penulis' => 'required',
            'status' => 'required|in_list[draft,published]',
            'gambar' => 'if_exist|is_image[gambar]|max_size[gambar,2048]|ext_in[gambar,png,jpg,jpeg]',
            'audio' => 'if_exist|ext_in[audio,mp3]|max_size[audio,5120]',
            'video' => 'if_exist|ext_in[video,mp4]|max_size[video,10240]',
            'unduh_materi' => 'if_exist|ext_in[unduh_materi,pdf]|max_size[unduh_materi,5120]',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->to('/admin/tambahMateri')->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // Inisialisasi variabel path
        $gambarPath = null;
        $audioPath = null;
        $videoPath = null;
        $unduhMateriPath = null;
    
        // Upload dan simpan path gambar
        if ($this->request->getFile('gambar')->isValid()) {
            $gambar = $this->request->getFile('gambar');
            $namaGambar = $gambar->getRandomName();
            $gambarPath = 'uploads/gambar/' . $namaGambar;
            $gambar->move(FCPATH . 'uploads/gambar', $namaGambar);
        }
    
        // Upload dan simpan path audio
        if ($this->request->getFile('audio')->isValid()) {
            $audio = $this->request->getFile('audio');
            $namaAudio = $audio->getRandomName();
            $audioPath = 'uploads/audio/' . $namaAudio;
            $audio->move(FCPATH . 'uploads/audio', $namaAudio);
        }
    
        // Upload dan simpan path video
        if ($this->request->getFile('video')->isValid()) {
            $video = $this->request->getFile('video');
            $namaVideo = $video->getRandomName();
            $videoPath = 'uploads/video/' . $namaVideo;
            $video->move(FCPATH . 'uploads/video', $namaVideo);
        }
    
        // Upload dan simpan path PDF
        if ($this->request->getFile('unduh_materi')->isValid()) {
            $unduhMateri = $this->request->getFile('unduh_materi');
            $namaPDF = $unduhMateri->getRandomName();
            $unduhMateriPath = 'uploads/pdf/' . $namaPDF;
            $unduhMateri->move(FCPATH . 'uploads/pdf', $namaPDF);
        }
    
        // Menyiapkan data yang akan disimpan ke database
        $dataToSave = [
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar' => $gambarPath,
            'audio' => $audioPath,
            'video' => $videoPath,
            'unduh_materi' => $unduhMateriPath,
            'penulis' => $this->request->getPost('penulis'),
            'status' => $this->request->getPost('status'),
        ];
    
        // Simpan ke database
        $saved = $this->materiModel->save($dataToSave);
    
        // Jika gagal simpan, tampilkan error
        if (!$saved) {
            return redirect()->to('/admin/tambahMateri')->with('errors', $this->materiModel->errors());
        }
    
        // Redirect dengan pesan sukses
        return redirect()->to('/admin/materi')
            ->with('success', 'Materi berhasil disimpan sebagai ' . $this->request->getPost('status'));
    }
    

    public function editMateri($id)
    {
        $materi = $this->materiModel->find($id);
    
        if (!$materi) {
            return redirect()->to('/admin/materi')->with('error', 'Materi tidak ditemukan');
        }
    
        return view('admin/edit_materi', ['materi' => $materi]);
    }
    
    public function updateMateri($id)
    {
        $referrer = $this->request->getGet('from') ?? 'materi';

        // Validasi input
        $validationRules = [
            'judul' => 'required|min_length[3]|max_length[255]',
            'deskripsi' => 'required',
            'penulis' => 'required',
            'status' => 'required|in_list[draft,published]',
            'gambar' => 'if_exist|is_image[gambar]|max_size[gambar,2048]|ext_in[gambar,png,jpg,jpeg]',
            'audio' => 'if_exist|ext_in[audio,mp3]|max_size[audio,5120]',
            'video' => 'if_exist|ext_in[video,mp4]|max_size[video,10240]',
            'unduh_materi' => 'if_exist|ext_in[unduh_materi,pdf]|max_size[unduh_materi,5120]',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->to('/admin/edit_materi/' . $id)
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
    
        // Ambil data materi yang akan diupdate
        $materi = $this->materiModel->find($id);
    
        // Data yang akan diupdate
        $data = [
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'penulis' => $this->request->getPost('penulis'),
            'status' => $this->request->getPost('status'),
        ];
    
        // Cek dan update gambar jika ada file baru
        if ($this->request->getFile('gambar')->isValid()) {
            // Hapus gambar lama jika ada
            if ($materi['gambar'] && file_exists(FCPATH . $materi['gambar'])) {
                unlink(FCPATH . $materi['gambar']);
            }
    
            // Upload gambar baru
            $gambar = $this->request->getFile('gambar');
            $namaGambar = $gambar->getRandomName();
            $gambarPath = 'uploads/gambar/' . $namaGambar;
            $gambar->move(FCPATH . 'uploads/gambar', $namaGambar);
            $data['gambar'] = $gambarPath;
        }
    
        // Cek dan update audio jika ada file baru
        if ($this->request->getFile('audio')->isValid()) {
            // Hapus audio lama jika ada
            if ($materi['audio'] && file_exists(FCPATH . $materi['audio'])) {
                unlink(FCPATH . $materi['audio']);
            }
    
            // Upload audio baru
            $audio = $this->request->getFile('audio');
            $namaAudio = $audio->getRandomName();
            $audioPath = 'uploads/audio/' . $namaAudio;
            $audio->move(FCPATH . 'uploads/audio', $namaAudio);
            $data['audio'] = $audioPath;
        }
    
        // Cek dan update video jika ada file baru
        if ($this->request->getFile('video')->isValid()) {
            // Hapus video lama jika ada
            if ($materi['video'] && file_exists(FCPATH . $materi['video'])) {
                unlink(FCPATH . $materi['video']);
            }
    
            // Upload video baru
            $video = $this->request->getFile('video');
            $namaVideo = $video->getRandomName();
            $videoPath = 'uploads/video/' . $namaVideo;
            $video->move(FCPATH . 'uploads/video', $namaVideo);
            $data['video'] = $videoPath;
        }
    
        // Cek dan update file PDF jika ada file baru
        if ($this->request->getFile('unduh_materi')->isValid()) {
            // Hapus file PDF lama jika ada
            if ($materi['unduh_materi'] && file_exists(FCPATH . $materi['unduh_materi'])) {
                unlink(FCPATH . $materi['unduh_materi']);
            }
    
            // Upload file PDF baru
            $unduhMateri = $this->request->getFile('unduh_materi');
            $namaPDF = $unduhMateri->getRandomName();
            $unduhMateriPath = 'uploads/pdf/' . $namaPDF;
            $unduhMateri->move(FCPATH . 'uploads/pdf', $namaPDF);
            $data['unduh_materi'] = $unduhMateriPath;
        }
    
        // Update data ke database
        $this->materiModel->update($id, $data);
        
        // Set flash message
        session()->setFlashdata('success', 'Materi berhasil diperbarui');
        
        // Redirect based on referrer
        if ($referrer === 'dashboard') {
            return redirect()->to('/admin/dashboard')->with('success', 'Materi berhasil diperbarui');
        } else {
            return redirect()->to('/admin/materi')->with('success', 'Materi berhasil diperbarui');
        }
    }
    

    public function hapusMateri($id)
    {
        $referrer = $this->request->getGet('from') ?? 'materi';

        $materi = $this->materiModel->find($id);

        if ($materi) {
            // Hapus file-file terkait jika ada
            if ($materi['gambar'] && file_exists(FCPATH . $materi['gambar'])) {
                unlink(FCPATH . $materi['gambar']);
            }
            if ($materi['audio'] && file_exists(FCPATH . $materi['audio'])) {
                unlink(FCPATH . $materi['audio']);
            }
            if ($materi['video'] && file_exists(FCPATH . $materi['video'])) {
                unlink(FCPATH . $materi['video']);
            }
            if ($materi['unduh_materi'] && file_exists(FCPATH . $materi['unduh_materi'])) {
                unlink(FCPATH . $materi['unduh_materi']);
            }

            // Menghapus materi
            $this->materiModel->delete($id);
            
            // Set flash message
            session()->setFlashdata('success', 'Materi berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Materi tidak ditemukan');
        }

        // Redirect based on referrer
        if ($referrer === 'dashboard') {
            return redirect()->to('/admin/dashboard')->with('success', 'Materi berhasil dihapus');
        } else {
            return redirect()->to('/admin/materi')->with('success', 'Materi berhasil dihapus');
        }
    }

}