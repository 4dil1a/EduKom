<?php

namespace App\Controllers;

use App\Models\MateriModel;

class Dashboard extends BaseController
{
    protected $materiModel;

    public function __construct()
    {
        // Inisialisasi MateriModel
        $this->materiModel = new MateriModel();
    }

    public function index() { 
        $data['materis'] = $this->materiModel
            ->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->paginate(9);
        $data['pager'] = $this->materiModel->pager; 
        return view('user/dashboard', $data); 
    }

}