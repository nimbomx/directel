<?
$NOMBRE='PROMOCIONES';
$NOMBRE_SING='PROMOCIÓN';
$nombre='promociones';
$nombre_sing='promoción';

$tabla='promociones';
$maxItems=7;
$webDB = $this->load->database('web', TRUE);
$items=$webDB->order_by('timestamp','DESC')->get($tabla,$maxItems,0)->result();
$noItemsRest=$webDB->get($tabla)->num_rows();
$noItemsRest-=$maxItems;

       ?>  
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
       

<div id="optionsCanvas">
    <div class="topBar">
    <?  foreach ($items as $item):?>
    <div myId="<?=$item->id?>"  class="formItem" style=""><?=$item->titulo?></div>
    <?  endforeach;?>
    <div style="clear: both;"></div>
    </div>

            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1><?=$NOMBRE?></h1> 
                            Desde aqui podras crear/eliminar o editar las <?=$nombre?> de WineCru.</div>
                <div style="float: right; margin: 30px;"><button onclick="openForm('crearItemCanvas');">NUEVA <?=$NOMBRE_SING?></button></div>
                <div style="clear: both;"></div>
            </div>  
                    
    <div class="opciones">
        <?if($noItemsRest>0){?><h2>Opciones</h2>
        <div class="item"><a href="#" onclick="loadHistorico(); return false;">Cargar el historico de <?=$nombre?> (<?=$noItemsRest?>)</a></div>
        <div style="clear: both;"></div>
        <div id="canvasHistorico"></div>
        <?}?>
    </div>
                    


            </div>

<div id="formCanvas">
    <div id="crearItemCanvas" class="formCanvas">
        
    
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="crearItem();">CREAR <?=$NOMBRE_SING?></button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Agregar botón a un menú.<br><br>
         
         <br><br>
         <label>Título:</label><input id="nTitulo" placeholder='¿Que título tendrá la <?=$nombre_sing?>?'>
         <br><br>
         <!--<label>Contenido:</label><textarea rows="6"  id="nContenido" placeholder="Redacta el cuerpo de la noticia."> </textarea>
          <br><br>-->
          <label style="float: left; margin-bottom: 10px;">Imágen:</label><br><br>
          
          <!-- -->
          <?
            
            $ancho=322;
            $alto=343;
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
    
    
    <div id="editarItemCanvas" class="formCanvas">
       <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
           <button class="red" onclick="borrarItem();">ELIMINAR <?=$NOMBRE_SING?></button> <button onclick="editarItem();">GUARDAR CAMBIOS</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Modicicar el contenido de esta <?=$nombre_sing?>.<br><br>
         <input id="nIdE" type="hidden">
         <br><br>
         <label>Título:</label><input id="nTituloE" placeholder='¿Que título tendrá la <?=$nombre_sing?>?'>
         <br><br>
         <!--<label>Contenido:</label><textarea rows="6"  id="nContenidoE" placeholder="Redacta el cuerpo de la <?=$nombre_sing?>."> </textarea>
          <br><br>-->
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
    var noHistoricos='<?=$noItemsRest?>';
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
    function crearItem(){
        titulo=$('#nTitulo').val();
        //contenido=$('#nContenido').val();
        contenido='';
        imagen=$('#nImagen').val();
        $.post('<?=base_url('actions/agregarItem/'.$tabla)?>',{titulo:titulo,contenido:contenido,imagen:imagen},function(){
            getForm('contenido','<?=$tabla?>');
        });
    }
    
    
    
    function editarItem(){
        id=$('#nIdE').val();
        titulo=$('#nTituloE').val();
        //contenido=$('#nContenidoE').val();
        contenido='';
        imagen=$('#nImagenE').val();
        $.post('<?=base_url('actions/editarItem/'.$tabla)?>',{titulo:titulo,contenido:contenido,imagen:imagen,id:id},function(e){
            getForm('contenido','<?=$tabla?>');
        });
    }
    
    function borrarItem(){
        if(confirm('¿Segur@ que desea eliminar esta <?=$nombre_sing?>?')){
            id=$('#nIdE').val();
            $.post('<?=base_url('actions/eliminarItem/'.$tabla)?>',{id:id},function(){
                getForm('contenido','<?=$tabla?>');
            });
        }
    }
    function activateItems(){
        $('.formItem').unbind('click').bind('click',function(){
            id=$(this).attr('myId');
            $('.formCanvas').fadeOut('fast');
            $.post('<?=base_url('actions/getWebJSON')?>',{tabla:'<?=$tabla?>',clave:'id',valor:id},function(e){
               var obj = jQuery.parseJSON(e);
                $('#nIdE').val(obj.id);
                $('#nTituloE').val(obj.titulo);
                $('#nContenidoE').val(obj.contenido);
                if(obj.imagen!=='')$('#imgPrevE').html('<img src="<?=web_url('recursos/'.$tabla)?>/'+obj.imagen+'">');
                else $('#imgPrevE').html('');
                openForm('editarItemCanvas');
            });

        });
    }
    activateItems();

    function loadHistorico(no){
    var limite=10;
        if((no)){
            $('#loadMore').remove();
            desde=no; 
        }else{
             $('#canvasHistorico').html('cargando...');
             desde=<?=$maxItems?>;
             no=<?=$maxItems?>;
        }
        $.post('<?=base_url('actions/getWebHistoricoJSON')?>',{tabla:'<?=$tabla?>',desde:desde,limite:limite},function(e){
            var obj = jQuery.parseJSON(e);
             var recibidos=(obj.length);
             if(no==<?=$maxItems?>)$('#canvasHistorico').html('');
             for(var i=0;i<recibidos;i++){
                 $('#canvasHistorico').append('<div myId="'+obj[i].id+'" class="formItem">'+obj[i].titulo+'</div>');
             }
             activateItems();
             var faltan=(((noHistoricos*1)+<?=$maxItems?>)-(recibidos+no));
             if (faltan>limite)faltan=limite;
             var index=limite+no;
             if(faltan>0){
                 $('#canvasHistorico').append(' <div id="loadMore"><a href="#" onclick="loadHistorico('+index+'); return false;">Cargar '+faltan+' más</a></div>');
             }
             
             //if(recibidos)
        });

    }
</script>

