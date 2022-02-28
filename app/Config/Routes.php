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
$routes->get('/', 'Dashboard::index');

$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);   
$routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/create', 'Admin::create', ['filter' => 'role:admin']);
$routes->get('/admin/(:num)', 'Admin::detail/$1', ['filter' => 'role:admin']); 
$routes->get('/admin/delete/(:num)', 'Admin::delete/$1', ['filter' => 'role:admin']  );

#Obat
$routes->get('/obat', 'Obat::index'); 
$routes->get('/obat/(:num)', 'Obat::detail/1');
$routes->get('/obat/create', 'Obat::create'); 
$routes->get('/obat/edit/(:num)', 'Obat::edit/$1'  );
$routes->get('/obat/delete/(:num)', 'Obat::delete/$1'  );
$routes->get("/obat/generate-pdf", "Obat::generatePDF");

#stok
$routes->get('/stok/index', 'Stok::index');
$routes->get('/kadaluarsa/index', 'Kadaluarsa::index'); 
$routes->get('/stok/edit/(:num)', 'Stok::edit/$1');
$routes->get('/kadaluarsa/edit/(:num)', 'Kadaluarsa::edit/$1'); 
$routes->get('/stok/delete/(:num)', 'Stok::delete/$1');
$routes->get('/kadaluarsa/delete/(:num)', 'Kadaluarsa::delete/$1'); 
$routes->get("/stok/generate-pdf", "Stok::generatePDF");
$routes->get('/laporan/index', 'Laporan::index');
$routes->get("/laporan/generate-pdf", "Laporan::generatePDF");
#pesan
#Obat
$routes->get('/prekursor', 'Prekursor::index', ['filter' => 'role:admin']);
$routes->get("/prekursor/generate-pdf", "Prekursor::generatePDF");
$routes->get('/alkes', 'Alkes::index');
$routes->get('/alkes/tambah(:num)', 'Alkes::tambah/$i');

#jenis
$routes->get('/jenis', 'Jenis::index', ['filter' => 'role:admin']);
$routes->get('/jenis/detail/(:num)',  'Jenis::detail/$1', ['filter' => 'role:admin' ]);  
$routes->get('/jenis/create', 'Jenis::create' , ['filter' => 'role:admin']);
$routes->get('/jenis/edit/(:num)', 'Jenis::edit/$1', ['filter' => 'role:admin'] );
$routes->get('/jenis/delete/(:num)', 'Jenis::delete/$1' , ['filter' => 'role:admin']);

#distributor
$routes->get('/distributor', 'Distributor::index', ['filter' => 'role:admin']);
$routes->get('/distributor/detail/(:num)',  'Distributor::detail/$1', ['filter' => 'role:admin' ]);  
$routes->get('/distributor/create', 'Distributor::create' , ['filter' => 'role:admin']);
$routes->get('/distributor/edit/(:num)', 'Distributor::edit/$1', ['filter' => 'role:admin'] );
$routes->get('/distributor/delete/(:num)', 'Distributor::delete/$1' , ['filter' => 'role:admin']);
$routes->get("/distributor/generate-pdf", "Distributor::generatePDF");

#Satuan
$routes->get('/satuan', 'Satuan::index', ['filter' => 'role:admin']);
$routes->get('/satuan/detail/(:num)',  'Satuan::detail/$1', ['filter' => 'role:admin' ]);  
$routes->get('/satuan/create', 'Satuan::create' , ['filter' => 'role:admin']);
$routes->get('/satuan/edit/(:num)', 'Satuan::edit/$1', ['filter' => 'role:admin'] );
$routes->get('/satuan/delete/(:num)', 'Satuan::delete/$1' , ['filter' => 'role:admin']);

#obat masuk
$routes->get('/masuk', 'Masuk::index'  );
$routes->get('/masuk/detail/(:num)',  'Masuk::detail/$1'   );  
$routes->get('/masuk/create', 'Masuk::create' );
$routes->get('/masuk/edit/(:num)', 'Masuk::edit/$1' );
$routes->get('/masuk/delete/(:num)', 'Masuk::delete/$1');
$routes->get("/masuk/generate-pdf", "Masuk::generatePDF");

#obat keluar
$routes->get('/keluar', 'Keluar::index');
$routes->get('/keluar/detail/(:num)',  'Keluar::detail/$1');  
$routes->get('/keluar/create', 'Keluar::create');
$routes->get('/keluar/edit/(:num)', 'Keluar::edit/$1');
$routes->get('/keluar/delete/(:num)', 'Keluar::delete/$1' );
$routes->get("/keluar/generate-pdf", "Keluar::generatePDF");

#transaksi
// $routes->group('admin', function($routes){
// 	$routes->get('news', 'NewsAdmin::index');
// 	$routes->get('news/(:segment)/preview', 'NewsAdmin::preview/$1');
//     $routes->add('news/new', 'NewsAdmin::create');
// 	$routes->add('news/(:segment)/edit', 'NewsAdmin::edit/$1');
// 	$routes->get('news/(:segment)/delete', 'NewsAdmin::delete/$1');
// });


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
