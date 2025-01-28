<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\MateriModel;

class User extends BaseController
{
    protected $materiModel;

    public function __construct()
    {
        $this->materiModel = new MateriModel();
    }

  


   
    public function dashboard()
{
    // Cek apakah user sudah login dan memiliki role user
    if (session()->get('role') != 'user') {
        return redirect()->to('/auth/login');
    }

    // Ambil data materi dari database
    $materiModel = new \App\Models\MateriModel();
    $data['materis'] = $materiModel
        ->where('status', 'published')
        ->orderBy('created_at', 'DESC')
        ->findAll(); // Atau paginate jika diperlukan

    // Kirim data ke view
    return view('user/dashboard', $data);
}


    public function editProfile()
    {
        // Cek apakah user sudah login
        if (!session()->get('user_id')) {
            return redirect()->to('/auth/login');
        }

        return view('user/edit_profile');
    }

    public function updateProfile($userId = null)
{
    $userId = $userId ?? session()->get('user_id');
    
    if (!$userId) {
        return redirect()->to('/auth/login');
    }
    
    $userModel = new UserModel();
    
    // Ambil data dari form
    $data = [
        'nama_lengkap'   => $this->request->getPost('nama_lengkap'),
        'alamat'         => $this->request->getPost('alamat'),
        'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
        'no_hp'          => $this->request->getPost('no_hp'),
        'email'          => $this->request->getPost('email'),
        'fb'             => $this->request->getPost('fb'),
        'ig'             => $this->request->getPost('ig'),
    ];
        
        // Periksa apakah ada file foto profil yang diunggah
        $fotoProfil = $this->request->getFile('foto_profile');
        if ($fotoProfil && $fotoProfil->isValid() && !$fotoProfil->hasMoved()) {
            // Validasi file gambar
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (in_array($fotoProfil->getMimeType(), $allowedTypes)) {
                // Tentukan direktori upload
                $uploadPath = FCPATH . 'uploads/gambar'; 
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true); // Membuat folder jika belum ada
                }
    
                // Buat nama file unik
                $fileName = $userId . '_' . time() . '_' . $fotoProfil->getRandomName();
                
                // Pindahkan file ke direktori uploads/gambar
                $fotoProfil->move($uploadPath, $fileName);
        
                // Hapus foto lama jika ada
                $oldPhoto = $userModel->find($userId)['foto_profil'];
                if ($oldPhoto && file_exists($uploadPath . '/' . $oldPhoto)) {
                    unlink($uploadPath . '/' . $oldPhoto);
                }
        
                // Tambahkan nama file ke data untuk update database
                $data['foto_profil'] = $fileName;
        
                // Update foto profil di session
                session()->set('foto_profil', $fileName);
            } else {
                session()->setFlashdata('error', 'File yang diunggah harus berupa gambar (JPEG, PNG, JPG).');
                return redirect()->back()->withInput();
            }
        }
        
        // Update data pengguna di database
        if ($userModel->update($userId, $data)) {
            // Ambil data fresh dari database
            $updatedUser = $userModel->getUserData($userId);
            
            // Update session hanya jika user_id session sama dengan userId yang diupdate
            if (session()->get('user_id') == $userId) {
                session()->set([
                    'nama_lengkap' => $updatedUser['nama_lengkap'],
                    'alamat' => $updatedUser['alamat'],
                    'jenis_kelamin' => $updatedUser['jenis_kelamin'],
                    'no_hp' => $updatedUser['no_hp'],
                    'email' => $updatedUser['email'],
                    'fb' => $updatedUser['fb'],
                    'ig' => $updatedUser['ig']
                ]);
            }
            
            session()->setFlashdata('success', 'Profil berhasil diperbarui.');
    } else {
        session()->setFlashdata('error', 'Gagal memperbarui profil. Silakan coba lagi.');
    }
    
    return redirect()->to('/user/profile/' . $userId);
}



   

    public function updatePassword()
    {
        $session = session();
        $userId = $session->get('user_id'); // Pastikan user_id ada dalam session setelah login

        // Validasi form input
        $rules = [
            'old_password' => 'required|min_length[6]',
            'new_password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]'
        ];

        if ($this->validate($rules)) {
            $oldPassword = $this->request->getPost('old_password');
            $newPassword = $this->request->getPost('new_password');
            $confirmPassword = $this->request->getPost('confirm_password');

            // Cek apakah password lama benar
            $userModel = new UserModel();
            $user = $userModel->find($userId);

            // Jika password lama sesuai dengan yang ada di database
            if ($user['password'] === $oldPassword) {
                // Update password tanpa hashing
                $userModel->updatePassword($userId, $newPassword);

                // Set flashdata untuk success message
                $session->setFlashdata('success', 'Password berhasil diperbarui!');
                return redirect()->to('/user/keamanan');
            } else {
                // Password lama salah
                $session->setFlashdata('error', 'Password lama salah!');
                return redirect()->to('/user/keamanan');
            }
        } else {
            // Jika validasi gagal, tampilkan pesan error
            $session->setFlashdata('error', 'Periksa kembali data yang Anda masukkan!');
            return redirect()->to('/user/keamanan');
        }
    }
    public function updatePhoto()
    {
        $userModel = new UserModel();
        
        // Validate file upload
        if (!$this->validate([
            'foto_profile' => [
                'uploaded[foto_profile]',
                'mime_in[foto_profile,image/jpg,image/jpeg,image/png]',
                'max_size[foto_profile,2048]' // 2MB max
            ]
        ])) {
            return redirect()->back()->with('error', 'Please upload a valid image file (JPG, JPEG, PNG) under 2MB.');
        }
    
        $foto = $this->request->getFile('foto_profile');
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Create upload directory if it doesn't exist
            $uploadPath = FCPATH . 'uploads/gambar';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
    
            // Generate unique filename
            $userId = session()->get('user_id');
            $newName = $userId . '_' . time() . '_' . $foto->getRandomName();
    
            // Move file to uploads directory
            $foto->move($uploadPath, $newName);
    
            // Delete old photo if exists
            $oldPhoto = session('foto_profil');
            if ($oldPhoto && file_exists($uploadPath . '/' . $oldPhoto)) {
                unlink($uploadPath . '/' . $oldPhoto);
            }
    
            // Update database and session
            $userModel->update($userId, ['foto_profil' => $newName]);
            session()->set('foto_profil', $newName);
    
            return redirect()->to('/user/editProfile')->with('success', 'Profile photo updated successfully.');
        }
    
        return redirect()->back()->with('error', 'Failed to upload photo. Please try again.');
    }

}
