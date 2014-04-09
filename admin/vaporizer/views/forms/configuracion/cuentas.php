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
        display: inline;
        clear: none;
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
    .gIt{
        float: left; margin: 5px;
        padding: 10px;
        cursor: pointer;
        max-width: 200px;
        min-width: 100px;
        height: 20px;
        border: #353535 1px solid;
        border-radius: 5px;
        text-align: center;
    }
    .formItem{
        float: left; margin: 5px;
        padding: 10px;
        cursor: pointer;
        /*max-width: 200px;*/
        min-width: 100px;
        height: 20px;
        border: #353535 1px solid;
        border-radius: 5px;
        text-align: center;
    }
    .formItem.bloqueado{
        padding-right: 30px;
        color: #666;
    }
    #opcionesCanvas{
        padding: 0px 30px;
    }
</style>
<?/*$webDB = $this->load->database('web', TRUE);
                $webDB->update('contacto',$_POST);*/
                
$cuentas=$this->db->get_where('usuarios',array('nivel'=>1))->result();?>  

<div id="optionsCanvas">
    <div class="topBar">
    <?  foreach ($cuentas as $cuenta):?>
    <div myId="<?=$cuenta->id?>"  class="formItem <?if($this->session->userdata('id')==$cuenta->id)echo 'bloqueado'?>" style=""><?=$cuenta->nick?></div>
    <?  endforeach;?>
    <div style="clear: both;"></div>
    </div>

            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1>CUENTAS</h1> 
                            Desde aqui podras crear cuentas de acceso a Reeld O.</div>
                <div style="float: right; margin: 30px;"><button onclick="openForm('crearCuentaCanvas');">CREAR CUENTA</button></div>
                <div style="clear: both;"></div>
            </div>  
                    
    <div class="opciones">
        <h2>Opciones</h2>
        <div class="item"><a href="#" onclick="openForm('crearPerfilCanvas'); return false;">Crear perfil de acceso</a></div>
         <div class="item"><a href="#" onclick="loadPA(); return false;">Editar perfiles de acceso</a></div>
        <div id="opcionesCanvas" style="clear: both;">
            
        </div>
        <div style="clear: both;"></div>
        
    </div>
                    


            </div>

<div id="formCanvas">
    <div id="crearCuentaCanvas" class="formCanvas">
        
    
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="crearCuenta();">CREAR CUENTA</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Agregar botón a un menú.<br><br>
         
         <br><br>
         Correo electrónico: <input id="email" placeholder='¿A qué correo deseas vincular la cuenta?'>
         <br><br>
         Definir contraseña temporal: <input id="tmpPass" placeholder="Contraseña"> <br>
          <small>(Si no se define una contraseña el sistema generara una aleatoriamente.)</small>
          <br><br>
          Elegir un perfil de acceso <select id="pa"><option value='' disable selected>Elige un perfil</option>
              <?foreach($this->db->get('perfil_acceso')->result() as $pa):?>
              <option value="<?=$pa->nombre?>"><?=$pa->nombre?></option>
              <?  endforeach;?>
          </select>
          <br><br>
         <!--<input type="checkbox" > <small>Elegir acceso a secciones manualmente.</small>-->
     </div>
       </div>  
    
    <div id="crearPerfilCanvas" class="formCanvas">
        
    
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="crearPerfil();">CREAR PERFIL DE ACCESO</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Crear un perfil de acceso, eligiendo las secciones a las que podrá tener acceso.<br><br>
        
         
         <br><br>
         Nombre: <input id="perfilName" placeholder='¿Que nombre tendrá este perfil?'>
         <br><br>
        <?
        $seccionN='';
        foreach($this->db->get_where('menues',array('seccion !='=>'desarrollo'))->result() as $seccion):?>
         <?
         if($seccionN!=$seccion->seccion){
             $seccionN=$seccion->seccion;
         echo '<div style="clear:both;">'.$seccionN.'</div>';}
         ?>
         <div style="float: left; margin: 10px;"><input class="seccPA" type="checkbox" idSec='<?=$seccion->id?>' ><?=$seccion->nombre?></div>
         <?  endforeach;?>
     </div>
       </div>  
    
        <div id="editarPerfilCanvas" class="formCanvas">
        
    
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button class="red" onclick="eliminarPerfil();">ELIMINAR PERFIL DE ACCESO</button> <button onclick="editarPerfil();">GUARDAR CAMBIOS</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
          Editar éste perfil de acceso, eligiendo las secciones a las que podrá tener acceso.<br><br>
         <input type="hidden" id="perfilIdE">
         <br><br>
         Nombre: <input id="perfilNameE" placeholder='¿Que nombre tendrá este perfil?'>
         <br><br>
        <?
        $seccionNE='';
        foreach($this->db->get_where('menues',array('seccion !='=>'desarrollo'))->result() as $seccion):?>
         <?
         if($seccionNE!=$seccion->seccion){
             $seccionNE=$seccion->seccion;
         echo '<div style="clear:both;">'.$seccionNE.'</div>';}
         ?>
         <div style="float: left; margin: 10px;"><input class="seccPAE" type="checkbox" idSec='<?=$seccion->id?>' ><?=$seccion->nombre?></div>
         <?  endforeach;?>
     </div>
       </div>  
    
    <div id="editarCuentaCanvas" class="formCanvas">
       <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
           <button class="red" onclick="delCuenta();">ELIMINAR CUENTA</button> <button onclick="editCuenta();">GUARDAR CAMBIOS</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Agregar botón a un menú.<br><br>
         <input id="idE" type="hidden">
         <br><br>
         Correo electrónico: <input id="emailE" placeholder='¿A qué correo deseas vincular la cuenta?'>
         <br><br>
         Definir contraseña temporal: <input id="tmpPassE" placeholder="Contraseña"> <br>
          <small>(Si no se define una contraseña el sistema generara una aleatoriamente.)</small>
          <br><br>
          Elegir un perfil de acceso <select id="paE"><option value='' disable selected>Elige un perfil</option>
              <?foreach($this->db->get('perfil_acceso')->result() as $pa):?>
              <option value="<?=$pa->nombre?>"><?=$pa->nombre?></option>
              <?  endforeach;?>
          </select>
          <br><br>
         <!--<input type="checkbox" > <small>Elegir acceso a secciones manualmente.</small>-->
     </div>
    </div>
</div>


<script>
    function editCuenta(){
        id=$('#idE').val();
        email=$('#emailE').val();
        tmpPass=$('#tmpPassE').val();
        pa=$('#paE').val();
        $.post('<?=base_url('actions/editarCuenta')?>',{pa:pa,email:email,tmpPass:tmpPass,id:id},function(){
            getForm('configuracion','cuentas');
        });
    }
    function crearCuenta(){
        email=$('#email').val();
        tmpPass=$('#tmpPass').val();
        pa=$('#pa').val();
        $.post('<?=base_url('actions/crearCuenta')?>',{pa:pa,email:email,tmpPass:tmpPass},function(){
            getForm('configuracion','cuentas');
        });
    }
    function delCuenta(){
        if(confirm('¿Segur@ que desea eliminar esta cuenta?')){
            id=$('#idE').val();
            $.post('<?=base_url('actions/eliminarCuenta')?>',{id:id},function(){
                getForm('configuracion','cuentas');
            });
        }
    }
   
    $('.formItem').unbind('click').bind('click',function(){
        
        id=$(this).attr('myId');
        $('.formCanvas').fadeOut('fast');
        $.post('<?=base_url('actions/getJson')?>',{tabla:'usuarios',clave:'id',valor:id},function(e){
           var obj = jQuery.parseJSON(e);
            $('#idE').val(obj.id);
            $('#emailE').val(obj.nick);
            $('#tmpPassE').val(obj.tmpPass);
            if(obj.pa===''){
                $('#paE option:eq(0)').attr('selected','selected');
            }else{
                $('#paE option').each(function(){
                    if($(this).val()===obj.pa){
                        $(this).attr('selected','selected');
                    }else{
                        $(this).removeAttr('selected');
                    };
                });
            }
            openForm('editarCuentaCanvas');
        });
        
    });
    
    
 /*EDITAR PERFIL DE USUARIO*/
  function crearPerfil(){
        nombre=$('#perfilName').val();
        accesos=[];
        $('.seccPA').each(function(){
           if($(this).is(':checked')){
               accesos.push($(this).attr('idSec'));
           } 
        });
      
        $.post('<?=base_url('actions/crearPerfilAcceso')?>',{nombre:nombre,accesos:accesos.join()},function(e){
            getForm('configuracion','cuentas');
        });
    }
      function editarPerfil(){
          id=$('#perfilIdE').val();
        nombre=$('#perfilNameE').val();
        accesos=[];
        $('.seccPAE').each(function(){
           if($(this).is(':checked')){
               accesos.push($(this).attr('idSec'));
           } 
        });
      
        $.post('<?=base_url('actions/editrPerfilAcceso')?>',{id:id,nombre:nombre,accesos:accesos.join()},function(e){
            getForm('configuracion','cuentas');
        });
    }
    function eliminarPerfil(){
          id=$('#perfilIdE').val();
        $.post('<?=base_url('actions/eliminarPerfilAcceso')?>',{id:id},function(e){
            getForm('configuracion','cuentas');
        });
    }
 function activateItems(c){
    $('.'+c).unbind('click').bind('click',function(){
        id=$(this).attr('myId');
        $('.formCanvas').fadeOut('fast');
        $.post('<?=base_url('actions/getJson')?>',{tabla:'perfil_acceso',clave:'id',valor:id},function(e){
            var obj = jQuery.parseJSON(e);
            $('#perfilIdE').val(obj.id);
            $('#perfilNameE').val(obj.nombre);
            accesosA=obj.accesos.split(',');

            for(var i=0;i<accesosA.length;i++){
                $('.seccPAE[idSec="'+accesosA[i]+'"]').attr('checked','checked');
            }
            openForm('editarPerfilCanvas');
        });
    });
 };
 function loadPA(){
    table='perfil_acceso';
    canvas='opcionesCanvas';
    itemname='PAItem';
    $('#'+canvas).html('cargando...');
    $.post('<?=base_url('actions/getFullJSON')?>/'+table,function(e){
        var obj = jQuery.parseJSON(e);
        var recibidos=(obj.length);
        $('#'+canvas).html('');
        for(var i=0;i<recibidos;i++){
            $('#'+canvas).append('<div myId="'+obj[i].id+'" class="gIt '+itemname+'">'+obj[i].nombre+'<br></div>');
        }
        activateItems(itemname);
    });
    }
</script>

