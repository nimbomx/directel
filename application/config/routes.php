<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "main";
$route['404_override'] = '';
$route['acciones/(:any)'] = "acciones/$1";
$route['css/(:any)'] = "css/a/$1";
$route['player/(:any)'] = "player/a/$1";
$route['seccion/(:any)'] = "seccion/a/$1";
$route['area/(:any)'] = "area/a/$1";
$route['articulo/(:any)'] = "articulo/a/$1";
//$route['(:any)'] = "main/a/$1";
/* End of file routes.php */
/* Location: ./application/config/routes.php */