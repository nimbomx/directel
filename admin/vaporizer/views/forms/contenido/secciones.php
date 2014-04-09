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
    #canvasNP{
        padding: 15px;
    }
    .ui-state-highlight{
        float: left; margin: 5px;
        padding: 10px;
        cursor: pointer;
        min-width: 100px;
        height: 20px;
        border: #666 1px dashed;
        border-radius: 5px;
        text-align: center;
        background: #333;
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
    .formItem.dragable{
        border: #666 1px solid;
    }
    .formItem.dragable:hover{
        background: #666;
    }
    .formItem.bloqueado{
        padding-right: 30px;
        color: #666;
    }
    #loadMore{
        font-size: 14px;
        clear: both; padding:10px 30px;
    }
    .fixO{
        display: none;
    }
    .dragO{
        
    }
</style>
<?$webDB = $this->load->database('web', TRUE);
$secciones=$webDB->order_by('nombre','ASC')->get('secciones')->result();


       ?>         

<div id="optionsCanvas">
    <div class="topBar">

    <?  foreach ($secciones as $seccion):?>
    <div myId="<?=$seccion->clave?>" class="formItem" style=""><?=$seccion->nombre?></div>
    <?  endforeach;?>

    <div style="clear: both;"></div>
  
    </div>

            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1>SECCIONES</h1> 
                            Desde aqui podras crear/eliminar o editar las Secciones de Stratega Business Magazine.</div>
                <div style="float: right; margin: 30px;"><button onclick="openForm('crearSeccionCanvas');">NUEVA SECCIÓN</button></div>
                <div style="clear: both;"></div>
            </div>  
                    
    <div class="opciones">
       <!-- <h2>Opciones
        </h2>
        
        <div class="item"><a href="#" onclick="alert(); return false;">Ver ediciones pasadas</a></div>
        <div style="clear: both;"></div>
        <div id="canvasHistorico"></div>
       -->
    </div>
                    


            </div>

<div id="formCanvas">
    <div id="crearSeccionCanvas" class="formCanvas">
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="crearSeccion();">CREAR SECCIÓN</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Agregar una nueva sección.<br><br>
         <br><br>
         <label>Nombre:</label><input id="nNombre" placeholder='¿Que nombre tendrá la sección?'>
         <br><br>


     </div>
       </div>  
    
    

     <div id="editarSeccionCanvas" class="formCanvas">
       <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
           <button class="red" onclick="borrarSeccion();">ELIMINAR SECCIÓN</button><button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         <input type="hidden" id="nclaveE">
         Eliminar esta sección: "<span id="secNE"></span>"<br><br>

    </div>
</div>


<script>
    function crearSeccion(){
        nombre=(($('#nNombre').val()))
        $.post('<?=base_url('ownact/security/addSeccion')?>',{
            nombre:nombre,
            clave:makeClave(nombre)
        },function(){
            getForm('contenido','secciones');
        });
    }
    function borrarSeccion(){
        clave=(($('#nclaveE').val()))
        $.post('<?=base_url('ownact/security/delSeccion')?>',{
            clave:clave
        },function(){
            getForm('contenido','secciones');
        });
    }
     function activateItems(){
        $('.formItem').unbind('click').bind('click',function(){
            id=$(this).attr('myId');
            $('.formCanvas').fadeOut('fast');
            $.post('<?=base_url('actions/getWebJSON')?>',{tabla:'secciones',clave:'clave',valor:id},function(e){
               var obj = jQuery.parseJSON(e);
               $('#secNE').text(obj.nombre);
               $('#nclaveE').val(obj.clave);
                openForm('editarSeccionCanvas');
            });

        });
    }
    activateItems();

</script>

