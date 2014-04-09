<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $this->load->view('form', array('error' => ''));
    }
    public function upfile(){
        ini_set ('memory_limit','1028M');
        if(!is_dir(FCPATH.'../res/tmp'))mkdir(FCPATH.'../res/tmp',0777,true);
        $config['upload_path'] = FCPATH.'../res/tmp';
        $config['allowed_types'] = '*';
        $config['remove_spaces'] = FALSE;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload()){
            echo '<div id="status">error</div>';
            echo '<div id="message">'. $this->upload->display_errors() .'</div>';
        }else{
            $upload_data = $this->upload->data();
            echo '{"name":"'.$upload_data['file_name'].'","type":"'.$upload_data['file_type'].'","size":"'.$upload_data['file_size'].'"}';
        }
    }
    public function upimg($table){
        ini_set ('memory_limit','1028M');
        if(!is_dir(FCPATH.'../res/'.$table))mkdir(FCPATH.'../res/'.$table,0777,true);
        $config['upload_path'] = FCPATH.'../res/'.$table;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['remove_spaces'] = FALSE;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload()){
            echo '<div id="status">error</div>';
            echo '<div id="message">'. $this->upload->display_errors() .'</div>';
        }else{
            $upload_data = $this->upload->data();
            echo '{"name":"'.$upload_data['file_name'].'","type":"'.$upload_data['file_type'].'","size":"'.$upload_data['file_size'].'"}';
        }
    }
    public function upimgtmp(){
        ini_set ('memory_limit','1028M');
        if(!is_dir(FCPATH.'../res/tmp'))mkdir(FCPATH.'../res/tmp',0777,true);
        $config['upload_path'] = FCPATH.'../res/tmp';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['remove_spaces'] = FALSE;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload()){
            echo '<div id="status">error</div>';
            echo '<div id="message">'. $this->upload->display_errors() .'</div>';
        }else{
            $upload_data = $this->upload->data();
            echo '{"name":"'.$upload_data['file_name'].'","type":"'.$upload_data['file_type'].'","size":"'.$upload_data['file_size'].'"}';
        }
    }
    function resize(){
        ini_set ('memory_limit','64M');
        $file=$_POST['file'];
        $parts = pathinfo($file);
        
        $quality=90;if(isset($_POST['quality']))$quality=$_POST['quality'];
        
        $nameFile=date('YmdHis').'.'.$parts ['extension'];
        if(!is_dir(FCPATH.'../res/tmp/resized'))mkdir(FCPATH.'../res/tmp/resized',0777,true);
        $salida=FCPATH.'../res/tmp/resized/'.$nameFile;
        $origen=FCPATH.'../res/tmp/'.$file;
        
        $ancho='100';if(isset($_POST['ancho']))$ancho=$_POST['ancho'];
        $alto='100';if(isset($_POST['alto']))$alto=$_POST['alto'];
        
        list($anchoO, $altoO,$type) = getimagesize($origen);
        $imagen = @ImageCreateFromJPEG ($origen) or // Read JPEG Image
	$imagen = @ImageCreateFromPNG ($origen) or // or PNG Image
	$imagen = @ImageCreateFromGIF ($origen) or // or GIF Image
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
            switch ($type) {
                case 1: imagegif($imagen_p,$salida); break;
                case 2: imagejpeg($imagen_p,$salida,$quality);  break;
                case 3: imagepng($imagen_p,$salida); break;
                default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
            }
            if(!isset($_POST['nodel']))unlink($origen);
            echo $nameFile;
        
    }
       function resizeThumb(){
        ini_set ('memory_limit','64M');
        $file=$_POST['file'];
        $parts = pathinfo($file);
        
        $quality=90;if(isset($_POST['quality']))$quality=$_POST['quality'];
        
        $nameFile=date('YmdHis').'.'.$parts ['extension'];
        $salida='content/tmp/resized/thumb/'.$nameFile;
        $origen='content/tmp/resized/'.$file;
        
        $ancho='100';if(isset($_POST['ancho']))$ancho=$_POST['ancho'];
        $alto='100';if(isset($_POST['alto']))$alto=$_POST['alto'];
        
        list($anchoO, $altoO,$type) = getimagesize($origen);
        $imagen = @ImageCreateFromJPEG ($origen) or // Read JPEG Image
	$imagen = @ImageCreateFromPNG ($origen) or // or PNG Image
	$imagen = @ImageCreateFromGIF ($origen) or // or GIF Image
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
            switch ($type) {
                case 1: imagegif($imagen_p,$salida); break;
                case 2: imagejpeg($imagen_p,$salida,$quality);  break;
                case 3: imagepng($imagen_p,$salida); break;
                default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
            }
            echo $nameFile;
        
    }
}
// End of file upload