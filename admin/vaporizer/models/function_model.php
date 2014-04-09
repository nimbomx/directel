<?php

class Function_model extends CI_Model {

    var $webDB = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database('default', TRUE);
        $this->webDB = $this->load->database('web', TRUE);
    }
    //CLIENTES
    function removeClient($tabla){
        $this->webDB->where('id',$_POST['id'])->delete($tabla);
    }
    
    //PEDIDOS
    function cancelarPedido($tabla){
        
        $car = $this->webDB->where('id',$_POST['id'])->get($tabla)->row();
        if($car->status=='cancelado')return false;
        $list= explode(',', $car->shoplist);
        foreach ($list as $item){
           $cat=$this->webDB->where('id',$item)->get('productos')->row()->cantidad;
           $cat++;
           $this->webDB->where('id',$item)->update('productos',array('cantidad'=>$cat,'sale_status'=>''));
        }
        $this->webDB->where('id',$_POST['id'])->update($tabla,array('status'=>'cancelado'));
    }

//GALERIA
    function getGalleryInfo($tabla){
        echo json_encode($this->webDB->get_where($tabla, array('id'=>$_POST['id']))->row());
    }
    function getGalleryAddImg($tabla){
        $this->load->view('pieces/galleryAddImg',array('table'=>$tabla));
    }
    function removeGalleryItem($tabla){
        $e = $this->webDB->get_where($tabla,array('id'=>$_POST['id']))->row()->imagen;
        $elem=  explode(',', $e);
        $i= array_search ($_POST['img'],$elem);
        unset($elem[$i]);
        $new= implode(',',$elem);
        unlink(FCPATH . '../res/' . $tabla . '/' . $_POST['img']);
        echo $new;
        $this->webDB->where('id',$_POST['id'])->update($tabla, array('imagen'=>$new));
    }
    function saveGalleryAddImg($tabla){
        if ($_POST['imagen'] != '') {
            if (!is_dir(FCPATH . '../res/' . $tabla))mkdir(FCPATH . '../res/' . $tabla, 0777, true);
            $imgs=  explode(',', $_POST['imagen']);
            $uniq=date('YmdHis');
            $imgsnms = array();
            foreach ($imgs as $img){
                $file=FCPATH . '../res/' . $tabla . '/' . $img;
                $parts = pathinfo($file);
                $uniq++;
                $nameFile=$uniq.'.'.$parts ['extension'];
                $imgsnms[]=$nameFile;
                rename(FCPATH . '../res/' . $tabla . '/' . $img, FCPATH . '../res/' . $tabla . '/' . $nameFile);
            }
            $data['imagen']=implode(',',$imgsnms);
        }
        echo $data['imagen'];
        $this->webDB->where('id',$_POST['id'])->update($tabla, $data);
    }
    //PRODUCTO
    function newItem($tabla){
        $search=$this->webDB->order_by('id','asc')->get_where($tabla, array('vap_itemstatus'=>'empty'));
        if($search->num_rows()!=0){
            $this->webDB->where('id', $search->row()->id)->update($tabla, array('vap_itemstatus'=>'draft'));
            echo $search->row()->id;
        }else{
            $this->webDB->insert($tabla, array('vap_itemstatus'=>'draft'));
            echo $this->webDB->insert_id();
        }
    }
    function cancelItemEdit($tabla){
        $query=$this->webDB->get_where($tabla, array('id'=>$_POST['id']))->row();
        if($query->vap_itemstatus=='draft'){
            $this->webDB->where('id', $_POST['id'])->update($tabla, array('vap_itemstatus'=>'empty'));
        }
    }
    function removeItem($tabla){
        $imagen = $this->webDB->get_where($tabla, array('id' => $_POST['id']))->row()->imagen;
        if ($imagen != ''){
            $imgs=  explode(',', $imagen);
            foreach ($imgs as $img){
                unlink(FCPATH . '../res/' . $tabla . '/' . $img);
            }
        }
        $this->webDB->where('id', $_POST['id'])->delete($tabla);
    }
    function archiveItem($tabla){
        $this->webDB->where('id', $_POST['id'])->update($tabla,array('pub_status'=>'archived'));
    }
    function saveItemChanges($tabla){
        $data=$_POST;
        $data['imagen']='';
        if ($_POST['imagen'] != '') {
            if (!is_dir(FCPATH . '../res/' . $tabla))mkdir(FCPATH . '../res/' . $tabla, 0777, true);
            $imgs=  explode(',', $_POST['imagen']);
            $uniq=date('YmdHis');
            $imgsnms = array();
            foreach ($imgs as $img){
                $file=FCPATH . '../res/' . $tabla . '/' . $img;
                $parts = pathinfo($file);
                $uniq++;
                $nameFile=$uniq.'.'.$parts ['extension'];
                $imgsnms[]=$nameFile;
                rename(FCPATH . '../res/' . $tabla . '/' . $img, FCPATH . '../res/' . $tabla . '/' . $nameFile);
            }
            $data['imagen']=implode(',',$imgsnms);
        }
        $this->webDB->where('id',$_POST['id'])->update($tabla, $data);
    }
            
    
    function uploadItemImg($tabla) {
        $data=$_POST;
        $data['imagen']='';
        if ($_POST['imagen'] != '') {
            if (!is_dir(FCPATH . '../res/' . $tabla))mkdir(FCPATH . '../res/' . $tabla, 0777, true);
            $imgs=  explode(',', $_POST['imagen']);
            $uniq=date('YmdHis');
            $imgsnms = array();
            foreach ($imgs as $img){
                $file=FCPATH . '../res/tmp/' . $img;
                $parts = pathinfo($file);
                $uniq++;
                $nameFile=$uniq.'.'.$parts ['extension'];
                $imgsnms[]=$nameFile;
                rename(FCPATH . '../res/tmp/' . $img, FCPATH . '../res/' . $tabla . '/' . $nameFile);
            }
            $data['imagen']=implode(',',$imgsnms);
        }
        $this->webDB->insert($tabla, $data);
    }
    
    
    function uploadItem($tabla) {
        $this->webDB->insert($tabla, $_POST);
    }

    function deleteItem($tabla) {
        $this->webDB->where('id', $_POST['id'])->delete($tabla);
    }

    function updateItem($tabla) {
        $data = $_POST;
        $this->webDB->where('id', $_POST['id'])->update($tabla, $data);
    }

    function updateItemAccount($tabla) {
       $this->load->database('default', TRUE);
       $data = $_POST;
        $this->db->where('id', $_POST['id'])->update($tabla, $data);
    }
    function uploadAccount($tabla) {
        $this->load->database('default', TRUE);
        $this->db->insert($tabla, $_POST);
        $last_id=$this->db->insert_id();
        $this->db->insert('vnb_perfiles', array('id'=>$last_id));
    }

    function deleteAccount() {
        $this->load->database('default', TRUE);
        $this->db->where('id', $_POST['id'])->delete('vnb_usuarios');
        $this->db->where('id', $_POST['id'])->delete('vnb_perfiles');
    }

    
    function uploadItemImgOLD($tabla) {
        if ($_POST['imagen'] != '') {
            $data['imagen'] = $_POST['imagen'];
            if (!is_dir(FCPATH . '../res/' . $tabla))
                mkdir(FCPATH . '../res/' . $tabla, 0777, true);
            rename(FCPATH . '../res/tmp/resized/' . $_POST['imagen'], FCPATH . '../res/' . $tabla . '/' . $_POST['imagen']);
        }
        $this->webDB->insert($tabla, $_POST);
    }

    function updateItemImg($tabla) {
        $data = $_POST;
        $data['imagen'] = ''; //vaciamos el campo imagen
        $imagenActual = $this->webDB->get_where($tabla, array('id' => $_POST['id']))->row()->imagen; //obtenemos la imagen actual
        if ($_POST['imagen'] != '') {
            if ($imagenActual != '')
                unlink(FCPATH . '../res/' . $tabla . '/' . $imagenActual);
            $data['imagen'] = $_POST['imagen'];
            if (!is_dir(FCPATH . '../res/' . $tabla))
                mkdir(FCPATH . '../res/' . $tabla, 0777, true);
            rename(FCPATH . '../res/tmp/resized/' . $_POST['imagen'], FCPATH . '../res/' . $tabla . '/' . $_POST['imagen']);
        }else {
            $data['imagen'] = $imagenActual;
        }
        $this->webDB->where('id', $_POST['id'])->update($tabla, $data);
    }

    function deleteItemImg($tabla) {
        $imagen = $this->webDB->get_where($tabla, array('id' => $_POST['id']))->row()->imagen;
        if ($imagen != '')
            unlink(FCPATH . '../res/' . $tabla . '/' . $imagen);
        $this->webDB->where('id', $_POST['id'])->delete($tabla);
    }

    function getJSON($tabla) {
        $rows = $this->webDB->get($tabla)->result();
        echo json_encode($rows);
    }

    function getItemJSON($tabla) {
        $row = $this->webDB->get_where($tabla, array('id' => $_POST['id']))->row();
        echo json_encode($row);
    }

    function getItemJSONvap($tabla) {
        $this->load->database('default', TRUE);
         $row = $this->db->get_where($tabla, array('id' => $_POST['id']))->row();$CI=& get_instance();
          $row=$CI->db->get_where($tabla,array('id'=>$_POST['id']))->row();
          echo json_encode($row); 
    }

    function getItemJSONWhere($tabla) {
        $row = $this->webDB->get_where($tabla, $_POST)->row();
        echo json_encode($row);
    }

}

?>