<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['logout'] = 'auth/logout';

/**
 * ==============================================================================================
 * ==============================================================================================
 * =============================== S  U  P  E  R  A  D  M  I  N =================================
 * ==============================================================================================
 * ==============================================================================================
 */

$route['superadmin'] = 'superadmin/index';

$route['superadmin/kirim-paket'] = 'superadmin/kirim_paket';
$route['superadmin/kirim-paket/(:any)'] = 'superadmin/konfirmasi_paket/$1';

$route['superadmin/proses-kirim'] = 'superadmin/prosesKirim_pArmada';
$route['superadmin/proses-kirim/load/(:any)'] = 'superadmin/muatKargo/$1';
$route['superadmin/proses-kirim/load/(:any)/(:any)'] = 'superadmin/muatKargo/$1/$2';
$route['superadmin/proses-kirim/(:num)'] = 'superadmin/prosesKirim_pArmada/$1';

$route['superadmin/harga-bobot'] = 'superadmin/harga_per_kg';
$route['superadmin/harga-bobot/(:num)'] = 'superadmin/harga_per_kg/$1';
$route['superadmin/harga-bobot/hapus/(:any)'] = 'superadmin/hapus_harga_kg/$1';

// $route['superadmin/harga-jarak'] = 'superadmin/harga_per_km';
// $route['superadmin/harga-jarak/(:num)'] = 'superadmin/harga_per_km/$1';
// $route['superadmin/harga-jarak/hapus/(:any)'] = 'superadmin/hapus_harga_km/$1';

$route['superadmin/harga-kategori'] = 'superadmin/kategori_view';
$route['superadmin/harga-kategori/(:num)'] = 'superadmin/kategori_view/$1';
$route['superadmin/harga-kategori/hapus/(:any)'] = 'superadmin/hapus_kategori/$1';

// $route['superadmin/harga-volume'] = 'superadmin/harga_per_volume';
// $route['superadmin/harga-volume/(:num)'] = 'superadmin/harga_per_volume/$1';

$route['superadmin/kelola-armada'] = 'superadmin/kelola_armada_view';
$route['superadmin/kelola-armada/(:num)'] = 'superadmin/kelola_armada_view/$1';
$route['superadmin/kelola-armada/hapus/(:any)'] = 'superadmin/hapus_armada/$1';

$route['superadmin/kelola-armada/detail/(:any)'] = 'superadmin/lacak_armada_view/$1';

$route['superadmin/kontrak-sopir'] = 'superadmin/kontrak_sopir_view';
$route['superadmin/kontrak-sopir/(:num)'] = 'superadmin/kontrak_sopir_view/$1';

$route['superadmin/kontrak-sopir/edit/(:any)'] = 'superadmin/kontrak_sopir_edit_view/$1';
$route['superadmin/kontrak-sopir/daftar/(:any)'] = 'superadmin/kontrak_sopir_detail_view/$1';

$route['superadmin/kelola-tipe-kurir'] = 'superadmin/kelola_tipe_kurir';
$route['superadmin/kelola-tipe-kurir/(:any)'] = 'superadmin/kelola_tipe_kurir/$1';
$route['superadmin/kelola-tipe-kurir/edit'] = 'superadmin/ubah_tipe_kurir';
$route['superadmin/kelola-tipe-kurir/hapus/(:any)'] = 'superadmin/hapus_tipe_kurir/$1';

// $route['superadmin/kelola-rute-kirim'] = 'superadmin/kelola_rute_kirim';

$route['superadmin/kelola-metode-pengiriman'] = 'superadmin/metode_pengiriman';

$route['superadmin/bayar'] = 'superadmin/bayar_view';
$route['superadmin/bayar/cetak/(:any)'] = 'superadmin/cetak_invoice/$1';
$route['superadmin/get_data_pengiriman'] = 'superadmin/get_data_pengiriman';
$route['superadmin/get_detail_pengiriman'] = 'superadmin/get_detail_pengiriman';

$route['superadmin/kelola-metode-bayar'] = 'superadmin/metode_bayar_view';
$route['superadmin/kelola-metode-bayar/hapus/(:any)'] = 'superadmin/hapus_metode_bayar/$1';

$route['superadmin/monthly-report'] = 'superadmin/monthly_report';

$route['superadmin/admin-account-management'] = 'superadmin/admin_account_management';

$route['superadmin/terima-kargo'] = 'superadmin/terima_kargo';
$route['superadmin/kargo-hilang'] = 'superadmin/kargo_hilang';

$route['superadmin/histori-perjalanan/(:any)'] = 'superadmin/history_jalan/$1';

$route['superadmin/hapus_admin/(:any)'] = 'superadmin/hapus_admin/$1';

/**
 * ==============================================================================================
 * ==============================================================================================
 * ================================== C  U  S  T  O  M  E  R ====================================
 * ==============================================================================================
 * ==============================================================================================
 */

$route['customer/registration'] = 'customer/self_registration';
$route['customer/reg-by-admin'] = 'customer/registration_by_admin';

$route['customer/lacak-pengiriman'] = 'customer/history_pengiriman';
$route['customer/lacak-pengiriman/(:num)'] = 'customer/history_pengiriman/$1';
$route['customer/lacak-pengiriman-detail/(:any)'] = 'customer/lacak_barang/$1';

$route['customer/daftar-tagihan'] = 'customer/list_tagihan';
$route['customer/daftar-tagihan/(:num)'] = 'customer/list_tagihan/$1';

$route['customer/pricelist'] = 'customer/pricelist_login';

$route['pricelist'] = 'customer/pricelist';

$route['customer/download-invoice/(:any)'] = 'Customer/download_invoice/$1';

/**
 * ==============================================================================================
 * ==============================================================================================
 * ================================ R  E  P  O  R  T ============================================
 * ==============================================================================================
 * ==============================================================================================
 */

$route['report/export-pdf/(:num)'] = 'Report/export_pdf/$1';

/**
 * ==============================================================================================
 * ==============================================================================================
 * =============================== A  C  T  I  V  A  T  I  O  N =================================
 * ==============================================================================================
 * ==============================================================================================
 */

$route['auth/verify/(:any)/(:any)'] = 'auth/verification/$1/$2';

/**
 * ==============================================================================================
 * ==============================================================================================
 * ============================ I N T E R N E T = O F = T H I N G S =============================
 * ==============================================================================================
 * ==============================================================================================
 */

$route['iot/update/(:any)'] = 'Iot/update_loc/$1';
$route['iot/update/(:any)/(:any)/(:any)'] = 'Iot/update_loc/$1/$2/$3';
