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
        min-height: 20px;
        border: #353535 1px solid;
        border-radius: 5px;
        text-align: center;
    }
    .formItem img{
        max-height: 100px;
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
$tabla='bannerprincipal';
$ancho=920;
$alto=400;
$webDB = $this->load->database('web', TRUE);
$imagenes=$webDB->get($tabla)->result();
       ?>         

<div id="optionsCanvas">
    <div class="topBar">
    <?  foreach ($imagenes as $imagen):?>
        <div myId="<?=$imagen->id?>"  class="formItem" style=""><img src="<?=  web_url('recursos/'.$tabla.'/'.$imagen->file)?>"></div>
    <?  endforeach;?>
    <div style="clear: both;"></div>
    </div>

            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1>BANNER PRINCIPAL</h1> 
                            Desde aqui podras administrar el contenido del Banner Principal.</div>
                <div style="float: right; margin: 30px;"><button onclick="openForm('subirImagenCanvas');">NUEVA IMÁGEN</button></div>
                <div style="clear: both;"></div>
            </div>  
                    
    <div class="opciones">
       <!-- <h2>Opciones</h2>
        <div class="item"><a href="#" >...</a></div>
        <div style="clear: both;"></div>-->
        
    </div>
                    


            </div>

<div id="formCanvas">
    <div id="subirImagenCanvas" class="formCanvas">
        
    
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="crearImagen();">AGREGAR IMÁGEN</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
  <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Agrega una imágen a este Banner.<br><br>
         <input id="bIdE" type="hidden">
         <br><br>
                   <label style="float: left; margin-bottom: 10px;">Imagen:</label><br><br>
          
          <!-- -->

          <div style=" text-align: center;">
          <input id="bImagen" type="hidden">
          <div style="width: 312px; margin: auto; ">
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
            <br><br>
         <label>Dirección de enlace:</label><input id="bURL" placeholder='¿A dónde dirigirá esta imágen?'>
         <br><br>
 <label>Tipo de enlace:</label><select id="bTarget">
            <option value="_self">Enlace interno</option>
            <option value="_blank">Enlace externo</option>
        </select><br><br>

     </div>
       </div>  
    
    
    <div id="editarImagenCanvas" class="formCanvas">
       <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
           <button class="red" onclick="borrarImagen();">ELIMINAR IMAGEN</button> <button onclick="editarImagen();">GUARDAR CAMBIOS</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Modifica las características de esta imágen.<br><br>
         <input id="bIdE" type="hidden">
         <br><br>
                   <label style="float: left; margin-bottom: 10px;">Imagen:</label><br><br>
          
          <!-- -->

          <div style=" text-align: center;">
          <input id="bImagenE" type="hidden">
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
            <br><br>
         <label>Dirección de enlace:</label><input id="bURLE" placeholder='¿A dónde dirigirá esta imágen?'>
         <br><br>
 <label>Tipo de enlace:</label><select id="bTargetE">
            <option value="_self">Enlace interno</option>
            <option value="_blank">Enlace externo</option>

        </select><br><br>

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
           $('#bImagen'+type).val(e);
            $('#imgPrev'+type).html('<img src="<?=web_url('recursos/tmp/resized')?>/'+e+'">');
       });
    };
            var showImg = function (type){
    if(!type)type='';
    file= ($('#tableImgLB'+type+'D tr:first').text()); 
       $('#tableImgLB'+type+'D tr').remove();
           $('#bImagenLB'+type).val(file);
            $('#imgPrevLB'+type).html('<img src="<?=web_url('recursos/tmp')?>/'+file+'">');
    };
    function crearImagen(){
        url=$('#bURL').val();
        target=$('#bTarget').val();
        file=$('#bImagen').val();
        reffile=$('#bImagenLB').val();
        
        $.post('<?=base_url('actions/agregarBanner/'.$tabla)?>',{reffile:reffile,link:url,target:target,file:file},function(e){
        getForm('contenido','<?=$tabla?>');
        });
    }
    
    
    
    function editarImagen(){
        id=$('#bIdE').val();
        url=$('#bURLE').val();
        target=$('#bTargetE').val();
        file=$('#bImagenE').val();
        reffile=$('#bImagenLBE').val();
        $.post('<?=base_url('actions/editarBanner/'.$tabla)?>',{reffile:reffile,link:url,target:target,file:file,id:id},function(e){
            getForm('contenido','<?=$tabla?>');
        });
    }
    
    function borrarImagen(){
        if(confirm('¿Segur@ que desea eliminar esta imagen?')){
            id=$('#bIdE').val();
            $.post('<?=base_url('actions/eliminarBanner/'.$tabla)?>',{id:id},function(){
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
                $('#bIdE').val(obj.id);
                $('#bURLE').val(obj.link);
                $('#bTargetE').val(obj.target);
                if(obj.file!=='')$('#imgPrevE').html('<img src="<?=web_url('recursos/'.$tabla)?>/'+obj.file+'">');
                else $('#imgPrevE').html('');
                if(obj.reffile!=='')$('#imgPrevLBE').html('<img src="<?=web_url('recursos/'.$tabla)?>/'+obj.reffile+'">');
                else $('#imgPrevLBE').html('');
                openForm('editarImagenCanvas');
            });

        });
    }
    activateItems();

   
</script>

