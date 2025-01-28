<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public $protocol = 'smtp';
    public $SMTPHost = 'smtp.gmail.com'; // Host SMTP Gmail
    public $SMTPUser = 'edukom.kabpekalongan@gmail.com'; // Email Gmail Anda
    public $SMTPPass = 'ubxwoomauoqayqbz'; // Sandi aplikasi Gmail (tanpa spasi)
    public $SMTPPort = 465; // Port SMTP Gmail
    public $SMTPCrypto = 'ssl'; // Enkripsi SSL
    public $mailType = 'html'; // Format email HTML
    public $charset = 'utf-8'; // Charset email
    public $newline = "\r\n"; // Newline untuk header email
    public $CRLF = "\r\n"; // CRLF untuk header email
}