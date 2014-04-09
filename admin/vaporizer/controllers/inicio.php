<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index()
	{
            $data['section']='start';
            $this->general_model->checkLogin($data);
	}
        public function a($section,$extra=null)
	{
            $data['section']=$section;
            $data['extra']=$extra;
            $this->general_model->checkLogin($data);
	}
        public function reestablecer_contrasena($token,$mail){
            $user= base64_decode($mail);
            $data['reeuser']=md5(trim($user));
            $data['token']=$token;
            $id=$this->db->where('nick',$user)->get('usuarios')->row()->id;
             $perfil=$this->db->get_where('perfil',array('id'=>$id))->row();
            if ($perfil->token === $token) {
                $data['tokenExist']='ok';
                if(strtotime($perfil->update) > strtotime("-3 days")) {
                    $data['tokenLive']='ok';
                }else{
                    $data['tokenLive']='bad';
                }

            }else {
                $data['tokenExist']='bad';
            } 
            
            $this->load->view('recoverPass',$data);

        }
}
