<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ownact extends CI_Controller {

        
    public function addItem($tabla){
            $webDB = $this->load->database('web', TRUE);
            $data=$_POST;
            $webDB->insert($tabla,$data);
              
	}
        public function delItem($tabla)
	{
            $webDB = $this->load->database('web', TRUE);
            $webDB->where('id',$_POST['id'])->delete($tabla);
	}
        public function editItem($tabla){
            $webDB = $this->load->database('web', TRUE);
            $webDB->where('id',$_POST['id'])->update($tabla,$_POST);
	}
        
	public function addVideo(){
            
            $tabla='video';
            $webDB = $this->load->database('web', TRUE);
            $data=$_POST;
            $data['poster']='';
            if($_POST['poster']!=''){
                     $data['poster']=$_POST['poster'];
                     if(!is_dir(FCPATH.'../recursos/'.$tabla))mkdir(FCPATH.'../recursos/'.$tabla,0777,true);
                    rename(FCPATH.'../recursos/tmp/resized/'.$_POST['poster'], FCPATH.'../recursos/'.$tabla.'/'.$_POST['poster']);
             }
            $webDB->insert($tabla,$data);
              
	}
        public function editVideo(){
            $tabla='video';
            $webDB = $this->load->database('web', TRUE);
            $data=$_POST;
            $data['poster']='';
            $current=$webDB->get_where($tabla,array('id'=>$_POST['id']))->row();
            $data['poster']=$currentCover=$current->poster;
            if($_POST['poster']!=''){
                    $data['poster']=$_POST['poster'];
                    if($currentCover!='')unlink(FCPATH.'../recursos/'.$tabla.'/'.$currentCover);
                     if(!is_dir(FCPATH.'../recursos/'.$tabla))mkdir(FCPATH.'../recursos/'.$tabla,0777,true);
                    rename(FCPATH.'../recursos/tmp/resized/'.$_POST['poster'], FCPATH.'../recursos/'.$tabla.'/'.$_POST['poster']);
             }
            $webDB->where('id',$_POST['id'])->update($tabla,$data);
              
	}
        private function delVideo()
	{
            $tabla='video';
            $webDB = $this->load->database('web', TRUE);
            $current=$webDB->get_where($tabla,array('id'=>$_POST['id']))->row();
            $data['poster']=$currentCover=$current->poster;
            if($currentCover!='')unlink(FCPATH.'../recursos/'.$tabla.'/'.$currentCover);
            $webDB->where('id',$_POST['id'])->delete($tabla);
	}
        
      public function addEvento(){
            $tabla='eventos';
            $webDB = $this->load->database('web', TRUE);
            $data=$_POST;
            $data['imagen']='';
            if($_POST['imagen']!=''){
                     $data['imagen']=$_POST['imagen'];
                     if(!is_dir(FCPATH.'../recursos/'.$tabla))mkdir(FCPATH.'../recursos/'.$tabla,0777,true);
                    rename(FCPATH.'../recursos/tmp/resized/'.$_POST['imagen'], FCPATH.'../recursos/'.$tabla.'/'.$_POST['imagen']);
             }
            $webDB->insert($tabla,$data);
                
	}  
         public function delEvento()
	{
            $tabla='eventos';
            $webDB = $this->load->database('web', TRUE);
            $currentA=$webDB->get_where($tabla,array('id'=>$_POST['id']))->row()->imagen;
            if($currentA!='')unlink(FCPATH.'../recursos/'.$tabla.'/'.$currentA);
            $webDB->where('id',$_POST['id'])->delete($tabla);
	}
        public function editEvento(){
            $tabla='eventos';
            $webDB = $this->load->database('web', TRUE);
            $data=$_POST;
            $data['imagen']='';
            $currentA=$webDB->get_where($tabla,array('id'=>$_POST['id']))->row()->imagen;
             if($_POST['imagen']!=''){
                if($currentA!='')unlink(FCPATH.'../recursos/'.$tabla.'/'.$currentA);
                 $data['imagen']=$_POST['imagen'];
                 if(!is_dir(FCPATH.'../recursos/'.$tabla))mkdir(FCPATH.'../recursos/'.$tabla,0777,true);
                rename(FCPATH.'../recursos/tmp/resized/'.$_POST['imagen'], FCPATH.'../recursos/'.$tabla.'/'.$_POST['imagen']);
             }else{
                 $data['imagen']=$currentA;
             }
             
            $webDB->where('id',$_POST['id'])->update($tabla,$data);
	}
    public function addArticulo(){
            $tabla='notas';
            $webDB = $this->load->database('web', TRUE);
            if($_POST['destacado']==1){
                $ed=$webDB->get_where($tabla,array('destacado'=>1,'edicion'=>$_POST['edicion']));
                if($ed->num_rows()!=0)$webDB->where('id',$ed->row()->id)->update($tabla,array('destacado'=>0));
            }
            $data=$_POST;
            $data['imagen']='';
            if($_POST['imagen']!=''){
                     $data['imagen']=$_POST['imagen'];
                     if(!is_dir(FCPATH.'../recursos/'.$tabla))mkdir(FCPATH.'../recursos/'.$tabla,0777,true);
                    rename(FCPATH.'../recursos/tmp/resized/'.$_POST['imagen'], FCPATH.'../recursos/'.$tabla.'/'.$_POST['imagen']);
             }
            $webDB->insert($tabla,$data);
                
	}
        public function delArticulo()
	{
            $tabla='notas';
            $webDB = $this->load->database('web', TRUE);
            $currentA=$webDB->get_where($tabla,array('id'=>$_POST['id']))->row()->imagen;
            if($currentA!='')unlink(FCPATH.'../recursos/'.$tabla.'/'.$currentA);
            $webDB->where('id',$_POST['id'])->delete($tabla);
	}
        public function editArticulo(){
            $tabla='notas';
            $webDB = $this->load->database('web', TRUE);
            if($_POST['destacado']==1){
                $ed=$webDB->get_where($tabla,array('destacado'=>1,'edicion'=>$_POST['edicion']));
                if($ed->num_rows()!=0)$webDB->where('id',$ed->row()->id)->update($tabla,array('destacado'=>0));
            }
            $data=$_POST;
            $data['imagen']='';
            $currentA=$webDB->get_where($tabla,array('id'=>$_POST['id']))->row()->imagen;
             if($_POST['imagen']!=''){
                if($currentA!='')unlink(FCPATH.'../recursos/'.$tabla.'/'.$currentA);
                 $data['imagen']=$_POST['imagen'];
                 if(!is_dir(FCPATH.'../recursos/'.$tabla))mkdir(FCPATH.'../recursos/'.$tabla,0777,true);
                rename(FCPATH.'../recursos/tmp/resized/'.$_POST['imagen'], FCPATH.'../recursos/'.$tabla.'/'.$_POST['imagen']);
             }else{
                 $data['imagen']=$currentA;
             }
             
            $webDB->where('id',$_POST['id'])->update($tabla,$data);
	}
        public function getEdJSON()
	{
            $tabla='notas';
            $webDB = $this->load->database('web', TRUE);
            $rows=$webDB->get_where($tabla,array('edicion'=>$_POST['edicion']))->result();
            echo json_encode($rows);  
	}
        private function orderArticulo(){
            $webDB = $this->load->database('web', TRUE);
            $webDB->where('id',$_POST['id']);
            $webDB->update('notas',$_POST);

        }
        private function orderEvento(){
            $webDB = $this->load->database('web', TRUE);
            $webDB->where('id',$_POST['id']);
            $webDB->update('eventos',$_POST);

        }
        
        /*SECCIONES*/
        private function addSeccion()
	{
            $tabla='secciones';
            $webDB = $this->load->database('web', TRUE);
            $webDB->insert($tabla,$_POST);
	}
        private function delSeccion()
	{
            $tabla='secciones';
            $webDB = $this->load->database('web', TRUE);
            $webDB->where('clave',$_POST['clave'])->delete($tabla);
	}
        
        
        /*SECURITY*/
         public function security($func){
            if(@$_SERVER['HTTP_REFERER']){
                $url_parts = parse_url($_SERVER['HTTP_REFERER']);
                if($_SERVER['HTTP_HOST']!=$url_parts['host'])die ('denied');
            }
            else die('denied');
            $centinela = new Centinela();
            if($centinela->check(0, FALSE)){
                    $this->$func();
            }else{ 
                echo 'invalid';
            }
	}
}
