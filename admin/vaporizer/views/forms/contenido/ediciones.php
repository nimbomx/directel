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
$ediciones=$webDB->order_by('anio','DESC')->order_by('numero','DESC')->get('ediciones')->result();


       ?>         

<div id="optionsCanvas">
    <div class="topBar">

    <?  foreach ($ediciones as $edicion):?>
    <div myId="<?=$edicion->id?>" class="formItem" style="">Año <?=$edicion->anio?> / Num. <?=$edicion->numero?></div>
    <?  endforeach;?>

    <div style="clear: both;"></div>
  
    </div>

            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1>EDICIONES</h1> 
                            Desde aqui podras crear/eliminar o editar las Ediciones de Stratega Business Magazine.</div>
                <div style="float: right; margin: 30px;"><button onclick="openForm('crearEdicionCanvas');">NUEVA EDICIÓN</button></div>
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
         <button onclick="crearEdicion();">CREAR EDICIÓN</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Agregar una nueva edición.<br><br>
         <br><br>
         <label>Publicar:</label><input id="nPublish" type="checkbox">
         <br><br>
         <label>Año:</label><input id="nAnio" style="width:25px; text-align: center;" maxlength="3">
         <label>Número:</label><input id="nNumero" style=" width:20px; text-align: center;" maxlength="2">
         <br><br>
          <label style="float: left; margin-bottom: 10px;">Imagen:</label><br><br>
          
          <!-- -->
          <?
            $tabla='ediciones';
            $ancho=232;
            $alto=300;
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
            <label style="float: left; margin-bottom: 10px;">PDF:</label><br><br>
              <!-- -->

          <div style=" text-align: center;">
          <input id="nPDF" type="hidden">
          <div style="width: 312px; margin: auto;">
<?
$data['titulo']='+ Agregar archivo PDF';
$data['accion']='upload/upfile';
$data['onComplete']='printPDF()';
$data['tablas']='tablePDF';
$data['id']='upPDF';
$data['allow']='pdf';
$data['fileLimit']=true;
$this->load->view('compartidos/dragUpload',$data);
?>
          </div>
            <div id="pdfPrev" style="margin-top: 20px;"></div>
            </div>
            <!-- -->

     </div>
       </div>  
    
    

<div id="editarEdicionCanvas" class="formCanvas">
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button class="red" onclick="eliminarEdicion();">ELIMINAR EDICIÓN</button> <button onclick="editarEdicion();">GUARDAR CAMBIOS</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Editar edición.<br><br>
         <br><br>
         <input id="nIdE" type="hidden">
         <label>Publicar:</label><input id="nPublishE" type="checkbox">
         <br><br>
         <label>Año:</label><input id="nAnioE" style="width:25px; text-align: center;" maxlength="3">
         <label>Número:</label><input id="nNumeroE" style=" width:20px; text-align: center;" maxlength="2">
         <br><br>
          <label style="float: left; margin-bottom: 10px;">Imagen:</label><br><br>
          
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
            <label style="float: left; margin-bottom: 10px;">PDF:</label><br><br>
              <!-- -->

          <div style=" text-align: center;">
          <input id="nPDFE" type="hidden">
          <div style="width: 312px; margin: auto;">
<?
$data['titulo']='+ Agregar archivo PDF';
$data['accion']='upload/upfile';
$data['onComplete']='printPDF("E")';
$data['tablas']='tablePDFE';
$data['id']='upPDFE';
$data['allow']='pdf';
$data['fileLimit']=true;
$this->load->view('compartidos/dragUpload',$data);
?>
          </div>
            <div id="pdfPrevE" style="margin-top: 20px;"></div>
            </div>
            <!-- -->

     </div>
       </div>  
    
    



<script>
    function crearEdicion(){
        publish=0;
        if($('#nPublish').is(':checked'))publish=1;
        $.post('<?=base_url('ownact/addEdicion')?>',{
            publish:publish,
            anio:$('#nAnio').val(),
            numero:$('#nNumero').val(),
            archivo:$('#nPDF').val(),
            cover:$('#nImagen').val()
        },function(){
            getForm('contenido','ediciones');
        });
    }
    function editarEdicion(){
        publish=0;
        if($('#nPublishE').is(':checked'))publish=1;
        $.post('<?=base_url('ownact/editEdicion')?>',{
            publish:publish,
            id:$('#nIdE').val(),
            anio:$('#nAnioE').val(),
            numero:$('#nNumeroE').val(),
            archivo:$('#nPDFE').val(),
            cover:$('#nImagenE').val()
        },function(){
            getForm('contenido','ediciones');
        });
    }
    function eliminarEdicion(){
        if(confirm('¿Segur@ que desea eliminar esta edición?')){
            $.post('<?=base_url('ownact/security/delEdicion')?>',{
                id:$('#nIdE').val()
            },function(){
                getForm('contenido','ediciones');
            });
        }
    }
     function activateItems(){
        $('.formItem').unbind('click').bind('click',function(){
            id=$(this).attr('myId');
            $('.formCanvas').fadeOut('fast');
            $.post('<?=base_url('actions/getWebJSON')?>',{tabla:'ediciones',clave:'id',valor:id},function(e){
               var obj = jQuery.parseJSON(e);
               $('#nIdE').val(obj.id);
               if(obj.publish==1)$('#nPublishE').attr('checked','checked');
               else $('#nPublishE').removeAttr('checked');
               $('#nAnioE').val(obj.anio);
               $('#nNumeroE').val(obj.numero);
               if(obj.cover!=='')$('#imgPrevE').html('<img src="<?=web_url('recursos/ediciones')?>/'+obj.cover+'">');
                else $('#imgPrevE').html('');
                
                if(obj.archivo!=='')$('#pdfPrevE').html('<a href="<?=web_url('recursos/ediciones')?>/'+obj.archivo+'" target="_blank">ver pdf</a>');
                else $('#pdfPrevE').html('');
                openForm('editarEdicionCanvas');
            });

        });
    }
    activateItems();
    var printPDF = function(type){
        if(!type)type='';
        file= ($('#tablePDF'+type+'D tr:first').text());
        $('#tablePDF'+type+'D tr').remove();
        $('#nPDF'+type).val(file);
            $('#pdfPrev'+type).html('<a href="<?=web_url('recursos/tmp')?>/'+file+'" target="_blank">ver pdf</a>');
    };
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

