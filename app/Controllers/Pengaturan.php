<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Pengaturan extends Controller
{
    public function index()
    {
        // Load the settings page view
        return view('pengaturan');
    }
}
