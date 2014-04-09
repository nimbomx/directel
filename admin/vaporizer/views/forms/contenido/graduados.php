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
<?
$tabla='graduados';
$webDB = $this->load->database('web', TRUE);
$graduados=$webDB->order_by('nombre')->get($tabla);


       ?>         

<div id="optionsCanvas">
    <div class="topBar">
        <div style="clear: both;"></div>

    <?  foreach ($graduados->result() as $graduado):?>
    <div myId="<?=$graduado->id?>"  class="formItem" style=""><?=$graduado->nombre?></div>
    <?  endforeach;?>

    <div style="clear: both;"></div>
 
    </div>

            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1>GRADUADOS</h1> 
                            Desde aqui podras crear/eliminar o editar los Graduados del Tecmilenio.</div>
                <div style="float: right; margin: 30px;"><button onclick="openForm('crearArticuloCanvas');">NUEVO GRADUADO</button></div>
                <div style="clear: both;"></div>
            </div>  
                    
    <div class="opciones">
        <h2>Opciones
        </h2>
        <div class="item">
           
            <a href="<?=base_url('contenido/titulos')?>">Gestiona los titulos de los graduados</a>
        </div>

       
    </div>
                    


            </div>

<div id="formCanvas">
    <div id="crearArticuloCanvas" class="formCanvas">
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="crearArticulo();">CREAR ITEM</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Agregar un item.<br><br>
         <br><br>

         <label>Nombre:</label><input id="nNombre" placeholder='¿Cual es el nombre del Graduado?'>


     </div>
       </div>  
    
    
    <div id="editarArticuloCanvas" class="formCanvas">
       <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
           <button class="red" onclick="borrarArticulo();">ELIMINAR ARTÍCULO</button> <button onclick="editarArticulo();">GUARDAR CAMBIOS</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Editar o eliminar este item.<br><br>
         <input id="nIdE" type="hidden">
         <br><br>
        <label>Nombre:</label><input id="nNombreE" placeholder='¿Cual es el nombre del Graduado?'>

     </div>
    </div>
</div>


<script>

    function crearArticulo(){
        $.post('<?=base_url('ownact/addItem/graduados')?>',{
            nombre:$('#nNombre').val()

        },function(){
            getForm('contenido','graduados');
        });
    }
    function borrarArticulo(){
        if(confirm('¿Segur@ que desea eliminar este item?')){
            id=$('#nIdE').val();
            $.post('<?=base_url('ownact/delItem/graduados')?>',{id:id},function(){
                getForm('contenido','graduados');
            });
        }
    }
    function editarArticulo(){
        $.post('<?=base_url('ownact/editItem/graduados')?>',{
            id:$('#nIdE').val(),
            nombre:$('#nNombreE').val()
        },function(){
            getForm('contenido','graduados');
        });
    }

    function activateItems(){
        $('.formItem').unbind('click').bind('click',function(){
            id=$(this).attr('myId');
            $('.formCanvas').fadeOut('fast');
            $.post('<?=base_url('actions/getWebJSON')?>',{tabla:'<?=$tabla?>',clave:'id',valor:id},function(e){
               var obj = jQuery.parseJSON(e);
                $('#nIdE').val(obj.id);
                $('#nNombreE').val(obj.nombre);
                openForm('editarArticuloCanvas');
            });

        });
    }
    activateItems();

</script>

