<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// dashboard
$routes->get('/', 'Dashboard::index');
$routes->get('dashboard', 'Dashboard::index');

// data-anggota
$routes->get('/anggota', 'Anggota::index');         
$routes->post('/anggota/store', 'Anggota::store');
$routes->post('/anggota/update/(:num)', 'Anggota::update/$1'); 
$routes->post('anggota/update', 'Anggota::update');     
$routes->get('/anggota/delete/(:num)', 'Anggota::delete/$1');  

// data-iuran
$routes->get('iuran', 'Iuran::index');
$routes->post('iuran', 'Iuran::store');
$routes->get('iuran/searchAnggota', 'Iuran::searchAnggota');

// bayar-angsuran
$routes->get('/b_angsuran', 'B_angsuran::index');

// data-angsuran
$routes->get('d_angsuran', 'd_angsuran::index');
$routes->post('d_angsuran/store', 'd_angsuran::store');
$routes->post('d_angsuran/store_cicilan', 'd_angsuran::store_cicilan');
$routes->get('d_angsuran/delete/(:num)', 'd_angsuran::delete/$1');
$routes->get('d_angsuran/lunasi/(:num)', 'd_angsuran::lunasi/$1');
$routes->get('d_angsuran/get_cicilan/(:num)', 'd_angsuran::get_cicilan/$1');

//data usaha
$routes->get('usaha', 'Usaha::index');
$routes->post('usaha/store', 'Usaha::store');
$routes->post('usaha/update/(:num)', 'Usaha::update/$1');
$routes->get('usaha/delete/(:num)', 'Usaha::delete/$1');

// input usaha
$routes->get('input_kop', 'input_kop::index');       
$routes->post('input_kop/store', 'input_kop::store'); 
$routes->get('input_kop/edit/(:num)', 'Input_kop::edit/$1');
$routes->post('input_kop/update', 'Input_kop::update');
$routes->get('input_kop/delete/(:num)', 'input_kop::delete/$1'); 

// login
$routes->get('auth', 'Auth::index');
$routes->post('auth/login_action', 'Auth::login_action');
$routes->get('logout', 'Auth::logout');
$routes->get('auth/logout', 'Auth::logout');

//regish
$routes->get('tambah_anggota', 'Auth::register'); 
$routes->post('auth/register_action', 'Auth::register_action');
$routes->get('register', 'Auth::register');
$routes->post('auth/register_action', 'Auth::register_action');
$routes->get('ganti_password', 'Auth::change_password');
$routes->post('auth/update_password', 'Auth::update_password');
$routes->get('auth/change_password', 'Auth::change_password');
$routes->post('auth/update_password', 'Auth::update_password');

// ganti reset Password
$routes->get('member', 'Member::index');
$routes->post('member/store', 'Member::store');
$routes->post('member/update', 'Member::update');
$routes->get('member/delete/(:any)', 'Member::delete/$1');
$routes->get('member/reset_password/(:any)', 'Member::reset_password/$1');
$routes->get('users', 'Member::index');

//Profil
$routes->get('profile', 'Profile::index');
$routes->post('profile/update', 'Profile::update');