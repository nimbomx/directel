<?php
function style_png($path=null){
    return base_url('res/'.$path.'.png');
}
function style_jpg($path=null){
    return base_url('res/'.$path.'.jpg');
}
function web_url($path=null){
    $CI=& get_instance();
    return base_url($CI->config->item('web_url').$path);
}

function vap_action($action,$table=null){
    echo base_url('acciones/a/'.$action.'/'.$table);
}

function reeld_jpg($path){
    return web_url('res/reeld/'.$path.'.jpg');
}
function reeld_png($path){
    return web_url('res/reeld/'.$path.'.png');
}
function reeld_file($path){
    return web_url('res/reeld/'.$path);
}
function web_name(){
    $CI=& get_instance();
    return $CI->config->item('nombre');
}
function js($file){
    echo '<script src="'.web_url('res/js/'.$file.'.js').'"></script>';
}
function link_out($url){
    echo '<link href="'.$url.'" rel="stylesheet" type="text/css">';
}
function css($path){
    link_out(base_url('css/'.$path));
}
function get_session($variable){
    $CI=& get_instance();
    return $CI->session->userdata($variable);
}
function thumb_reeld($path){
    //v1.0
    return base_url('img/thumb/'.base64_encode($path));
}
?>
