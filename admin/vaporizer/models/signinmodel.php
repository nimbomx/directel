<?php
class Signinmodel extends CI_Model {

    /*var $title   = '';
    var $content = '';
    var $date    = '';*/

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function logIn(){
        $nick=$_POST['nick'];
        $clave=($_POST['clave']);
        $recordar='n';
        if(isset($_POST['recordar']))$recordar='y';
        $centinela=new Centinela(FALSE);
        $centinela->login($nick, $clave, $recordar);
        redirect(base_url());
    }
    function logOut(){
        $centinela=new Centinela(FALSE);
        $centinela->logout();
        redirect(base_url());
    }
}
?>