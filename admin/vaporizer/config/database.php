<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
if($_SERVER['SERVER_NAME']=='localhost'){
    $db['default']['username'] = 'root';
    $db['default']['password'] = 'root';
    $db['default']['database'] = 'imedmx_vaporizer';
}else{
    $db['default']['username'] = 'imedmx_vpzr';
    $db['default']['password'] = '[ZT*#kSqv-3V';
    $db['default']['database'] = 'imedmx_vaporizer';
}

$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

//CONFIGURACIÓN WEB
$db['web']['hostname'] = 'localhost';
if($_SERVER['SERVER_NAME']=='localhost'){
    $db['web']['username'] = 'root';
$db['web']['password'] = 'root';
$db['web']['database'] = 'imedmx_main';
}else{
    $db['web']['username'] = 'imedmx_main';
    $db['web']['password'] = '3xsIlb,Br)VH';
    $db['web']['database'] = 'imedmx_main';
}
$db['web']['dbdriver'] = 'mysql';
$db['web']['dbprefix'] = '';
$db['web']['pconnect'] = TRUE;
$db['web']['db_debug'] = TRUE;
$db['web']['cache_on'] = FALSE;
$db['web']['cachedir'] = '';
$db['web']['char_set'] = 'utf8';
$db['web']['dbcollat'] = 'utf8_general_ci';
$db['web']['swap_pre'] = '';
$db['web']['autoinit'] = TRUE;
$db['web']['stricton'] = FALSE;
/* End of file database.php */
/* Location: ./application/config/database.php */