<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['ref_logout'] = 'Login/logout';

$route['userlogin'] = 'Login/register';
$route['fehlzeiten_view'] = 'Mitarbeiter/formular_con';
$route['act_add_fehlzeit'] = 'Mitarbeiter/fun_add_fehlzeit';

$route['admin_aktuel_fehlzeiten'] = 'Admin/all_fehlzeiten';
$route['all_mitarbeiter_ref'] = 'Admin/all_mitarbeiter';
$route['add_mitarbeiter_ref'] = 'Admin/add_mitarbeiter';

$route['act_add_mitarbeiter'] = 'Admin/con_add_mitarbeiter';
$route['act_update_mitarbeiter'] = 'Admin/update_mit_in_DB';
$route['update_mitarbeiter/(:any)'] = 'Admin/update_mit/$1';

$route['deleteMitarbeiter/(:any)'] = 'Admin/delete_mitarbeiter/$1';
$route['ref_update_admin_pass'] = 'Admin/update_admin_pass';
$route['act_update_admin_pass'] = 'Admin/update_admin_pass_in_DB';