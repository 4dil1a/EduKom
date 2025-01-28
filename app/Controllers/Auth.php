<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginAction()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');

        // Verify reCAPTCHA
        $secretKey = getenv('RECAPTCHA_SECRET_KEY');
        $remoteIp = $this->request->getServer('REMOTE_ADDR');
        $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';

        $response = file_get_contents("$verifyUrl?secret=$secretKey&response=$recaptchaResponse&remoteip=$remoteIp");
        $responseKeys = json_decode($response, true);

        if (intval($responseKeys["success"]) !== 1) {
            log_message('error', 'reCAPTCHA failed: ' . json_encode($responseKeys));
            session()->setFlashdata('error', 'Verifikasi reCAPTCHA gagal. Coba lagi.');
            return redirect()->to('/auth/login');
        }

        // Process login
        $userModel = new UserModel();
        $user = $userModel->login($username, $password);

        if ($user) {
            // Retrieve full user data from the database
            $userData = $userModel->find($user['user_id']);

            // Set session with full user data
            session()->set([
                'user_id' => $userData['user_id'],
                'username' => $userData['username'],
                'role' => $userData['role'],
                'nama_lengkap' => $userData['nama_lengkap'],
                'alamat' => $userData['alamat'] ?? '',
                'jenis_kelamin' => $userData['jenis_kelamin'] ?? '',
                'no_hp' => $userData['no_hp'] ?? '',
                'email' => $userData['email'] ?? '',
                'fb' => $userData['fb'] ?? '',
                'ig' => $userData['ig'] ?? '',
                'foto_profil' => $userData['foto_profil'] ?? '',
                'logged_in' => true
            ]);

            // Redirect based on role
            return $userData['role'] === 'admin' 
                ? redirect()->to('/admin/dashboard')
                : redirect()->to('/user/dashboard');
        } else {
            session()->setFlashdata('error', 'Username atau password salah.');
            return redirect()->to('/auth/login');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerAction()
    {
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');

        if ($password !== $confirm_password) {
            session()->setFlashdata('error', 'Password dan konfirmasi password tidak cocok.');
            return redirect()->to('/auth/register');
        }

        $userModel = new UserModel();

        // Check if username already exists
        if ($userModel->checkUsernameExists($username)) {
            session()->setFlashdata('error', 'Username sudah terdaftar.');
            return redirect()->to('/auth/register');
        }

        // Register the user
        $data = [
            'nama_lengkap' => $nama_lengkap,
            'username' => $username,
            'password' => $password,
            'role' => 'user', // Default role is user
        ];

        $userModel->registerUser($data);

        session()->setFlashdata('success', 'Registrasi berhasil, silakan login.');
        return redirect()->to('/auth/login');
    }

    public function googleLogin()
    {
        $client = new \Google\Client();
        $client->setClientId(getenv('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(base_url('auth/googleCallback'));
        $client->addScope('email');
        $client->addScope('profile');

        $authUrl = $client->createAuthUrl();
        return redirect()->to($authUrl);
    }

    public function googleCallback()
    {
        $client = new \Google\Client();
        $client->setClientId(getenv('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(site_url('auth/googleCallback'));

        $token = $client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));

        if (!isset($token['error'])) {
            $client->setAccessToken($token['access_token']);
            $googleService = new \Google\Service\Oauth2($client);
            $googleUser = $googleService->userinfo->get();

            $userModel = new UserModel();
            $user = $userModel->where('email', $googleUser->email)->first();

            if (!$user) {
                // Register new user from Google data
                $data = [
                    'nama_lengkap' => $googleUser->name,
                    'username' => $googleUser->email, // Use email as username
                    'email' => $googleUser->email,
                    'password' => null, // No password for Google login
                    'role' => 'user', // Default role is user
                ];

                $userModel->insert($data);
                $user = $userModel->where('email', $googleUser->email)->first();
            }

            session()->set([
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'nama_lengkap' => $user['nama_lengkap'],
            ]);

            return $user['role'] === 'admin'
                ? redirect()->to('/admin/dashboard')
                : redirect()->to('/user/dashboard');
        }

        session()->setFlashdata('error', 'Login dengan Google gagal.');
        return redirect()->to('/auth/register');
    }

    public function logout()
    {
        // Destroy the session
        session()->destroy();

        // Redirect to login page
        return redirect()->to('/auth/login');
    }
}
