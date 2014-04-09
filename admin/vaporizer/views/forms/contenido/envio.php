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
        cursor: pointer;
        min-width: 100px;
        border: #353535 1px solid;
        border-radius: 5px;
        text-align: center;
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
<?$webDB = $this->load->database('web', TRUE);
$envios=$webDB->get('envio')->result();

       ?>         

<div id="optionsCanvas">
    <div class="topBar">
    <?  foreach ($envios as $envio):?>
        <div myId="<?=$envio->id?>"  class="formItem" style=""><?=$envio->nombre?><br><small>$<?=  number_format($envio->precio)?></small></div>
    <?  endforeach;?>
    <div style="clear: both;"></div>
    </div>

            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1>TIPOS DE ENVÍO</h1> 
                            Desde aqui podras crear, eliminar o editar los tipos de envío y su costo.</div>
                <div style="float: right; margin: 30px;"><button onclick="openForm('crearEnvioCanvas');">NUEVO TIPO DE ENVÍO</button></div>
                <div style="clear: both;"></div>
            </div>  
                    
    <div class="opciones">

    </div>
                    


            </div>

<div id="formCanvas">
    <div id="crearEnvioCanvas" class="formCanvas">
        
    
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="crearEnvio();">CREAR TIPO DE ENVÍO</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Agregar tipo de envío.<br><br>
         
         <br><br>
         <label>Nombre:</label><input id="nNombre" placeholder='¿Que nombre tendrá el tipo de envío?'>
         <br><br>
         <label>Precio:</label>$ <input id="nPrecio" placeholder='¿Que precio tendrá el tipo de envío?'>
         <br><br>

     </div>
       </div>  
    
    
    <div id="editarEnvioCanvas" class="formCanvas">
       <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
           <button class="red" onclick="borrarEnvio();">ELIMINAR TIPO DE ENVÍO</button> <button onclick="editarEnvio();">GUARDAR CAMBIOS</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Editar tipo de envío.<br><br>
         <input id="nIdE" type="hidden">
         <br><br>
         <label>Nombre:</label><input id="nNombreE" placeholder='¿Que nombre tendrá el tipo de envío?'>
         <br><br>
         <label>Precio:</label>$ <input id="nPrecioE" placeholder='¿Que precio tendrá el tipo de envío?'>
         <br><br>

     </div>
    </div>
</div>


<script>

    function crearEnvio(){
        nombre=$('#nNombre').val();
        precio=$('#nPrecio').val();
        $.post('<?=base_url('actions/agregarFlatItem/envio')?>',{nombre:nombre,precio:precio},function(e){
            getForm('contenido','envio');
        });

    }
    
    
    
    function editarEnvio(){
        id=$('#nIdE').val();
        nombre=$('#nNombreE').val();
        precio=$('#nPrecioE').val();
        $.post('<?=base_url('actions/editarFlatItemId/envio')?>',{nombre:nombre,precio:precio,id:id},function(e){
            getForm('contenido','envio');
        });
    }
    
    function borrarEnvio(){
        if(confirm('¿Segur@ que desea eliminar este tipo de envío?')){
            id=$('#nIdE').val();
            $.post('<?=base_url('actions/eliminarItem/envio')?>',{id:id},function(){
                getForm('contenido','envio');
            });
        }
    }
    function activateItems(){
        $('.formItem').unbind('click').bind('click',function(){
            id=$(this).attr('myId');
            $('.formCanvas').fadeOut('fast');
            $.post('<?=base_url('actions/getWebJSON')?>',{tabla:'envio',clave:'id',valor:id},function(e){
               var obj = jQuery.parseJSON(e);
                $('#nIdE').val(obj.id);
                $('#nNombreE').val(obj.nombre);
                $('#nPrecioE').val(obj.precio);
                openForm('editarEnvioCanvas');
            });

        });
    }
   activateItems();

  
</script>

