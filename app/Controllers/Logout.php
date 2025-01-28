<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Logout extends Controller
{
    public function index()
    {
        // Load session service
        session()->destroy();

        // Redirect to login page
        return redirect()->to('login');
    }
}
