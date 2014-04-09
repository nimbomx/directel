<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Img extends CI_Controller {

//v1.0
        public function maxh($max, $dir, $url) {
        $sImagePath = FCPATH . '../res/' . $dir . '/' . ($url);
        //$iThumbnailWidth = $max;
        //$iThumbnailHeight = $max;
        $iMaxWidth = $max*2;
        $iMaxHeight = $max;

        if ($iMaxWidth && $iMaxHeight)
            $sType = 'scale';
        else if ($iThumbnailWidth && $iThumbnailHeight)
            $sType = 'exact';

        $img = NULL;

        $sExtension = strtolower(end(explode('.', $sImagePath)));
        if ($sExtension == 'jpg' || $sExtension == 'jpeg') {

            $img = @imagecreatefromjpeg($sImagePath) or die("Cannot create new JPEG image");
        } else if ($sExtension == 'png') {

            $img = @imagecreatefrompng($sImagePath) or die("Cannot create new PNG image");
        } else if ($sExtension == 'gif') {

            $img = @imagecreatefromgif($sImagePath) or die("Cannot create new GIF image");
        }
        if ($img) {

            $iOrigWidth = imagesx($img);
            $iOrigHeight = imagesy($img);

            if ($sType == 'scale') {

                // Get scale ratio

                $fScale = min($iMaxWidth / $iOrigWidth, $iMaxHeight / $iOrigHeight);

                if ($fScale < 1) {

                    $iNewWidth = floor($fScale * $iOrigWidth);
                    $iNewHeight = floor($fScale * $iOrigHeight);

                    $tmpimg = imagecreatetruecolor($iNewWidth, $iNewHeight);

                    imagecopyresampled($tmpimg, $img, 0, 0, 0, 0, $iNewWidth, $iNewHeight, $iOrigWidth, $iOrigHeight);

                    imagedestroy($img);
                    $img = $tmpimg;
                }
            } else if ($sType == "exact") {

                $fScale = max($iThumbnailWidth / $iOrigWidth, $iThumbnailHeight / $iOrigHeight);

                if ($fScale < 1) {

                    $iNewWidth = floor($fScale * $iOrigWidth);
                    $iNewHeight = floor($fScale * $iOrigHeight);

                    $tmpimg = imagecreatetruecolor($iNewWidth, $iNewHeight);
                    $tmp2img = imagecreatetruecolor($iThumbnailWidth, $iThumbnailHeight);

                    imagecopyresampled($tmpimg, $img, 0, 0, 0, 0, $iNewWidth, $iNewHeight, $iOrigWidth, $iOrigHeight);

                    if ($iNewWidth == $iThumbnailWidth) {

                        $yAxis = ($iNewHeight / 2) -
                                ($iThumbnailHeight / 2);
                        $xAxis = 0;
                    } else if ($iNewHeight == $iThumbnailHeight) {

                        $yAxis = 0;
                        $xAxis = ($iNewWidth / 2) -
                                ($iThumbnailWidth / 2);
                    }

                    imagecopyresampled($tmp2img, $tmpimg, 0, 0, $xAxis, $yAxis, $iThumbnailWidth, $iThumbnailHeight, $iThumbnailWidth, $iThumbnailHeight);

                    imagedestroy($img);
                    imagedestroy($tmpimg);
                    $img = $tmp2img;
                }
            }

            header("Content-type: image/jpeg");
            imagejpeg($img,NULL,100);
        }
    }
    public function max($max, $dir, $url) {
        $sImagePath = FCPATH . '../res/' . $dir . '/' . ($url);
        //$iThumbnailWidth = $max;
        //$iThumbnailHeight = $max;
        $iMaxWidth = $max;
        $iMaxHeight = $max;

        if ($iMaxWidth && $iMaxHeight)
            $sType = 'scale';
        else if ($iThumbnailWidth && $iThumbnailHeight)
            $sType = 'exact';

        $img = NULL;

        $sExtension = strtolower(end(explode('.', $sImagePath)));
        if ($sExtension == 'jpg' || $sExtension == 'jpeg') {

            $img = @imagecreatefromjpeg($sImagePath) or die("Cannot create new JPEG image");
        } else if ($sExtension == 'png') {

            $img = @imagecreatefrompng($sImagePath) or die("Cannot create new PNG image");
        } else if ($sExtension == 'gif') {

            $img = @imagecreatefromgif($sImagePath) or die("Cannot create new GIF image");
        }
        if ($img) {

            $iOrigWidth = imagesx($img);
            $iOrigHeight = imagesy($img);

            if ($sType == 'scale') {

                // Get scale ratio

                $fScale = min($iMaxWidth / $iOrigWidth, $iMaxHeight / $iOrigHeight);

                if ($fScale < 1) {

                    $iNewWidth = floor($fScale * $iOrigWidth);
                    $iNewHeight = floor($fScale * $iOrigHeight);

                    $tmpimg = imagecreatetruecolor($iNewWidth, $iNewHeight);

                    imagecopyresampled($tmpimg, $img, 0, 0, 0, 0, $iNewWidth, $iNewHeight, $iOrigWidth, $iOrigHeight);

                    imagedestroy($img);
                    $img = $tmpimg;
                }
            } else if ($sType == "exact") {

                $fScale = max($iThumbnailWidth / $iOrigWidth, $iThumbnailHeight / $iOrigHeight);

                if ($fScale < 1) {

                    $iNewWidth = floor($fScale * $iOrigWidth);
                    $iNewHeight = floor($fScale * $iOrigHeight);

                    $tmpimg = imagecreatetruecolor($iNewWidth, $iNewHeight);
                    $tmp2img = imagecreatetruecolor($iThumbnailWidth, $iThumbnailHeight);

                    imagecopyresampled($tmpimg, $img, 0, 0, 0, 0, $iNewWidth, $iNewHeight, $iOrigWidth, $iOrigHeight);

                    if ($iNewWidth == $iThumbnailWidth) {

                        $yAxis = ($iNewHeight / 2) -
                                ($iThumbnailHeight / 2);
                        $xAxis = 0;
                    } else if ($iNewHeight == $iThumbnailHeight) {

                        $yAxis = 0;
                        $xAxis = ($iNewWidth / 2) -
                                ($iThumbnailWidth / 2);
                    }

                    imagecopyresampled($tmp2img, $tmpimg, 0, 0, $xAxis, $yAxis, $iThumbnailWidth, $iThumbnailHeight, $iThumbnailWidth, $iThumbnailHeight);

                    imagedestroy($img);
                    imagedestroy($tmpimg);
                    $img = $tmp2img;
                }
            }

            header("Content-type: image/jpeg");
            imagejpeg($img,NULL,90);
        }
    }

        function thumb($ancho,$alto,$dir,$url){
           /* $sImagePath = FCPATH . '../res/' . $dir . '/' . ($url);
        //$iThumbnailWidth = $max;
        //$iThumbnailHeight = $max;
        $iMaxWidth = $max;
        $iMaxHeight = $max;*/
        $file=FCPATH . '../res/' . $dir . '/' . ($url);
        
        $quality=90;if(isset($_POST['quality']))$quality=$_POST['quality'];
        
        
       // $ancho='100';if(isset($_POST['ancho']))$ancho=$ancho;
        //$alto='100';if(isset($_POST['alto']))$alto=$_POST['alto'];
        
        list($anchoO, $altoO,$type) = getimagesize($file);
        $imagen = @ImageCreateFromJPEG ($file) or // Read JPEG Image
	$imagen = @ImageCreateFromPNG ($file) or // or PNG Image
	$imagen = @ImageCreateFromGIF ($file) or // or GIF Image
	$imagen = false;
        $noblack=1;if(isset($_POST['noblack']))$noblack=$_POST['noblack'];
        
        if($noblack==1){
            if($anchoO>$altoO){
                $porcentaje=$anchoO/$altoO;
                if(($ancho/$porcentaje)>$alto){
                    $n_ancho = $ancho;
                    $n_alto = $ancho/$porcentaje;
                    $ajusteX=0;
                    $ajusteY=-($n_alto-$alto)/2;
                }else{
                    $n_ancho = $alto*$porcentaje;
                    $n_alto = $alto;
                    $ajusteX=-($n_ancho-$ancho)/2;
                    $ajusteY=0;
                }
            }else{
                $porcentaje=$altoO/$anchoO;
                if(($alto/$porcentaje)>$ancho){
                    $n_ancho = $alto/$porcentaje;
                    $n_alto = $alto;
                    $ajusteX=-($n_ancho-$ancho)/2;
                    $ajusteY=0;
                }else{
                    $n_ancho = $ancho;
                    $n_alto = $ancho*$porcentaje;
                    $ajusteX=0;
                    $ajusteY=-($n_alto-$alto)/2;
                }
               
            }
        }elseif($noblack==0){
            if($anchoO>$altoO){
                $porcentaje=$anchoO/$altoO;
                if(($ancho/$porcentaje)>$alto){
                    $n_ancho = $alto*$porcentaje;
                    $n_alto = $alto;
                    $ajusteX=($ancho-$n_ancho)/2;
                    $ajusteY=0;
                }else{
                    $n_ancho = $ancho;
                    $n_alto = $ancho/$porcentaje;
                    $ajusteX=0;
                    $ajusteY=($alto-$n_alto)/2; 
                }
            }else{
                $porcentaje=$altoO/$anchoO;
                if(($alto/$porcentaje)>$ancho){
                    $n_ancho = $ancho;
                    $n_alto = $ancho*$porcentaje;
                    $ajusteX=0;
                    $ajusteY=($alto-$n_alto)/2; 
                }else{
                    $n_ancho = $alto/$porcentaje;
                    $n_alto = $alto;
                    $ajusteX=($ancho-$n_ancho)/2;
                    $ajusteY=0;
                }
                
            }
        }
            
            $imagen_p = imagecreatetruecolor($ancho, $alto);
            if(($type == 1) OR ($type==3)){
                imagealphablending($imagen_p, false);
                imagesavealpha($imagen_p,true);
                $transparent = imagecolorallocatealpha($imagen_p, 255, 255, 255, 127);
                imagefilledrectangle($imagen_p, $ajusteX, $ajusteY, $ancho, $alto, $transparent);
            }
            imagecopyresampled($imagen_p, $imagen, $ajusteX, $ajusteY, 0, 0, $n_ancho,$n_alto, $anchoO, $altoO);
           header("Content-type: image/jpeg");
            switch ($type) {
                case 1: imagegif($imagen_p,NULL); break;
                case 2: imagejpeg($imagen_p,NULL,$quality);  break;
                case 3: imagepng($imagen_p,NULL); break;
                default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
            }

        
    }


}
