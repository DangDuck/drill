<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::auth');

// route pekerjaan
$routes->get('/pekerjaan', 'Pekerjaan::index');
$routes->get('/pekerjaan/tambah_pekerjaan', 'Pekerjaan::tambah_pekerjaan');
$routes->post('/pekerjaan/tambah_pekerjaan', 'Pekerjaan::action_tambah_pekerjaan');
$routes->get('/pekerjaan/ubah_pekerjaan/(:num)', 'Pekerjaan::ubah_pekerjaan/$1');
$routes->post('/pekerjaan/ubah_pekerjaan/(:num)', 'Pekerjaan::action_ubah_pekerjaan/$1');
$routes->get('/pekerjaan/hapus_pekerjaan/(:num)', 'Pekerjaan::action_hapus_pekerjaan/$1');

// route kategori pekerjaan
$routes->get('/kategori_pekerjaan', 'KategoriPekerjaan::index');
$routes->get('/kategori_pekerjaan/tambah_kategori_pekerjaan', 'KategoriPekerjaan::tambah_kategori_pekerjaan');
$routes->post('/kategori_pekerjaan/tambah_kategori_pekerjaan', 'KategoriPekerjaan::action_tambah_kategori_pekerjaan');
$routes->get('/kategori_pekerjaan/ubah_kategori_pekerjaan/(:num)', 'KategoriPekerjaan::ubah_kategori_pekerjaan/$1');
$routes->post('/kategori_pekerjaan/ubah_kategori_pekerjaan/(:num)', 'KategoriPekerjaan::action_ubah_kategori_pekerjaan/$1');
$routes->get('/kategori_pekerjaan/hapus_kategori_pekerjaan/(:num)', 'KategoriPekerjaan::action_hapus_kategori_pekerjaan/$1');

// route mesin
$routes->get('/mesin', 'Mesin::index');
$routes->get('/mesin/tambah_mesin', 'Mesin::tambah_mesin');
$routes->post('/mesin/tambah_mesin', 'Mesin::action_tambah_mesin');
$routes->get('/mesin/ubah_mesin/(:num)', 'Mesin::ubah_mesin/$1');
$routes->post('/mesin/ubah_mesin/(:num)', 'Mesin::action_ubah_mesin/$1');
$routes->get('/mesin/hapus_mesin/(:num)', 'Mesin::action_hapus_mesin/$1');

// route kategori mesin
$routes->get('/kategori_mesin', 'KategoriMesin::index');
$routes->get('/kategori_mesin/tambah_kategori_mesin', 'KategoriMesin::tambah_kategori_mesin');
$routes->post('/kategori_mesin/tambah_kategori_mesin', 'KategoriMesin::action_tambah_kategori_mesin');
$routes->get('/kategori_mesin/ubah_kategori_mesin/(:num)', 'KategoriMesin::ubah_kategori_mesin/$1');
$routes->post('/kategori_mesin/ubah_kategori_mesin/(:num)', 'KategoriMesin::action_ubah_kategori_mesin/$1');
$routes->get('/kategori_mesin/hapus_kategori_mesin/(:num)', 'KategoriMesin::action_hapus_kategori_mesin/$1');

// route proses pekerjaan
$routes->get('/proses_pekerjaan', 'ProsesPekerjaan::index');
$routes->get('/proses_pekerjaan/tambah_proses_pekerjaan', 'ProsesPekerjaan::tambah_proses_pekerjaan');
$routes->post('/proses_pekerjaan/tambah_proses_pekerjaan', 'ProsesPekerjaan::action_tambah_proses_pekerjaan');
$routes->get('/proses_pekerjaan/ubah_proses_pekerjaan/(:num)', 'ProsesPekerjaan::ubah_proses_pekerjaan/$1');
$routes->post('/proses_pekerjaan/ubah_proses_pekerjaan/(:num)', 'ProsesPekerjaan::action_ubah_proses_pekerjaan/$1');
$routes->get('/proses_pekerjaan/hapus_proses_pekerjaan/(:num)', 'ProsesPekerjaan::action_hapus_proses_pekerjaan/$1');

// route generate jadwal
$routes->get('/generate', 'AlgoritmaController::index');
$routes->post('/generate', 'AlgoritmaController::generate');

$routes->get('/preview_proses', 'AlgoritmaController::preview');

$routes->get('/peta_mesin', 'AlgoritmaController::peta_mesin');

$routes->get('/pekerjaan_line/(:num)', 'AlgoritmaController::update_line/$1');
$routes->post('/pekerjaan_line/(:num)', 'AlgoritmaController::action_update_line/$1');

$routes->get('/generate_line', 'AlgoritmaController::generate_line');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
