<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(true);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Dashboard::index');
$routes->get('dashboard', 'Dashboard::index');

$routes->group('auth', static function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->get('login', 'Auth::login');
    $routes->get('logout', 'Auth::logout');
});

$routes->group('produk', static function ($routes) {
    $routes->get('/', 'Product::index');
    $routes->post('cari_produk', 'Product::search_product');
    $routes->post('pilih_kategori', 'Product::search_product');
    $routes->get('ubah_transaksi/(:any)', 'Product::index/$1');
    $routes->get('list_tabel', 'Product::table_list');
    $routes->post('save_produk', 'Product::save_product');
    $routes->post('stok_produk_baru', 'Product::new_product_stock');
    $routes->post('save_stok_produk', 'Product::save_product_stock');
    $routes->get('hapus_produk/(:any)', 'Product::delete_product/$1');
    $routes->get('detail/(:any)', 'Product::detail/$1');
});

$routes->group('transaksi', static function ($routes) {
    $routes->get('/', 'Transaction::index');
    $routes->post('cari_transaksi', 'Transaction::search_transaction');
    $routes->get('print_histori', 'Transaction::print_history');
    $routes->get('print_transaksi/(:any)', 'Transaction::print_transaction/$1');
    $routes->get('detail/(:any)', 'Transaction::detail/$1');
    $routes->post('bayar_transaksi', 'Transaction::finish_transaction');
    $routes->post('save_transaksi', 'Transaction::save_transaction');
    $routes->post('ubah_status', 'Transaction::change_status');
});

$routes->group('member', static function ($routes) {
    $routes->get('/', 'Member::index');
    $routes->post('cari_member', 'Member::search_member');
    $routes->post('save_member', 'Member::save_member');
    $routes->get('hapus_member/(:any)', 'Member::delete_member/$1');
});

$routes->group('kasir', static function ($routes) {
    $routes->get('/', 'CashierEmployee::index');
    $routes->post('cari_kasir', 'CashierEmployee::search_cashier');
    $routes->get('detail/(:any)', 'CashierEmployee::detail/$1');
    $routes->post('save_kasir', 'CashierEmployee::save_cashier_employee');
    $routes->get('hapus_kasir/(:any)', 'CashierEmployee::delete_cashier_employee/$1');
});

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
