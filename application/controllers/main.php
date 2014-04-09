<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
            $data['title']='direcTEL';
            $this->load->view('main',$data);
	}
        
        public function a($url)
	{
            $data['title']='direcTEL';
            $data['slide']=$url;
            $this->load->view('main',$data);
	}

}
