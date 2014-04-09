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
$eventos=$webDB->order_by('order','ASC')->get_where('eventos')->result();


       ?>         

<div id="optionsCanvas">
    <div class="topBar">
        <div style="clear: both;"></div>
        <div class="sortable">
    <?  foreach ($eventos as $evento):?>
    <div myId="<?=$evento->id?>" order="<?=$evento->order?>"  class="formItem" style=""><?=$evento->titulo?></div>
    <?  endforeach;?>
        </div>
    <div style="clear: both;"></div>
    <div style="padding: 0px 20px; font-size: 14px;"><a class="dragO" href="#" onclick="enableDrag(); return false;">Cambiar de orden</a><a class="fixO" href="#" onclick="disableDrag(); return false;">Fijar orden</a></div>
    </div>

            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1>EVENTOS</h1> 
                            Desde aqui podras crear/eliminar o editar los Eventos de Stratega Business Magazine.</div>
                <div style="float: right; margin: 30px;"><button onclick="openForm('crearArticuloCanvas');">NUEVO EVENTO</button></div>
                <div style="clear: both;"></div>
            </div>  
                    
    <div class="opciones">

       
    </div>
                    


            </div>

<div id="formCanvas">
    <div id="crearArticuloCanvas" class="formCanvas">
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="crearArticulo();">CREAR EVENTO</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Agregar un evento.<br><br>
         <br><br>
         <label>Título:</label><input id="nTitulo" placeholder='¿Que título tendrá el evento?'>
         <br><br>
         <label>Balazo:</label><textarea rows="6"  id="nBalazo"> </textarea>
         <br><br>
         <label>Contenido:</label><textarea rows="6"  id="nContenido"> </textarea>
          <br><br>
          <label style="float: left; margin-bottom: 10px;">Imagen:</label><br><br>
          
          <!-- -->
          <?
            $tabla='eventos';
            $ancho=575;
            $alto=480;
          ?>
          <div style=" text-align: center;">
          <input id="nImagen" type="hidden">
          <div style="width: 312px; margin: auto;">
<?
$data['titulo']='+ Agregar imagen ('.$ancho.' x '.$alto.')';
$data['accion']='upload/upimgtmp';
$data['onComplete']='printImg()';
$data['tablas']='tableImg';
$data['id']='upImg';
$data['fileLimit']=true;
$this->load->view('compartidos/dragUpload',$data);
?>
          </div>
            <div id="imgPrev" style="margin-top: 20px;"></div>
            </div>
            <!-- -->

     </div>
       </div>  
    
    
    <div id="editarArticuloCanvas" class="formCanvas">
       <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
           <button class="red" onclick="borrarArticulo();">ELIMINAR EVENTO</button> <button onclick="editarArticulo();">GUARDAR CAMBIOS</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Editar o eliminar este evento.<br><br>
         <input id="nIdE" type="hidden">
         <br><br>
        
         <label>Título:</label><input id="nTituloE" placeholder='¿Que título tendrá el artículo?'>
         <br><br>
         <label>Balazo:</label><textarea rows="4"  id="nBalazoE"> </textarea>
         <br><br>
         <label>Contenido:</label><textarea rows="6"  id="nContenidoE" placeholder="Redacta el cuerpo del artículo."> </textarea>
          <br><br>
          <label style="float: left; margin-bottom: 10px;">Imagen:</label><br><br>
          
          <!-- -->

          <div style=" text-align: center;">
          <input id="nImagenE" type="hidden">
          <div style="width: 312px; margin: auto; ">
<?
$data['titulo']='+ Agregar imagen ('.$ancho.' x '.$alto.')';
$data['accion']='upload/upimgtmp';
$data['onComplete']='printImg("E")';
$data['tablas']='tableImgE';
$data['id']='upImgE';
$data['fileLimit']=true;
$this->load->view('compartidos/dragUpload',$data);
?>
          </div>
            <div id="imgPrevE" style="margin-top: 20px;"></div>
            </div>
            <!-- -->

     </div>
    </div>
</div>


<script>

        var printImg = function (type){
    if(!type)type='';
    file= ($('#tableImg'+type+'D tr:first').text()); 
       $('#tableImg'+type+'D tr').remove();
       $.post('<?=base_url('upload/resize')?>',{
           file:file,
           quality:90,
           ancho:<?=$ancho?>,
           alto:<?=$alto?>,
           noblack:1
           //nodel:true
       },function(e){
           $('#nImagen'+type).val(e);
            $('#imgPrev'+type).html('<img src="<?=web_url('recursos/tmp/resized')?>/'+e+'">');
       });
    };
    function crearArticulo(){
        $.post('<?=base_url('ownact/addEvento')?>',{
            titulo:$('#nTitulo').val(),
            balazo:$('#nBalazo').val(),
            contenido:$('#nContenido').val(),
            imagen:$('#nImagen').val()
        },function(){
            getForm('contenido','eventos');
        });
    }
    function borrarArticulo(){
        if(confirm('¿Segur@ que desea eliminar este evento?')){
            id=$('#nIdE').val();
            $.post('<?=base_url('ownact/delEvento')?>',{id:id},function(){
                getForm('contenido','eventos');
            });
        }
    }
    function editarArticulo(){
        destacado=0;
        if($('#nDestacadoE').is(':checked'))destacado=1;
        $.post('<?=base_url('ownact/editEvento')?>',{
            id:$('#nIdE').val(),
            titulo:$('#nTituloE').val(),
            balazo:$('#nBalazoE').val(),
            contenido:$('#nContenidoE').val(),
            imagen:$('#nImagenE').val()
        },function(){
            getForm('contenido','eventos');
        });
    }

    function activateItems(){
        $('.formItem').unbind('click').bind('click',function(){
            
            if($('.formItem').is('.dragable')) return false;
            id=$(this).attr('myId');
            $('.formCanvas').fadeOut('fast');
            $.post('<?=base_url('actions/getWebJSON')?>',{tabla:'<?=$tabla?>',clave:'id',valor:id},function(e){
               var obj = jQuery.parseJSON(e);
                $('#nIdE').val(obj.id);
                $('#nTituloE').val(obj.titulo);
                $('#nBalazoE').val(obj.balazo);
                $('#nContenidoE').val(obj.contenido);

                if(obj.imagen!=='')$('#imgPrevE').html('<img src="<?=web_url('recursos/eventos')?>/'+obj.imagen+'">');
                else $('#imgPrevE').html('');
                openForm('editarArticuloCanvas');
            });

        });
    }
    activateItems();


    function updateOrder(){
    
        $('.sortable .formItem').each(function(e){
            if($(this).attr('order')!=(e+1)){
                
                id=$(this).attr('myId');
                order=(e+1)
                $.post('<?=base_url('ownact/security/orderEvento')?>',{id:id,order:order});
            }
           
        })
    }
    $( ".sortable" ).sortable({
        placeholder: "ui-state-highlight"
               /* update:
               * start: function( event, ui ) {},
                stop: function( event, ui ) {alert('change')}*/
    });
    $( ".sortable" ).disableSelection();
     $('.sortable').sortable('disable');
    function enableDrag(){
         $('.sortable').sortable('enable');
        $( ".dragO" ).hide();
        $( ".fixO" ).show();
        $('.formItem').addClass('dragable');
    }
    function disableDrag(){
        updateOrder();
        $('.sortable').sortable('disable');
        $( ".dragO" ).show();
        $( ".fixO" ).hide();
         $('.formItem').removeClass('dragable');
    }
    
</script>

