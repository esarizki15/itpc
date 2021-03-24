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

$route['default_controller'] = 'web';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['assets'] = '';
$route['store_register'] = 'web/store_register';
$route['store_login'] = 'web/web_store_login';
$route['store_detail_exporter'] = 'web/store_detail_exporter';
$route['store_product'] = 'web/store_product';


//Handling Language
$route['id'] = 'web/index';
$route['en'] = 'web/index';
$route['sp'] = 'web/index';
$route[':any/web_exporter'] = 'web/web_exporter';
$route[':any/web_news'] = 'web/web_news';
$route[':any/web_news_detail/(:any)'] = 'web/web_news_detail/$1';
$route[':any/web_welcome_login'] = 'web/web_welcome_login';
$route[':any/web_itpc_login'] = 'web/web_itpc_login';
$route[':any/web_itpc_logout'] = 'web/web_itpc_logout';
$route[':any/web_register'] = 'web/web_register';
$route[':any/web_exporter_account'] = 'web/web_exporter_account';
$route[':any/web_update_account'] = 'web/web_add_account';
$route[':any/web_add_category'] = 'web/web_add_category';
$route[':any/web_add_product'] = 'web/web_add_product';
$route[':any/web_add_inquiry'] = 'web/web_add_inquiry';
$route[':any/web_inquiry_list'] = 'web/web_inquiry_list';
$route[':any/web_inquiry_progress'] = 'web/web_inquiry_progress';
$route[':any/web_inquiry_inbox'] = 'web/web_inquiry_inbox';
$route[':any/web_thank_you'] = 'web/web_thank_you';
