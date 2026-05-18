<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
| When you set this option to TRUE, it will replace ALL dashes with
| underscores in the controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// halaman kategori
$route['kategori'] = 'pages/kategori';
$route['default_controller'] = 'welcome';
$route['terpopuler'] = 'pages/terpopuler';
$route['about'] = 'pages/about';
$route['keranjang'] = 'pages/keranjang';
$route['payments/execute_payment'] = 'Payment/execute_payment';
$route['payments/(:any)'] = 'pages/payment/$1';


// halaman untuk login dan register
$route['login'] = 'pages/login';
$route['register'] = 'pages/register';

// untuk admin
$route['dashboard'] = 'PagesAdmin/dashboard';
$route['DaftarUser'] = 'PagesAdmin/DaftarUser';
$route['DaftarTransactions'] = 'PagesAdmin/DaftarTransactions';
$route['DaftarBuku/tambah_buku'] = 'PagesAdmin/TambahBuku';
$route['DaftarUser/tambah_user'] = 'PagesAdmin/TambahUser';
$route['dashboard/(:num)'] = 'PagesAdmin/dashboard/$1';
$route['export_csv'] = 'PagesAdmin/ExportCsv';


// route daftar transactions untuk admin
$route['DaftarTransactions/(:num)'] = 'PagesAdmin/DaftarTransactions/$1';
$route['DaftarTransactions/edit/(:any)'] = 'PagesAdmin/EditTransactions/$1';
$route['DaftarTransactions/update_status/(:any)/(:any)'] = 'PagesAdmin/UpdateStatus/$1/$2';


$route['DaftarUser/(:num)'] = 'UserController/DaftarUser/$1';
$route['DaftarUser/update_user/(:num)'] = 'UserController/UpdateUser/$1';
$route['DaftarUser/edit/(:num)'] = 'UserController/EditUser/$1';
$route['DaftarUser/delete/(:num)'] = 'UserController/Delete/$1';
$route['DaftarUser/admin/StoreUser'] = 'UserController/StoreUser';

$route['DaftarBuku/admin/TambahBuku'] = 'BukuController/TambahBuku';
$route['DaftarBuku/edit/(:num)'] = 'BukuController/EditBuku/$1';
$route['DaftarBuku'] = 'BukuController/DaftarBuku';
$route['DaftarBuku/(:num)'] = 'BukuController/DaftarBuku/$1';
$route['DaftarBuku/update_buku/(:num)'] = 'BukuController/UpdateBuku/$1';
$route['DaftarBuku/delete/(:num)'] = 'BukuController/Delete/$1';



//route transaction 
$route['transaction'] = 'transaction/index';
$route['transaction/(:num)'] = 'transaction/index/$1';
$route['transactions/create'] = 'transaction/create';
$route['transactions/index/(:any)'] = 'transaction/show/$1';

// route Payments

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
