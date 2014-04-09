<?php
function web_url(){
    $CI=& get_instance();
    return $CI->config->item('web_url');
}
function recursos($file){
    return base_url('recursos/'.$file);
}
function blockLoad($block){
    $CI=& get_instance();
    $CI->load->view('block/'.$block);
}
function style_png($file){
    return base_url('res/style/'.$file.'.png');
}
function style_jpg($file){
    return base_url('res/style/'.$file.'.jpg');
}

function img_path($file){
    return base_url('res/img/'.$file);
}
function img_jpg($file){
    return base_url('res/img/'.$file.'.jpg');
}

function upperCase($cadena) { 
            $cadena = strtoupper($cadena); 
            $cadena = str_replace("ñ", "Ñ", $cadena); 
            $cadena = str_replace("á", "Á", $cadena); 
            $cadena = str_replace("é", "É", $cadena); 
            $cadena = str_replace("í", "Í", $cadena); 
            $cadena = str_replace("ó", "Ó", $cadena); 
            $cadena = str_replace("ú", "Ú", $cadena); 
            return ($cadena); 
        } 
?>
