<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Halaman landing sebagai default
$routes->get('/', 'LandingPage::index');

$routes->get('auth/googleLogin', 'Auth::googleLogin');
$routes->get('auth/googleCallback', 'Auth::googleCallback');


// Rute untuk otentikasi
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/loginAction', 'Auth::loginAction');
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/registerAction', 'Auth::registerAction');



// Rute untuk dashboard admin dan user
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('user/dashboard', 'User::dashboard');

// Rute untuk materi (digunakan oleh semua user)
$routes->get('dashboard', 'Dashboard::index');
$routes->get('materi', 'Materi::index');
$routes->get('seminar', 'Seminar::index');
$routes->get('profile/(:num)', 'Profile::profile/$1');
$routes->get('kuis', 'Kuis::index');


// Rute untuk lupa password
$routes->get('/auth/lupapw', 'Auth::lupapw');


$routes->get('/user/editProfile', 'User::editProfile');
$routes->post('/user/updateProfile', 'User::updateProfile');
$routes->get('user/profile', 'Profile::index');
$routes->get('/user/keamanan', 'Keamanan::index');
$routes->get('/user/kuis', 'Kuis::index');
$routes->get('materi/detail/(:num)', 'Materi::detail/$1');

// app/Config/Routes.php
$routes->get('user/profile/(:num)', 'Profile::profile/$1');

$routes->post('user/updateProfile/(:num)', 'User::updateProfile/$1');

$routes->add('user/updateProfile/(:num)?', 'User::updateProfile/$1');


// Rute untuk halaman data pengguna di admin
$routes->get('/admin/data_pengguna', 'Admin::dataPengguna');
$routes->get('/admin/lihatPengguna/(:num)', 'Admin::lihatPengguna/$1');
$routes->get('/admin/hapusPengguna/(:num)', 'Admin::hapusPengguna/$1'); // Untuk menghapus pengguna


$routes->get('seminar/detail/(:num)', 'Seminar::detail/$1');
$routes->get('/admin/seminar', 'AdminSeminar::index');
$routes->get('/admin/tambahSeminar', 'AdminSeminar::tambahSeminar');
$routes->post('/admin/simpanSeminar', 'AdminSeminar::simpanSeminar');
$routes->get('admin/hapusSeminar/(:num)', 'AdminSeminar::hapusSeminar/$1');
$routes->get('admin/editSeminar/(:num)', 'AdminSeminar::editSeminar/$1');
$routes->post('admin/updateSeminar/(:num)', 'AdminSeminar::updateSeminar/$1');


//Rute untuk halaman Materi di Admin
$routes->get('/admin/materi', 'AdminMateri::index');
$routes->get('/admin/tambahMateri', 'AdminMateri::tambahMateri');
$routes->post('/admin/simpanMateri', 'AdminMateri::simpanMateri');

$routes->post('/admin/updateMateri/(:num)', 'AdminMateri::updateMateri/$1');
$routes->get('/admin/hapusMateri/(:num)', 'AdminMateri::hapusMateri/$1');

$routes->get('admin/editMateri/(:num)', 'AdminMateri::editMateri/$1');



//Rute untuk halaman kuis di Admin
$routes->get('admin/tambahKuis/(:num)', 'AdminKuis::tambahKuis/$1'); // untuk mengedit kuis
$routes->get('admin/tambahKuis', 'AdminKuis::tambahKuis'); // untuk menambah kuis

$routes->post('admin/tambahKuis', 'AdminKuis::save');
$routes->get('admin/kuis', 'AdminKuis::index');
$routes->post('admin/kuis/save', 'AdminKuis::save');

$routes->get('admin/hapusKuis/(:num)', 'AdminKuis::delete/$1');
$routes->post('admin/updateKuis/(:num)', 'AdminKuis::updateKuis/$1');

$routes->get('admin/editKuis/(:num)', 'AdminKuis::editKuis/$1');
$routes->get('admin/hapusSoal/(:num)', 'AdminKuis::deleteSoal/$1');

$routes->get('admin/dashboard_seminar', 'Admin::dashboardSeminar');
$routes->get('admin/dashboard_pengguna', 'Admin::dashboardPengguna');
$routes->get('admin/dashboard_kuis', 'Admin::dashboardKuis');


$routes->get('kuis/mulai/(:num)', 'Kuis::mulaiKuis/$1', ['as' => 'mulai_kuis']);
$routes->get('kuis/sesi', 'Kuis::sesiKuis', ['as' => 'sesi_kuis']);
$routes->post('kuis/proses-jawaban', 'Kuis::prosesJawaban', ['as' => 'proses_jawaban']);
$routes->get('kuis/hasil', 'Kuis::hasilKuis', ['as' => 'hasil_kuis']);

$routes->get('kuis/detail/(:num)', 'Kuis::detail/$1', ['as' => 'detail_kuis']);

// In app/Config/Routes.php
$routes->add('kuis/detail/(:num)', 'Kuis::detail/$1');

$routes->add('kuis/submit', 'Kuis::submit', ['method' => 'post']);

$routes->add('kuis/kerjakan_ulang/(:num)', 'Kuis::kerjakan_ulang/$1');


$routes->get('materi/video/(:num)', 'Materi::video/$1');
$routes->get('materi/audio/(:num)', 'Materi::audio/$1');
$routes->get('materi/unduh/(:num)', 'Materi::unduh/$1');



$routes->get('/auth/logout', 'Auth::logout');

$routes->get('materi/video/(:num)', 'Materi::video/$1');

$routes->post('user/updatePhoto', 'User::updatePhoto');
//tambah
$routes->post('user/updatePassword', 'User::updatePassword');
$routes->post('user/deleteProfile', 'User::deleteProfile');
$routes->get('detail_materi/(:num)', 'Materi::detail/$1');
// app/Config/Routes.php

// Rute lainnya
$routes->get('/', 'Dashboard::index');
$routes->get('/', 'Materi::index');
$routes->get('/', 'Kuis::index');
$routes->get('/', 'Seminar::index');


$routes->get('detail_materi/(:segment)', 'Materi::detailMateri/$1');
$routes->get('profile', 'Profile::index');


















