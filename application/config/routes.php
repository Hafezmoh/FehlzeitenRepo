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
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin_all_projects'] = 'Admin/all_projects';
$route['admin_project/(:any)'] = 'Admin/project/$1';

$route['admin_ref_add_time'] = 'Admin/admin_add_time';
$route['act_admin_add_time'] = 'Admin/act_admin_add_time';

$route['send_new_abteilung'] = 'Admin/add_abteilung';
$route['send_new_project'] = 'Admin/add_project_data_to_DB';

$route['updateProject/(:any)'] = 'Admin/update_project/$1';

$route['deleteProject/(:any)'] = 'Admin/delete_project/$1';
$route['deleteAbteilung/(:any)'] = 'Admin/delete_abteilung/$1';

$route['ref_deletetime/(:any)'] = 'Admin/delete_time/$1';


$route['ref_update_mit/(:any)'] = 'Admin/update_mit/$1';
$route['updateabteilung/(:any)'] = 'Admin/update_abteilung/$1';

$route['ref_delete_mit/(:any)'] = 'Admin/delete_mit/$1';

$route['ref_update_time'] = 'Admin/update_time_in_DB';
$route['act_update_project'] = 'Admin/update_project_in_DB';
$route['act_update_mitarbeiter'] = 'Admin/update_mit_in_DB';
$route['send_edited_abteilung'] = 'Admin/update_abt_in_DB';




$route['mit_project/(:any)'] = 'Mitarbeiter/mit_project/$1';

$route['updatetime/(:any)'] = 'Admin/update_time/$1';

$route['ref_mit_update_time'] = 'Mitarbeiter/update_time_in_DB';

$route['ref_mit_deletetime/(:any)'] = 'Mitarbeiter/delete_time/$1';
$route['ref_mit_updatetime/(:any)'] = 'Mitarbeiter/update_time/$1';


$route['mit_ref_add_time'] = 'Mitarbeiter/mit_add_time';
$route['act_mit_add_time'] = 'Mitarbeiter/act_mit_add_time';


$route['mit_all_projects'] = 'Mitarbeiter/mit_all_projects';

$route['ref_logout'] = 'Login/logout';

$route['userlogin'] = 'Login/register';



