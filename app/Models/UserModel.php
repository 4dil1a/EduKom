<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'nama_lengkap', 'username', 'password', 'role',
        'alamat', 'jenis_kelamin', 'no_hp', 'email', 'fb', 'ig', 
        'google_id', 'created_at', 'updated_at', 'foto_profil', 'otp','otp_expiry','is_verified'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Mengecek apakah username sudah ada di database.
     *
     * @param string $username
     * @return array|null
     */
    public function checkUsernameExists($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Menambah pengguna baru.
     *
     * @param array $data
     * @return bool|int|string
     */
    public function registerUser($data)
    {
        return $this->insert($data);
    }

    /**
     * Login pengguna berdasarkan username dan password.
     *
     * @param string $username
     * @param string $password
     * @return array|null
     */
    // Di UserModel.php
public function login($username, $password)
{
    return $this->where('username', $username)
                ->where('password', $password)
                ->first();
}

    /**
     * Memperbarui password pengguna.
     *
     * @param int $userId
     * @param string $newPassword
     * @return bool
     */
    public function updatePassword($userId, $newPassword)
    {
        return $this->update($userId, ['password' => $newPassword]); // Pastikan password di-hash sebelum menyimpan.
    }

    /**
     * Mendapatkan pengguna berdasarkan Google ID.
     *
     * @param string $googleId
     * @return array|null
     */
    public function getUserByGoogleId($googleId)
    {
        return $this->where('google_id', $googleId)->first();
    }

    /**
     * Menambahkan pengguna baru dengan Google ID.
     *
     * @param array $data
     * @return bool|int|string
     */
    public function addGoogleUser($data)
{
    // Menambahkan google_token ke dalam data pengguna
    return $this->insert($data);
}

// di UserModel
public function getUserData($userId) {
    return $this->find($userId);
}

}
