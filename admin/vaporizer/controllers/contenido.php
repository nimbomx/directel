<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contenido extends CI_Controller {

	public function index()
	{

		$centinela=new Centinela();
                if(!$centinela->check(0,FALSE)):
                    $this->load->view('signin');
                else:
                    $data['seccion']='contenido';
                    $this->load->view('main',$data);
                    
                endif;

	}
        public function f($f)
	{
		$centinela=new Centinela();
                if(!$centinela->check(0,FALSE)):
                    $this->load->view('signin');
                else:
                    $chk=checkPA('contenido',$f);
                    if($chk===1){
                        $data['seccion']='contenido';
                        $data['subseccion']=$f;
                        $this->load->view('main',$data);
                    }else if ($chk===2){
                        echo 'Acceso denegado';
                    }else{
                        echo 'Acceso denegado<br>';
                        echo 'Su cuenta no tiene asignado ningun perfil de acceso.';
                    }
                endif;
	}
}