<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Frontend
$route['default_controller'] = 'welcome';

$route['home']                 = 'frontend/HomePageController/index';
$route['about']                = 'frontend/AboutPageController/index';
$route['report']               = 'frontend/ReportPageController/index';
$route['report/create']        = 'frontend/ReportPageController/create';
$route['report/get_pelanggan/(:num)'] = 'frontend/ReportPageController/get_pelanggan/$1';

$route['report-history']       = 'frontend/ReportHistoryPageController/index';


$route['login']             = 'backend/AuthController/login';
$route['logout']            = 'backend/AuthController/logout';
$route['dash']              = 'backend/HomeController/index';
// Routing Admin
$route['admin']                     = 'backend/AdminController/index';
$route['admin/create']              = 'backend/AdminController/create';
$route['admin/update/(:num)']       = 'backend/AdminController/edit/$1';
// Routing Admin
$route['level']                     = 'backend/LevelController/index';
$route['level/create']              = 'backend/LevelController/create';
$route['level/update/(:num)']       = 'backend/LevelController/edit/$1';

// Routing Pelanggan
$route['pelanggan']                     = 'backend/PelangganController/index';
$route['pelanggan/create']              = 'backend/PelangganController/create';
$route['pelanggan/update/(:num)']       = 'backend/PelangganController/edit/$1';

// Routing Teknisi
$route['teknisi']                     = 'backend/TeknisiController/index';
$route['teknisi/create']              = 'backend/TeknisiController/create';
$route['teknisi/update/(:num)']       = 'backend/TeknisiController/edit/$1';

$route['laporan']                     = 'backend/ReportController/index';
$route['laporan/proses/(:num)']       = 'backend/ReportController/proses/$1';
$route['laporan/reject/(:num)']       = 'backend/ReportController/reject/$1';
$route['laporan/done/(:num)']         = 'backend/ReportController/done/$1';

//$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
