<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Desarrollo extends CI_Controller {

	public function index()
	{
		$centinela=new Centinela();
                if(!$centinela->check(0,FALSE)):
                    $this->load->view('signin');
                else:
                    if(!$centinela->check(777,FALSE)) redirect (base_url());
                    $data['seccion']='desarrollo';
                    $this->load->view('main',$data);
                    
                endif;
	}
        public function f($f)
	{
		$centinela=new Centinela();
                if(!$centinela->check(0,FALSE)):
                    $this->load->view('signin');
                else:
                    $data['seccion']='desarrollo';
                    $data['subseccion']=$f;
                    $this->load->view('main',$data);
                endif;
	}
}
