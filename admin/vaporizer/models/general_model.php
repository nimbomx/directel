<?php
class General_model extends CI_Model {

    var $webname   = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('generic');
        $cfg = new generic();
        foreach($this->db->get('vnb_config')->result() as $cf){
            $cfg->set($cf->key,$cf->value);
        };
        $this->webname=$cfg->get('webname');
    }
    function checkLogin($data){
        $centinela=new Centinela();
        $data['webname']=$this->webname;
        if(!$centinela->check(0,FALSE)):
            $this->load->view('signin',$data);
        else:
            $this->load->view('block/header',$data);
            //$this->load->view('block/topbar');
            $this->load->view('block/leftbar');
            $this->load->view('block/section');
            $this->load->view('block/bottom');
            /*$data['seccion']='';
            $this->load->view('main',$data);*/
        endif;
    }
}
?>