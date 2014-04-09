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
    #canvasHistorico{
        padding: 15px;
    }
    .formItem{
        float: left; margin: 5px;
        padding: 10px;
        cursor: default;
        min-width: 100px;
        border: #353535 1px solid;
        border-radius: 5px;
        text-align: left;
    }
    .formItem .title{
        font-family: 'Roboto Condensed', sans-serif;
        color: #fff;
    }
    .formItem.bloqueado{
        padding-right: 30px;
        color: #666;
    }
    #loadMore{
        font-size: 14px;
        clear: both; padding:10px 30px;
    }
</style>
<?
$tabla='contacto';
$webDB = $this->load->database('web', TRUE);
$contacto=$webDB->get($tabla)->row();
 ?>         

<div id="optionsCanvas">
    <div class="topBar">
        <?if(trim($contacto->nombre)!=''){?>
        <div class="formItem" style=""><div class="title"> <?=$contacto->nombre?></div></div>
             <div style="clear: both;"></div>
        <?}?>
        <div class="formItem">
            <div class="title">Correo electrónico</div>
            <?=$contacto->email?>
        </div>
        <div class="formItem">
            <div class="title">Teléfono</div>
            <?=$contacto->telefono?>
        </div>
        <div class="formItem">
            <div class="title">Dirección</div>
            <?=$contacto->direccion?>
        </div>
    <div style="clear: both;"></div>
    
    <?if(trim($contacto->facebook)!=''){?>
    <div class="formItem">
            <div class="title">Facebook</div>
            <?=$contacto->facebook?>
        </div>
    <?}?>
    
    <?if(trim($contacto->twitter)!=''){?>
    <div class="formItem">
            <div class="title">Twitter</div>
            <?=$contacto->twitter?>
        </div>
    <?}?>
    
    <?if(trim($contacto->youtube)!=''){?>
    <div class="formItem">
            <div class="title">YouTube</div>
            <?=$contacto->youtube?>
        </div>
    <?}?>
    
    <?if(trim($contacto->google)!=''){?>
    <div class="formItem">
            <div class="title">Google +</div>
            <?=$contacto->google?>
        </div>
    <?}?>
    
    <?if(trim($contacto->linkedin)!=''){?>
    <div class="formItem">
            <div class="title">Linked In</div>
            <?=$contacto->linkedin?>
        </div>
    <?}?>
    
    <div style="clear: both;"></div>
    </div>

            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1>CONTACTO</h1> 
                            Desde aqui podras editar los Datos Generales de Contacto de WineCru.</div>
                <div style="float: right; margin: 30px;"><button onclick="openForm('editDataCanvas');">EDITAR DATOS</button></div>
                <div style="clear: both;"></div>
            </div>  
                    
    <div class="opciones">
        <?/*?><h2>Opciones</h2>
        <div class="item"><a href="#" onclick="loadHistorico(); return false;">Cargar el historico de noticias (<?=$noNews?>)</a></div>
        <div style="clear: both;"></div>
        <div id="canvasHistorico"></div>
        <?*/?>
    </div>
                    


            </div>

<div id="formCanvas">
    <div id="editDataCanvas" class="formCanvas">
        
    
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="editContacto();">GUARDAR CAMBIOS</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Modifica o agrega datos de contacto.<br><br>
         
         <br><br>
         <label>Nombre:</label><input id="cNombre" value="<?=$contacto->nombre?>" placeholder='Nombre del lugar de contacto'>
         <br><br>
         <label>Correo electrónico:</label><input id="cCorreo" value="<?=$contacto->email?>" placeholder=''>
         <br><br>
         <label>Teléfono:</label><input id="cTelefono" value="<?=$contacto->telefono?>" placeholder=''>
         <br><br>
         <label>Dirección:</label><textarea rows="6"  id="cDireccion"><?=$contacto->direccion?></textarea>
          <br><br>
          <label>Facebook:</label><input id="cFacebook" placeholder='' value="<?=$contacto->facebook?>">
         <br><br>
         <label>Twitter:</label><input id="cTwitter" placeholder='' value="<?=$contacto->twitter?>">
         <br><br>
         <label>Linked In:</label><input id="cLinkedin" placeholder='' value="<?=$contacto->linkedin?>">
         <br><br>
         <label>YouTube:</label><input id="cYoutube" placeholder='' value="<?=$contacto->youtube?>">
         <br><br>
     </div>
       </div>  

</div>


<script>


    function editContacto(){

        nombre=$('#cNombre').val();
        email=$('#cCorreo').val();
        telefono=$('#cTelefono').val();
        direccion=$('#cDireccion').val();
        facebook=$('#cFacebook').val();
        twitter=$('#cTwitter').val();
        linkedin=$('#cLinkedin').val();
        youtube=$('#cYoutube').val();
        $.post('<?=base_url('actions/editFlatItem/'.$tabla)?>',{nombre:nombre,email:email,telefono:telefono,direccion:direccion,facebook:facebook,twitter:twitter,linkedin:linkedin,youtube:youtube},function(e){
        getForm('contenido','contacto');
        });
    }

</script>

