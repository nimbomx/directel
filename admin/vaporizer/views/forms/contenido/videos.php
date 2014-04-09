<style>

    .formCanvas{
        display: none;
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
    .highBar{
        position: relative;
        height: 161px;
        padding: 0px;
        overflow: auto;
    }
    .topBar{
        top: 161px;
        bottom: 0px;
        overflow: auto;
        position: absolute;
        padding: 10px 0px;
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
        float: left; 
        padding: 2px 10px;
        cursor: pointer;
        min-width: 260px;
        width: 260px;
        border: #353535 1px solid;
        border-radius: 5px;
        text-align: left;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
            margin: 2px 5px;
    }
    .formItem:hover{

        width: auto;
        border: #353535 1px solid;
        border-radius: 5px;
        text-align: left;
        text-overflow: clip;
        overflow: visible;
        background: #666;
            
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
$videos=$webDB->order_by('archivo','ASC')->get('video')->result();


       ?>         

<div id="optionsCanvas">
    <div class="highBar" style="padding: 0;">
        <table style="width: 100%; height: 100%;"><tr>
                <td style="padding: 0px 60px;">
                    <div style="float: left; margin-bottom: 20px;"><h1>VIDEOS</h1> 
                            Desde aqui podras crear/eliminar o editar las Entradas de Video.</div>
                <div style="float: right; "><button onclick="openForm('crearEdicionCanvas');">NUEVA ENTRADA</button></div>
                <div style="clear: both;"></div>
        </table>
                </td>
            </tr>
                
            </div>  
    <div class="topBar">

    <?  foreach ($videos as $video):?>
    <div myId="<?=$video->id?>" class="formItem" style=""><?=$video->archivo?></div>
    <?  endforeach;?>

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
    <div id="crearEdicionCanvas" class="formCanvas">
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="crearEdicion();">CREAR ENTRADA</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Agregar una nueva entrada.<br><br>
         <br><br>
         <label>Nombre:</label><input id="nNombre" >
         <br><br>
         <label>Área:</label><input id="nSeccion" >
         <br><br>
         <label>Carrera:</label><input id="nSerie" >
         <br><br>
         <label>Archivo:</label><input id="nArchivo" >
         <br><br>
          <label style="float: left; margin-bottom: 10px;">Poster:</label><br><br>
          
          <!-- -->
          <?
            $tabla='video';
            $ancho=600;
            $alto=307;
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
$data['allow']='img';
$data['fileLimit']=true;
$this->load->view('compartidos/dragUpload',$data);
?>
          </div>
            <div id="imgPrev" style="margin-top: 20px;"></div>
            </div>
            <!-- -->
          
     </div>
       </div>  
    
    

<div id="editarEdicionCanvas" class="formCanvas">
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button class="red" onclick="eliminarEdicion();">ELIMINAR ENTRADA</button> <button onclick="editarEdicion();">GUARDAR CAMBIOS</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Editar entrada.<br><br>
         <br><br>
         <input id="nIdE" type="hidden">
         <label>Nombre:</label><input id="nNombreE" >
         <br><br>
         <label>Área:</label><input id="nSeccionE" >
         <br><br>
         <label>Carrera:</label><input id="nSerieE" >
         <br><br>
         <label>Archivo:</label><input id="nArchivoE" >
         <br><br>
          <label style="float: left; margin-bottom: 10px;">Poster:</label><br><br>
          
          <!-- -->

          <div style=" text-align: center;">
          <input id="nImagenE" type="hidden">
          <div style="width: 312px; margin: auto;">
<?
$data['titulo']='+ Agregar imagen ('.$ancho.' x '.$alto.')';
$data['accion']='upload/upimgtmp';
$data['onComplete']='printImg("E")';
$data['tablas']='tableImgE';
$data['id']='upImgE';
$data['allow']='img';
$data['fileLimit']=true;
$this->load->view('compartidos/dragUpload',$data);
?>
          </div>
            <div id="imgPrevE" style="margin-top: 20px;"></div>
            </div>
            <!-- -->

     </div>
       </div>  
    
    



<script>
    function crearEdicion(){
        $.post('<?=base_url('ownact/addVideo')?>',{

            nombre:$('#nNombre').val(),
            archivo:$('#nArchivo').val(),
            seccion:$('#nSeccion').val(),
            serie:$('#nSerie').val(),
            poster:$('#nImagen').val()
        },function(){
            getForm('contenido','videos');
        });
    }
    function editarEdicion(){
        $.post('<?=base_url('ownact/editVideo')?>',{
            id:$('#nIdE').val(),
             nombre:$('#nNombreE').val(),
            archivo:$('#nArchivoE').val(),
            seccion:$('#nSeccionE').val(),
            serie:$('#nSerieE').val(),
            poster:$('#nImagenE').val()
        },function(){
            getForm('contenido','videos');
        });
    }
    function eliminarEdicion(){
        if(confirm('¿Segur@ que desea eliminar esta entrada de video?')){
            $.post('<?=base_url('ownact/security/delVideo')?>',{
                id:$('#nIdE').val()
            },function(){
                getForm('contenido','videos');
            });
        }
    }
     function activateItems(){
        $('.formItem').unbind('click').bind('click',function(){
            id=$(this).attr('myId');
            $('.formCanvas').fadeOut('fast');
            $.post('<?=base_url('actions/getWebJSON')?>',{tabla:'video',clave:'id',valor:id},function(e){
               var obj = jQuery.parseJSON(e);
               $('#nIdE').val(obj.id);
               $('#nNombreE').val(obj.nombre);
               $('#nSeccionE').val(obj.seccion);
               $('#nSerieE').val(obj.serie);
               $('#nArchivoE').val(obj.archivo);
               if(obj.poster!=='')$('#imgPrevE').html('<img src="<?=web_url('recursos/video')?>/'+obj.poster+'">');
                else $('#imgPrevE').html('');
                openForm('editarEdicionCanvas');
            });

        });
    }
    activateItems();

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
</script>

