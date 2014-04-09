<?php

//1
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acciones extends CI_Controller {

    public function suscribe() {
        $this->db->insert('newsletter_list', $_POST);
    }

    public function get($sec) {
        $data['cat'] = $_POST['cat'];
        $this->load->view('block/' . $sec, $data);
    }

    public function getItems() {

        echo json_encode($this->db->order_by('id', 'desc')->where('vap_itemstatus', '')->where('sale_status', '')->get('productos', $_POST['noitems'], $_POST['lastit'])->result());
    }
    public function getNoItems() {
        $busqueda = $_POST['search'];
        $trozos = explode(" ", $busqueda);
        $numero = count($trozos);
        if ($numero == 1) {
            $query = "SELECT * FROM productos  WHERE vap_itemstatus = '' AND (frase LIKE  '%$busqueda%' OR nombre LIKE  '%$busqueda%')";
        } else {
            $query = "SELECT  *, MATCH ( nombre, frase )
      AGAINST (  '$busqueda' ) AS Score FROM productos WHERE
      MATCH ( nombre, frase ) AGAINST (  '$busqueda' ) ";
        }
        echo $this->db->query($query)->num_rows();
    }
    public function getSearchItems() {
        $busqueda = $_POST['search'];
        $index=$_POST['index'];
        $trozos = explode(" ", $busqueda);
        $numero = count($trozos);
        if ($numero == 1) {
            $query = "SELECT * FROM productos  WHERE vap_itemstatus = '' AND (frase LIKE  '%$busqueda%' OR nombre LIKE  '%$busqueda%') ORDER BY id DESC LIMIT $index, 10";
        } else {
            $query = "SELECT  *, MATCH ( nombre, frase )
      AGAINST (  '$busqueda' ) AS Score FROM productos WHERE
      MATCH ( nombre, frase ) AGAINST (  '$busqueda' ) ORDER  BY Score DESC LIMIT $index, 10";;
        }
        echo json_encode($this->db->query($query)->result());
    }

    public function getDetail() {
        $this->load->view('block/detail', $_POST);
    }

    public function removeFromCar() {
        $shopcar = $this->session->userdata('shopcar');
        $shopcar = explode(',', $shopcar);
        if (in_array($_POST['id'], $shopcar)) {
            unset($shopcar[array_search($_POST['id'], $shopcar)]);
        }
        //$shopcar=array_diff( $shopcar, [$_POST['id']] );
        $shopcar = implode(',', $shopcar);
        $this->session->set_userdata('shopcar', $shopcar);
    }

    public function addToCar() {
        //echo 'Car: '.$_POST['id'];
        $shopcar = $this->session->userdata('shopcar');
        $shopcar = explode(',', $shopcar);
        //comparar
        if (in_array($_POST['id'], $shopcar)) {
            $cantidad = $this->db->get_where('productos', array('id' => $_POST['id']))->row()->cantidad;
            $counted = array_count_values($shopcar);
            if ($counted[$_POST['id']] >= $cantidad) {
                echo "exist";
                return false;
            }
            /* echo $counted[$_POST['id']];
              return false; */
        }
        $shopcar[] = $_POST['id'];
        $shopcar = array_filter($shopcar);
        $noItems = count($shopcar);
        $total = 0;
        foreach ($shopcar as $item) {
            $precio = $this->db->get_where('productos', array('id' => $item))->row()->precio;
            $precio = str_replace(",", "", $precio);
            $total+=(int) $precio;
        }
        $shopcar = implode(',', $shopcar);
        $this->session->set_userdata('shopcar', $shopcar);
        echo $noItems . ' Articulo(s)  $ ' . number_format($total, 2) . ' <small>MXN</small>';
    }

    public function showMyCar() {
        $shopcar = $this->session->userdata('shopcar');
        $shopcar = explode(',', $shopcar);
        $shopcar = array_filter($shopcar);
        $noItems = count($shopcar);
        $total = 0;
        foreach ($shopcar as $item) {
            $precio = $this->db->get_where('productos', array('id' => $item))->row()->precio;
            $precio = str_replace(",", "", $precio);
            $total+=(int) $precio;
        }
        $shopcar = implode(',', $shopcar);
        $this->session->set_userdata('shopcar', $shopcar);
        if ($noItems == 0) {
            echo '';
            return false;
        }
        echo $noItems . ' Articulo(s)  $ ' . number_format($total, 2) . ' <small>MXN</small>';
    }

    public function clearCar() {
        $this->session->unset_userdata('shopcar');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function showCar() {
        echo $shopcar = $this->session->userdata('shopcar');
    }
    public function isLogged() {
        if($this->session->userdata('mail')) {echo '0';
        }else{ echo '1';}
    }
    public function getItem() {
        echo json_encode($this->db->where('id', $_POST['id'])->get('productos')->row());
    }

    public function createUser() {
        $this->db->insert('usuarios', $_POST);
        $this->session->set_userdata('mail', $_POST['mail']);
        $this->session->set_userdata('password', $_POST['password']);
    }
    public function signOut(){
        $this->session->unset_userdata('mail');
        $this->session->unset_userdata('password');
    }

    public function tryLogin() {
        $query = $this->db->get_where('usuarios', array('mail' => $_POST['mail'], 'password' => $_POST['password']));
        if ($query->num_rows() != 0) {
            $this->session->set_userdata('mail', $_POST['mail']);
            $this->session->set_userdata('password', $_POST['password']);
            echo 'ok';
        } else {
            $this->signOut();
            echo 'fail';
        }
    }

    /*

      if (in_array($_POST['id'], $shopcar)) {
      $cantidad = $this->db->get_where('productos', array('id' => $_POST['id']))->row()->cantidad;
      $counted = array_count_values($shopcar);
      if ($counted[$_POST['id']] >= $cantidad) {
      echo "exist";
      return false;
      }
      }
      $shopcar = array_filter($shopcar);
      $noItems = count($shopcar);
      $total = 0;
      foreach ($shopcar as $item) {
      $precio = $this->db->get_where('productos', array('id' => $item))->row()->precio;
      $precio = str_replace(",", "", $precio);
      $total+=(int) $precio;
      }
      $shopcar = implode(',', $shopcar);
      $this->session->set_userdata('shopcar', $shopcar);
      echo $noItems . ' Articulo(s)  $ ' . number_format($total, 2) . ' <small>MXN</small>';
      }


     */
    public function getshoplist(){
         echo $this->db->get_where('pedidos', array('id' => $_POST['id']))->row()->shoplist;
    }
    public function processBuy() {
        $mail = $this->session->userdata('mail');
        $password = $this->session->userdata('password');
        $shoplist = $this->session->userdata('shopcar');
        $shopcar = explode(',', $shoplist);
        $shopcar = array_filter($shopcar);
        foreach ($shopcar as $sitem) {
            $cantidad = $this->db->get_where('productos', array('id' => $sitem))->row()->cantidad;
            if ($cantidad > 1) {
                $cantidad--;
                $this->db->where('id', $sitem)->update('productos', array('cantidad' => $cantidad));
            } else {
                $this->db->where('id', $sitem)->update('productos', array('cantidad' => 0,'sale_status' => 'pedido'));
            }
        }
        $query = $this->db->get_where('usuarios', array('mail' => $mail, 'password' => $password));
        if ($query->num_rows() != 0) {
            $data['usuario'] = $query->row()->id;
            $data['shoplist'] = $shoplist;
            $data['status']= 'unchecked';
            $this->db->insert('pedidos', $data);
            $pedidoId=$this->db->insert_id();
            $this->session->unset_userdata('shopcar');
            echo $pedidoId;
        } else {
            echo 'fail';
        }
    }

}
