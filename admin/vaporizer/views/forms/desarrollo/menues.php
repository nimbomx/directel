<?
$tabla='menues';
$etiquetas=$this->db->get('etiquetas')->result();?>  
<?$menues=$this->db->order_by('seccion','ASC')->get('menues')->result();?>  
<div id="optionsCanvas">
    <?  foreach ($etiquetas as $etiqueta):?>
        <div style="float: left; margin: 30px;"><?=$etiqueta->nombre?></div>
    <?  endforeach;?>
    <div style="clear: both;"></div>
    
<?  foreach ($menues as $menu):?>
        <div style="float: left; margin: 30px;"><?=$menu->nombre?></div>
    <?  endforeach;?>
    <div style="clear: both;"></div>

            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1>Menúes</h1> 
                            Crear, eliminar y/o editar, las etiquetas (secciones principales).</div>
                <div style="float: right; margin: 30px;"><button onclick="openForm();">NUEVA SECCIÓN</button></div>
                <div style="clear: both;"></div>
            </div>  
                    
 
                    <div style="float: left; margin: 30px;">Opciones</div>
                    <div style="clear: both;"></div>
                    <div style="float: left; margin: 30px;"><a>Cambiar orden</a></div>
                    <div style="clear: both;"></div>


            </div>

<div id="formCanvas">
     <div class="static" style="background: #393939;position: absolute; top: 0px; right: 0px;left: 0px; text-align: right; height: 35px; padding: 5px 30px;">
         <button onclick="addButton();">CREAR BOTÓN</button> <button onclick="closeForm();">CANCELAR</button>
     </div>
     <div class="scrollable" style="position: absolute; top: 45px; left: 0px; right: 0px; bottom: 0px;
          padding: 30px; overflow: auto;">
         Agregar botón a un menú.<br><br>
         
         ¿A que menú quieres agregar el botón?
         <select id="mSeccion">
             <option disabled selected >Elige una menú</option>
             <?  foreach ($etiquetas as $etiqueta):?>
             <option  value="<?=$etiqueta->url?>" ><?=$etiqueta->nombre?></option>
    <?  endforeach;?>
         </select>
         <br><br>
         Nombre: <input id="mNombre" placeholder="¿Que nombre va a tener este botón?">
         <br><br>
         URL: <input id="mUrl" placeholder="Este campo se llena automáticamente."> <br><small>(Puedes modificarla, pero debes saber lo que haces.)</small>
          <br><br>
          Orden: <input id="mOrden" placeholder="Este campo se llena automáticamente."> <br><small>(Puedes modificarla, pero debes saber lo que haces.)</small>
          <br><br>
          Botón privado: <input type="checkbox" > <small>(Solo visible para desarrolladores.)</small>
     </div>
                
</div>
<script>
   function addButton(){
        seccion=$('#mSeccion').val();
        nombre=$('#mNombre').val();
        url=$('#mUrl').val();
        orden=$('#mOrden').val();
        $.post('<?=base_url('actions/insertDevFlatItem/'.$tabla)?>',{nombre:nombre,seccion:seccion,url:url,orden:orden},function(e){
           getForm('desarrollo','menues');
        });
    }  
</script>

