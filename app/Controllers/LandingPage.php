<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class LandingPage extends Controller
{
    public function index()
    {
        return view('/auth/landing_page'); 
    }
}