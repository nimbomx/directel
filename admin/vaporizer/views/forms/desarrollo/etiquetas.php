<?$etiquetas=$this->db->get('etiquetas')->result();?>         
<div id="optionsCanvas">
    <?  foreach ($etiquetas as $etiqueta):?>
        <div style="float: left; margin: 30px;"><?=$etiqueta->nombre?></div>
    <?  endforeach;?>
    <div style="clear: both;"></div>
    


            <div class="highBar">
                <div style="float: left; margin: 30px;"><h1>Etiquetas</h1> 
                            Crear, eliminar y/o editar, las etiquetas (secciones principales).</div>
                <div style="float: right; margin: 30px;"><button onclick="openForm();">EDITAR</button></div>
                <div style="clear: both;"></div>
            </div>  
                    
 
                    <div style="float: left; margin: 30px;">Opciones</div>
                    <div style="clear: both;"></div>
                    <div style="float: left; margin: 30px;"><a>Cambiar orden</a></div>
                    <div style="clear: both;"></div>


            </div>

 <div id="formCanvas">
                <button onclick="closeForm();">CANCELAR</button>
                <div style="height: 300px; background: #666;">
                    
                </div>
            </div>

