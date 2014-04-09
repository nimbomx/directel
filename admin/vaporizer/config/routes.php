<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "inicio";
$route['404_override'] = '';

$route['reestablecer_contrasena/(:any)/(:any)'] = "inicio/reestablecer_contrasena/$1/$2";
$route['configuracion/(:any)'] = "configuracion/f/$1";
$route['desarrollo/(:any)'] = "desarrollo/f/$1";
$route['contenido/(:any)'] = "contenido/f/$1";
$route['upload/(:any)'] = "upload/$1";
$route['css/(:any)'] = "css/a/$1";
$route['acciones/(:any)'] = "acciones/$1";
$route['img/(:any)'] = "img/$1";
$route['(:any)'] = "inicio/a/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */