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
$tabla='titulos';
$seccion='titulos';
$webDB = $this->load->database('web', TRUE);
$items=$webDB->order_by('anio','DESC')->order_by('mes1','DESC')->get($tabla);
/**/
$graduados=$webDB->order_by('nombre')->get('graduados');
$meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$mesesml= array('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
       ?>         

<div id="optionsCanvas">
    <div class="topBar">
        <div style="clear: both;"></div>

    <?  if($items->num_rows==0)echo 'No se ha encontrado ningún item.';
    foreach ($items->result() as $item):?>
    <div myId="<?=$item->id?>"  class="formItem" style="max-width: 270px; height: 80px">
        <?=$webDB->get_where('graduados',array('id'=>$item->idGraduado))->row()->nombre;?><br>
        <?=$mesesml[$item->mes1]?>-<?=$mesesml[$item->mes2]?> <?=$item->anio?><br><?=$item->nombre?></div>
    <?  endforeach;?>

    <div style="clear: both;"></div>
 
    </div>

            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1>TITULOS</h1> 
                            Desde aqui podras crear/eliminar o editar los Titulos de los Graduados del Tecmilenio.</div>
                <div style="float: right; margin: 30px;"><button onclick="openForm('crearArticuloCanvas');">NUEVO TITULO</button></div>
                <div style="clear: both;"></div>
            </div>  
                    
    <div class="opciones">
        <h2>Opciones
        </h2>
        <div class="item">
           
           
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
         <label>Graduado:</label><select id="nIdGraduado">
             <option selected disabled>Elige un graduado</option>
             <?foreach ($graduados->result() as $graduado):?>
             <option value="<?=$graduado->id?>"><?=$graduado->nombre?></option>
    <?  endforeach;?>
             
         </select>
         <br><br>

         <label>Título:</label><input id="nNombre" placeholder='¿Cual es el nombre del Título?'>
<br><br>
¿En que periodo de obtuvo el título?<br><br>
<label>Año:</label><input id="nAnio" style="width: 50px;"><br>
<label>Mes de inicio:</label><select id="nMes1">
             <option selected disabled>Inicio</option>
             <?foreach ($meses as $index=>$mes):?>
             <option value="<?=$index?>"><?=$mes?></option>
    <?  endforeach;?>
             
         </select>
<label>Mes de término:</label><select id="nMes2">
             <option selected disabled>Término</option>
             <?foreach ($meses as $index=>$mes):?>
             <option value="<?=$index?>"><?=$mes?></option>
    <?  endforeach;?>
             
         </select>
<br><br>
<label>Foto:</label><input id="nFoto">
<br><br>
<label>Frase:</label><textarea id="nFrase"></textarea>
<br><br>
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
         <label>Graduado:</label><select id="nIdGraduadoE">
             <option selected disabled>Elige un graduado</option>
             <?foreach ($graduados->result() as $graduado):?>
             <option value="<?=$graduado->id?>"><?=$graduado->nombre?></option>
    <?  endforeach;?>
             
         </select>
         <br><br>

         <label>Título:</label><input id="nNombreE" placeholder='¿Cual es el nombre del Título?'>
<br><br>
¿En que periodo de obtuvo el título?<br><br>
<label>Año:</label><input id="nAnioE" style="width: 50px;"><br>
<label>Mes de inicio:</label><select id="nMes1E">
             <option selected disabled>Inicio</option>
             <?foreach ($meses as $index=>$mes):?>
             <option value="<?=$index?>"><?=$mes?></option>
    <?  endforeach;?>
             
         </select>
<label>Mes de término:</label><select id="nMes2E">
             <option selected disabled>Término</option>
             <?foreach ($meses as $index=>$mes):?>
             <option value="<?=$index?>"><?=$mes?></option>
    <?  endforeach;?>
             
         </select>
<br><br>
<label>Foto:</label><input id="nFotoE">
<br><br>
<label>Frase:</label><textarea id="nFraseE"></textarea>
<br><br>
     </div>
    </div>
</div>


<script>

    function crearArticulo(){
        $.post('<?=base_url('ownact/addItem/'.$tabla)?>',{
            idGraduado:$('#nIdGraduado').val(),
            nombre:$('#nNombre').val(),
            anio:$('#nAnio').val(),
            mes1:$('#nMes1').val(),
            mes2:$('#nMes2').val(),
            foto:$('#nFoto').val(),
            frase:$('#nFrase').val()
        },function(){
            getForm('contenido','<?=$seccion?>');
        });
    }
    function borrarArticulo(){
        if(confirm('¿Segur@ que desea eliminar este item?')){
            id=$('#nIdE').val();
            $.post('<?=base_url('ownact/delItem/'.$tabla)?>',{id:id},function(){
                getForm('contenido','<?=$seccion?>');
            });
        }
    }
    function editarArticulo(){
        $.post('<?=base_url('ownact/editItem/'.$tabla)?>',{
            id:$('#nIdE').val(),
            nombre:$('#nNombreE').val(),
            anio:$('#nAnioE').val(),
            mes1:$('#nMes1E').val(),
            mes2:$('#nMes2E').val(),
            foto:$('#nFotoE').val(),
            frase:$('#nFraseE').val()
        },function(){
            getForm('contenido','<?=$seccion?>');
        });
    }

    function activateItems(){
        $('.formItem').unbind('click').bind('click',function(){
            id=$(this).attr('myId');
            $('.formCanvas').fadeOut('fast');
            $.post('<?=base_url('actions/getWebJSON')?>',{tabla:'<?=$tabla?>',clave:'id',valor:id},function(e){
               var obj = jQuery.parseJSON(e);
                $('#nIdE').val(obj.id);
                $('#nIdGraduadoE').val(obj.idGraduado);
                $('#nNombreE').val(obj.nombre);
                $('#nAnioE').val(obj.anio);
                $('#nMes1E').val(obj.mes1);
                $('#nMes2E').val(obj.mes2);
                $('#nFotoE').val(obj.foto);
                $('#nFraseE').val(obj.frase);
                openForm('editarArticuloCanvas');
            });

        });
    }
    activateItems();

</script>

