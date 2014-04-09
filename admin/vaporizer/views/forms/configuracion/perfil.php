

<style>
    .formCanvas{
        display: none;
    }
    .highBar{
        position: relative;
        
    }
    .opciones{

    }
    .opciones h2{
        font-size: 16px;
        line-height: 16px;
        font-weight: normal;
        margin-left: 30px;
        margin-bottom: 0px;
    }
    .opciones .item{
        float: left; 
        margin: 10px 30px;
    }
    .opciones .item a{
        font-size: 14px;
        background: none;
    }
    .opciones .item:hover{
        background: none;
    }
    .topBar{
        padding: 15px;
    }
    .formItem{
        float: left; margin: 5px;
        padding: 10px;
        max-width: none;
        min-width: fit-content;
        width: auto;
        height: 150px;
        /*border: #353535 1px solid;
        border-radius: 5px;*/
        text-align: center;
        position: relative;
    }
    .pFormItem{
        float: left; margin: 5px;
        padding: 10px;
        min-width: 100px;
        /*border: #353535 1px solid;
        border-radius: 5px;*/
        text-align: center;
        position: relative;
        text-align: left;
    }

    p.red{
        color: #E68F8F;
        font-size: 14px;
        text-align: justify;
    }
    .formItem .title{
        font-family: 'Roboto Condensed', sans-serif;
        color: #fff;
        
    }
    input{
        margin-left: 10px;
    }
</style>
<?/*$webDB = $this->load->database('web', TRUE);
                $webDB->update('contacto',$_POST);*/
                
$perfil=$this->db->get_where('perfil',array('id'=>$this->session->userdata('id')))->row() ;
$pa=$this->db->get_where('usuarios',array('id'=>$this->session->userdata('id')))->row()->pa;
if($pa=='')$pa='Sin perfil de acceso'
?> 
<div id="optionsCanvas">
    <div class="topBar">

        <?if($perfil->avatar!=''){?><div class="formItem" style="border: #444 1px solid;
        border-radius: 5px; margin-right: 30px;"><img src="<?=web_url('res/avatar/'.$perfil->avatar)?>"></div><?}else{?>
        <div class="formItem" style="border: #444 1px dashed; width: 150px;
        border-radius: 5px; margin-right: 30px;"></div>
            <?}?>
        <div style="clear: both;"></div>
        <div class="pFormItem" ><div class="title">ALIAS</div><?=$perfil->nick?></div>
        <div class="pFormItem" ><div class="title">CORREO ELECTRÓNICO</div><?=$perfil->correo?></div>
        <div class="pFormItem" ><div class="title">PERFIL DE ACCESO</div><?=$pa?></div>
        <div class="pFormItem" ><div class="title">FECHA DE CREACIÓN</div><?=$perfil->timestamp?></div>
    <div style="clear: both;"></div>
    </div>

            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1>PERFIL</h1> 
                    <?if($this->session->userdata('passTmp')){?>
                    <p class="red"> Su contraseña actual fue generada provisionalmente, es recomendable cambiarla por una de su elección.</p> <button class="red" onclick="openForm('cambiarPasswordCanvas'); return false;">CAMBIA TU CONTRASEÑA TEMPORAL</button><br>
<?}else{?>
Cambia tu contraseña o personaliza tu perfil.<?}?></div>
                <div style="float: right; margin: 30px;"><button onclick="openForm('crearCuentaCanvas');">EDITAR PERFIL</button></div>
                <div style="clear: both;"></div>
            </div>  
                    
    <div class="opciones">
        <h2>Opciones</h2>
        <div class="item"><a href="#" onclick="openForm('cambiarPasswordCanvas'); return false;">Cambiar contraseña</a></div>
       
        <div id="opcionesCanvas" style="clear: both;">
            
        </div>
        <div style="clear: both;"></div>
    </div>
                    


            </div>

<div id="formCanvas">
    <div id="crearCuentaCanvas" class="formCanvas">
        
    
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="editarPerfil();">GUARDAR CAMBIOS</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Personaliza tu cuenta.<br><br>
         
         <br><br>
         Avatar: <span>Por el momento no puedes cambiar tu avatar, ¡lo sentimos!</span><br><br>
         Alias: <input id="alias" value="<?=$perfil->nick?>" placeholder='¿Como quieres que el sistema te llame?'><br><br>
         Correo electrónico: <span>ejemplo@sdad.c</span>
         <br><br>
         
     </div>
       </div>  
    
    
    <div id="cambiarPasswordCanvas" class="formCanvas">
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="cambiarContrasenia();">CAMBIAR CONTRASEÑA</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Cambia tu contraseña de acceso.<br><br>
         
         <br><br>
         Clave actual: <input id="currentPass" type="password" placeholder='Ingresa la clave con la que iniciaste sesión.'>
         <br><br>
         Nueva clave: <input id="newPass" type="password" placeholder='Ingresa la que sera tu nueva clave.'>
         <br><br>
         Confirmación: <input id="confPass" type="password" placeholder='Vuelve a escribir tu nueva clave.'>
         <br><br>
     </div>
     </div>  
    

</div>


<script>
    function editarPerfil(){
        alias=$('#alias').val();
        $.post('<?=base_url('actions/editarPerfil')?>',{alias:alias},function(){
            getForm('configuracion','perfil');
        });
    }
    function cambiarContrasenia(){
        oldP=$('#currentPass').val();
        newP=$('#newPass').val();
        confP=$('#confPass').val();
        if(trim(oldP)===''){
            alert('Debes ingresar tu actual contraseña');
            return false;
        }
        if(trim(newP)===''){
            alert('Debes ingresar una nueva contraseña');
            return false;
        }
        if(trim(newP)!==trim(confP)){
            alert('Ups!, tu contraseña no coincide con su confirmación');
            $('#newPass').val('').focus();
            $('#confPass').val('');
            return false;
        }
        $.post('<?=base_url('actions/cambiarPass')?>',{oldP:oldP,newP:newP},function(e){
            if(e=='ok'){
                alert('Tu contraseña ha sido cambiada,\n deberas acceder con tu nueva contraseña.');
                location.reload(true);
            }else{
                alert('Tu contraseña actual no coincide,\n revisala e intentalo nuevamente.');
                $('#oldPass').val('').focus();
                $('#newPass').val('');
                $('#confPass').val('');
            }
            //getForm('configuracion','perfil');
        });
    }
</script>

