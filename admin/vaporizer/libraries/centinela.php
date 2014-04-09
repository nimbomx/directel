<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
    
class Centinela{
    var $_id=0;
    var $_nick='';
    var $_clave='';
    var $_nivel='';
    var $_recordar='n';
    
    var $_auth=FALSE;
    
    function Centinela($auto=TRUE){
        if($auto){
            $CI=& get_instance();
            $CI->load->library('session');
            if($this->login($CI->session->userdata('nick'),$CI->session->userdata('clave'),$CI->session->userdata('recordar'))){
                $this->_id=$CI->session->userdata('id');
                $this->_nick=$CI->session->userdata('nick');
                $this->_clave=$CI->session->userdata('clave');
                $this->_nivel=$CI->session->userdata('nivel');
                $this->_recordar=$CI->session->userdata('recordar');
                
            }
        }
    }
    function getId(){return $this->_id;}
    function getNick(){return $this->_nick;}
    function getClave(){return $this->_clave;}
    function getNivel(){return $this->_nivel;}
    function getRecordar(){return $this->_recordar;}
    
    function login($nick='',$clave='',$recordar){
        $shC=$clave;
        $CI=& get_instance();
        if(trim($nick)==''||trim($clave)=='')return FALSE;
        $CI->db->where('nick',$nick);
        $CI->db->where('password',sha1($clave));
        $query=$CI->db->get('vnb_usuarios');
        //login ok
        $tmp=false;
        if($query->num_rows()==0){
            $shC=trim($clave);
            $CI->db->where('nick',$nick);
            $CI->db->where('tmpPass',$shC);
            $query=$CI->db->get('vnb_usuarios');
            $tmp=true;
            $CI->session->set_userdata('passTmp',true);
        }
        if($query->num_rows()==1){
            if($recordar=='n'){
                $CI->session->sess_expiration=(60*60);
                $CI->session->sess_expire_on_close=TRUE;
            }else{
                $CI->session->sess_expiration=(60*60*24*365*2);
                $CI->session->sess_expire_on_close=FALSE;
            }
            $CI->session->sess_write();
            $row= $query->row();
            $CI->session->set_userdata('id',$row->id);
            $this->_id=$row->id;
            $CI->session->set_userdata('nick',$nick);
            $this->_nick=$nick;
            $CI->session->set_userdata('clave',$shC);
            $this->_clave=$clave;
            $CI->session->set_userdata('nivel',$row->nivel);
            $this->_nivel=$row->nivel;
            $CI->session->set_userdata('recordar',$recordar);
            $this->_recordar=$recordar;

            $this->_auth=TRUE;
            return TRUE;
            
        }else{
            $this->_auth=FALSE;
            $this->logout();
            return FALSE;
        }
    }
    
    function logout(){
        $CI= & get_instance();
        $CI->session->sess_destroy();
        $this->_auth=FALSE;
    }
    
    function check($nivel=0,$estricto=TRUE){
        /*print ;
        */
        $CI=& get_instance();
       /* if(!in_array($CI->session->userdata('session_id'),$this->_sessions))return FALSE;*/
        if(!$this->_auth)return FALSE;
        if($estricto){
            if($nivel==$this->_nivel||$this->_nivel==777)return TRUE;
            else return FALSE;
        }else{
            if($nivel<=$this->_nivel||$this->_nivel==777)return TRUE;
            else return FALSE;
        }
    }
    
}
?>
