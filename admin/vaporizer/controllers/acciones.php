<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acciones extends CI_Controller {
    

//SIGNIN FUNCTIONS
    public function login(){
        $this->load->model('signinmodel','signin');
	$this->signin->logIn();	      
    }
    public function logout(){
        $this->load->model('signinmodel','signin');
	$this->signin->logOut();	      
    }
    
    
    public function a($e,$t){
            $this->load->model('function_model','fnm');
            $this->fnm->$e($t);
    }
    
    public function changepass(){
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        $token=$_POST['token'];
       $id=$this->db->where('nick',$user)->get('usuarios')->row()->id;
       $perfil=$this->db->get_where('perfil',array('id'=>$id))->row();
       if ($perfil->token === $token) {
                if(strtotime($perfil->update) > strtotime("-3 days")) {
                    $this->db->where('id',$id)->update('usuarios',array('password'=>sha1(trim($pass))));
                    $this->db->where('id',$id)->update('perfil',array('token'=>''));
                    echo 'ok';
                }else{
                     echo 'error';
                }

            }else {
                echo 'error';
            } 

            
    }
    public function lostpass(){
        $user=$_POST['user'];
        $query=$this->db->where('nick',$user)->get('usuarios');
        $rows=$query->num_rows();
        if($rows>0){
            $token=  createPassword(19);
            $data['token']= $token;
            $this->db->where('id',$query->row()->id)->update('perfil',$data);
        $mensaje='Hemos recibido una solicitud para reestablecer su contraseña para '.web_name().'.<br>';
        $mensaje.='Si usted no solicito el cambio de contraseña ignore este correo.<br>';
        
        $mensaje.='El siguiente link sera valido solo por 3 días.<br><br>';
        $mensaje.='<a href="'.base_url('reestablecer_contrasena/'.$token.'/'.base64_encode($_POST['user'])).'">'.base_url('reestablecer-contrasena/'.$token.'/'.base64_encode($_POST['user'])).'</a>';
        $mensaje.='<br><br>';
        
        $to=$_POST['user'];
        $asunto='Solicitud de cambio de contraseña para '.web_name();
        $from_mail='noreply@'.$_SERVER['SERVER_NAME'];
        $from_name=web_name();
        if(mandar_mail($to,$asunto,$mensaje,$from_mail,$from_name)){
            echo 'Hemos enviado a tu correo, las instrucciones para reestablecer tu contraseña.';
        }else{
            echo 'Ha ocurrido un error, intentalo nuevamente mas tarde.';
        }
            
            
            
        }else{
            echo 'La cuenta <b>"'.$user.'"</b> no existe,<br> verifica tus datos.<br><br><button autofocus onclick="retry()">reintentar</button>';
        }
    }
    
    public function getTab(){
        $this->load->view('tab/'.$_POST['tab'],array('form'=>$_POST['form']));
    }
        public function getForm(){
            $this->load->view('forms/'.$_POST['form']);
        }
        public function editarPerfil(){
            $id=$this->session->userdata('id');
            if($_POST['avatar']!=''){
                $currentA=$this->db->get_where('perfil',array('id'=>$id))->row()->avatar;
                if($currentA!='')unlink(FCPATH.'../recursos/avatar/'.$currentA);
                if(!is_dir(FCPATH.'../recursos/avatar'))mkdir(FCPATH.'../recursos/avatar',0777,true);
                rename(FCPATH.'../recursos/tmp/resized/'.$_POST['avatar'], FCPATH.'../recursos/avatar/'.$_POST['avatar']);
                $data['avatar']=$_POST['avatar'];
            }
            $data['nick']=$_POST['nick'];
            
            $this->db->where('id',$id);
            $this->db->update('perfil',$data);
        }
        
        public function verificarContrasenia(){
            $currentPass= $_POST['currentPass'];
            if(sha1(trim($currentPass))===$this->session->userdata('clave')){
                echo $currentPass;
            }else{
                echo 'error';
            }
        }
        public function cambiarContrasenia(){
            $newPass= $_POST['newPass'];
            $currentPass= $_POST['currentPass'];
            if(sha1(trim($currentPass))===$this->session->userdata('clave')){
                $this->db->where('id',$this->session->userdata('id'))->update('usuarios',array('password'=>sha1(trim($newPass))));
                echo 'ok';
            }else{
                echo 'error';
            }
        }
        public function eliminarCuenta(){
            $id=$_POST['id'];
            $avatar=$this->db->get_where('perfil',array('id'=>$id))->row()->avatar;
            if($avatar!='')unlink(FCPATH.'../recursos/avatar/'.$avatar);
            $this->db->where('id',$id)->delete('perfil');
            $this->db->where('id',$id)->delete('usuarios');
        }
        public function editarCuenta(){
            $this->db->where('id',$_POST['id'])->update('usuarios',array('nick'=>$_POST['email']));
            echo 'ok';
        }

        public function crearCuenta(){
        $tmpPass=createPassword(6);
        $data['nick']=$_POST['email'];
        $data['password']=  sha1($tmpPass);
        $data['nivel']=1;
        $this->db->insert('usuarios',$data);
        $datap['id']=$this->db->insert_id();
        $mensaje='Bienvenid@ a '.web_name().' sus datos de acceso son:<br>';
        $mensaje.='correo: '.$_POST['email'].'<br>';
        $mensaje.='contraseña temporal: '.$tmpPass.'<br><br>';
        $mensaje.='<a href="'.base_url().'">'.web_name().' - Nimbo Reeld 13</a> <br>';
        $to=$_POST['email'];
        $asunto='Nueva cuenta de '.web_name();
        $from_mail='noreply@'.$_SERVER['SERVER_NAME'];
        $from_name=web_name();
        if(mandar_mail($to,$asunto,$mensaje,$from_mail,$from_name)){
            $datap['nick']=$data['nick'];
            $datap['correo']=$data['nick'];
            $this->db->insert('perfil',$datap);
            echo 'ok';
        }else{
            echo 'error';
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */