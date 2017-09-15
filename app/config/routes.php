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
$route['settings/delete/(:any)'] = 'member/deleteaccount/$1';
$route['admin/update/(:any)'] = 'admin/admin/updateadmin/$1';
$route['admin/users/members/delete'] = 'admin/admin/delete';
$route['admin/posts/approvepost/(:any)'] = 'admin/admin/approvepost/$1';
$route['admin/posts/published'] = 'admin/admin/publishedposts';
$route['admin/posts/approvals'] = 'admin/admin/postapprovals';
$route['addmember'] = 'member/addmember';
$route['recover/(:any)'] = 'member/recover/$1';
$route['recover'] = 'member/recover';
$route['admin/users/members'] = 'admin/admin/dashboardmembers';
$route['admin'] = 'admin/admin';
$route['admin/logout'] = 'admin/admin/logout';
$route['admin/login'] = 'admin/admin/login';
$route['category/(:any)'] = 'home/categories/$1';
$route['settings/(:any)/(:any)'] = 'member/settings/$1/$2';
$route['member/u/(:any)'] = 'member/changepiccov/$1';
$route['member/(:any)'] = 'member/viewmember/$1';
$route['photo/(:any)'] = 'photo/viewphoto/$1';
$route['default_controller'] = 'home';
$route[''] = 'home';
$route['categories'] = 'home/categories';
$route['about'] = 'home/about';
$route['grid'] = 'home/grid';
$route['grid'] = 'home/grid';
$route['members'] = 'member/viewallmembers';
$route['upload'] = 'photo/upload';
$route['settings'] = 'member/settings';
$route['login'] = 'member/login';
$route['create'] = 'member/signup';
$route['logout/(:any)'] = 'member/logout/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
