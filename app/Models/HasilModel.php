<?php
namespace App\Models;

use CodeIgniter\Model;

class HasilModel extends Model
{
    protected $table = 'hasil';
    protected $primaryKey = 'hasil_id';
    protected $allowedFields = [
        'kuis_id', 
        'user_id', 
        'score', 
        'created_at'
    ];
    
    protected $useTimestamps = false;
}