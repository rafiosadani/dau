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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'login';
$route['dashboard'] = 'page';
$route['user'] = 'page/user';
// $route['index'] = 'page/indexUser';
$route['report'] = 'page/report';
$route['report/rekap'] = 'page/cetakRekap';
$route['report/harian'] = 'harian';
$route['report/perolehan-manager'] = 'perolehan_manager';
$route['report/perolehan-manager/cetak'] = 'perolehan_manager/cetak';
$route['report/harian/rekap'] = 'harian/cetakRekap';
$route['report/per-petugas'] = 'per_petugas';
$route['report/per-petugas/rekap'] = 'per_petugas/cetakRekap';
$route['report/prestasi'] = 'prestasi';
$route['report/prestasi/rekap'] = 'prestasi/cetakRekap';
$route['report/gagal-kwitansi'] = 'gagal_kwitansi';
$route['report/gagal-kwitansi/rekap'] = 'gagal_kwitansi/cetakRekap';
$route['report/gagal-kwitansi/validasi'] = 'gagal_kwitansi/validasiGagal';
$route['report/validasi'] = 'validasi';
$route['report/validasi/rekap/(:any)'] = 'validasi/cetakRekap/$1';
$route['report/setoran'] = 'setoran';
$route['report/centang'] = 'centang';
$route['report/centang/rekap'] = 'centang/cetakCentang';
$route['report/kawasan-kurang-target'] = 'kwsn_nol';
$route['report/kawasan-kurang-target/rekap'] = 'kwsn_nol/cetakRekap';
$route['report/kawasan-kurang-target/data'] = 'kwsn_nol/dataKwsn';
$route['report/kawasan-kurang-target/excel'] = 'kwsn_nol/dataExcel';
$route['report/setoran/rekap'] = 'setoran/rekapSetoran';
$route['report/perbulan'] = 'perbulan';
$route['report/perbulan/rekap'] = 'perbulan/cetakRekap';
$route['user/baru'] = 'page/addUser';
$route['user/edit/(:num)'] = 'page/updateUser/$1';
$route['data/donatur'] = 'donatur/donatur';
$route['data/donatur/excel'] = 'donatur/excelDonatur';
$route['data/donasi'] = 'donatur/donasi';
$route['data/donatur/(:num)'] = 'donatur/donatur/$1';
$route['data/koordinator'] = 'donatur/koordinator';
$route['data/koordinator/(:num)'] = 'donatur/koordinator/$1';
$route['data/kawasan'] = 'donatur/kawasan';
$route['data/kawasan/(:num)'] = 'donatur/kawasan/$1';
$route['data/donatur/baru'] = 'donatur/addDonatur';
$route['data/koordinator/baru'] = 'donatur/addKoor';
$route['data/kawasan/baru'] = 'donatur/addKawasan';
$route['batal/setor'] = 'donatur/batalSetor';
$route['setup/prospek'] = 'prospek';
$route['setup/prospek/baru'] = 'prospek/baru';
$route['setup/prospek/edit/(:num)'] = 'prospek/edit/$1';
$route['setup/pekerjaan'] = 'pekerjaan';
$route['setup/pekerjaan/baru'] = 'pekerjaan/baru';
$route['setup/pekerjaan/edit/(:num)'] = 'pekerjaan/edit/$1';
$route['keuangan/program']  = 'program';
$route['keuangan/program/rekap'] = 'program/perProgram';
$route['keuangan/bank'] = 'bank';
$route['keuangan/bank/rekap'] = 'bank/perBank';
$route['keuangan/rinci-slip/bank'] = 'rinci_slip';
$route['keuangan/rinci-slip/bank/rekap'] = 'rinci_slip/perRinciBank';
$route['keuangan/rekap-slip-bank'] = 'slipbank';
$route['keuangan/rekap-slip-bank/rekap'] = 'slipbank/perSlip';
$route['keuangan/rkay'] = 'rkay';
$route['keuangan/rkay/rekap'] = 'rkay/cetakRekap';
$route['front-office/validasi-kasir'] = 'valkasir';
$route['front-office/validasi-kasir/rekap-kasir/(:any)'] = 'valkasir/cetakKasir/$1';
$route['front-office/validasi-kasir/rekap-batal/(:any)'] = 'valkasir/cetakBatal/$1';
$route['front-office/validasi-kasir/rekap-klaim/(:any)'] = 'valkasir/cetakKlaim/$1';
$route['front-office/slip-manual'] = 'slipmanual';
$route['front-office/rekap-sms-inbox'] = 'sms_inbox';
$route['kirim-sms-donatur'] = 'sms_donatur';
$route['draft-sms-donatur'] = 'draft_sms_donatur';
$route['draft-sms-donatur/baru'] = 'draft_sms_donatur/baru';
$route['draft-sms-donatur/edit/(:num)'] = 'draft_sms_donatur/edit/$1';
$route['draft-sms-donatur/update'] = 'draft_sms_donatur/update';
$route['draft-sms-donatur/delete/(:num)'] = 'draft_sms_donatur/delete/$1';
$route['riwayat-pesan'] = 'riwayat_pesan';
// $route['data/donatur/search'] = 'donatur/searchDonatur';
// $route['data/donatur/search/(:num)'] = 'donatur/searchDonatur/$1';
// $route['data/koordinator/search'] = 'donatur/searchKoor';
// $route['data/koordinator/search/(:num)'] = 'donatur/searchKoor/$1';
// $route['data/kawasan/search'] = 'donatur/searchKwsn';
// $route['data/kawasan/search/(:num)'] = 'donatur/searchKwsn/$1';
$route['data/donatur/edit/(:num)'] = 'donatur/editDonatur/$1';
$route['data/koordinator/edit/(:num)'] = 'donatur/editKoor/$1';
$route['data/kawasan/edit/(:num)'] = 'donatur/editKawasan/$1';
$route['404_override'] = '';
$route['importDB/report_tagih'] = 'importdb';
$route['importDB/keu_j'] = 'importdb/keu_j';
$route['translate_uri_dashes'] = FALSE;
