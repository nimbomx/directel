<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
if($_SERVER['SERVER_NAME']=='localhost'){
    $db['default']['username'] = 'root';
    $db['default']['password'] = 'root';
    $db['default']['database'] = 'directel_2012';
}else{
    $db['default']['username'] = 'directel_man';
    $db['default']['password'] = '2+i~,%0^4dE#';
    $db['default']['database'] = 'directel_2012';
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


/* End of file database.php */
/* Location: ./application/config/database.php */