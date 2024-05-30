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
$route['default_controller'] = 'AuthController/index';
$route['logout'] = 'AuthController/logout';
$route['logout'] = 'AuthController/logout';
$route['proses_login'] = 'AuthController/login';
$route['proses_login'] = 'AuthController/login';
$route['admin'] = 'AdminController/index';
$route['register'] = 'AuthController/register';
$route['default_controller'] = 'AuthController/index';
$route['kriteria'] = 'CriteriaController/index';
$route['kriteria/table'] = 'CriteriaController/table';
$route['kriteria/store'] = 'CriteriaController/store';
$route['kriteria/update'] = 'CriteriaController/update';
$route['kriteria/delete'] = 'CriteriaController/delete';
$route['kriteria/edit/(:any)'] = 'CriteriaController/edit/$1';
$route['subkriteria'] = 'SubcriteriaController/index';
$route['subkriteria/table'] = 'SubcriteriaController/table';
$route['subkriteria/store'] = 'SubcriteriaController/store';
$route['subkriteria/update'] = 'SubcriteriaController/update';
$route['subkriteria/delete'] = 'SubcriteriaController/delete';
$route['subkriteria/edit/(:any)'] = 'SubcriteriaController/edit/$1';
$route['bike'] = 'BikeController/index';
$route['bike/getall'] = 'BikeController/get_all';
$route['bike/table'] = 'BikeController/table';
$route['bike/store'] = 'BikeController/store';
$route['bike/update'] = 'BikeController/update';
$route['bike/delete'] = 'BikeController/delete';
$route['bike/edit/(:any)'] = 'BikeController/edit/$1';
$route['alternatif'] = 'AlternativeController/index';
$route['alternatif/table'] = 'AlternativeController/table';
$route['alternatif/store'] = 'AlternativeController/store';
$route['alternatif/update'] = 'AlternativeController/update';
$route['alternatif/delete'] = 'AlternativeController/delete';
$route['alternatif/edit/(:any)'] = 'AlternativeController/edit/$1';
$route['matrix'] = 'MatrixController/index';
$route['preference'] = 'MatrixController/preference';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
