<? $data['table'] = $table = 'usuarios'; ?>
<? $this->load->view('section/productos_css', $data) ?>
<? $this->load->view('section/productos_js', $data) ?>
<? 
$limit=30;
if(empty($extra))$extra=1;
$offset=($extra-1)*$limit;
$desde=$offset+1;
$hasta=$extra*$limit;
?>
    <?
    $webDB = $this->load->database('web', TRUE);
     //$noitems = $webDB->order_by('id', 'DESC')->where("pub_status = 'published' AND vap_itemstatus != 'empty'")->get('productos')->num_rows();
   $items = $webDB->order_by('id', 'DESC')->get('usuarios',$limit,$offset)->result();
    ?>
<script>
    function hidePopMenu(){
        $(window).unbind('click');
        $('#menuPop').hide();
    }
function showPopMenu(e,id){
    $(window).unbind('click');
    eTop=($(e).offset().top);
    eLeft=($(e).offset().left)+40;
    $('#menuPop').attr('data-id',id);
    $('#menuPop').css({'top':eTop,'left':eLeft}).fadeIn('fast');
    //$('not:#menuPop').click(hidePopMenu);
}
function deleteItem(){
    id=($('#menuPop').attr('data-id'));
    $.post('<?php vap_action('removeClient','usuarios')?>',{id:id},function(){
        location.reload();
    });
};
</script>

<div id="secTopBar">
    <div class="rute">Clientes</div>
    <div class="tools"></div>
</div>

<div id="listCanvas">

<div id="menuPop" data-id="" style="background: #666; position: fixed; z-index: 100; display: none;">
    menu<br>
    <button onclick="deleteItem();">Eliminar</button>
</div>

            <table id="items" class="tablesorter">
        <tbody> 
            <?
            foreach ($items as $user):
                
                ?>
                <tr>

                  
                    <td style="padding: 0px 10px;"> 
<?= $user->apellido ?>, <?= $user->nombre ?>
                       </td>
                       <td><button onclick="showPopMenu(this,<?=$user->id?>)">...</button></td>
                    <td><i><?= $user->mail ?></i></td>
                     <td> Tel: <?= $user->telefono ?></td>
                </tr>
<? endforeach; ?>
        </tbody> 
    </table>
</div>

<div id="fog">
    <table>
        <tr>
            <td>
                <div id="formCanvas">
                    <div class="content">
                        <table>
                            <tr>
                                <td style="text-align: left; vertical-align: top;">
                                    <input id="pId" type="hidden" >
                                    <input id="pImagen"  type="hidden">
                                    Nombre:<br>
                                    <input id="pNombre" name="pNombre" style="width: 100%;">
                                    Equipo: 
                                    <input type="radio" class="pNuevousado" name="nuevousado" value="usado"><label>Usado</label>
                                    <input type="radio" class="pNuevousado" value="nuevo" name="nuevousado"><label>Nuevo</label>
                                    <br>
                                    Cantidad:<br>
                                    <input id="pCantidad" name="pCantidad"><br>
                                    Descripción [old]:<br>
                                    <textarea id="pFrase"  style="width: 100%;"></textarea>
                                    Descripción corta:<br>
                                    <textarea id="pDescripcioncorta"  style="width: 100%;"></textarea>
                                    Descripción:<br>
                                    <textarea id="pDescripcion"  style="width: 100%;"></textarea>
                                    Precio:<br>
                                    $<input id="pPrecio"  style=""><br>
                                    Ubicación:<br>
                                    <input id="pUbicacion" name="pUbicacion"><br>
                                    Importancia: 
                                    <select id="pHigh_status">
                                        <option value="normal">Normal</option>
                                        <option value="high">Destacado</option>
                                        <option value="principal">Principal</option>
                                    </select>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 250px; vertical-align: top;">


                                    <table>
                                        <tr>
                                            <td style="width: 240px;"><div id="upBoletinImg" style=" position:  relative; width: 240px; height: 240px; border-radius: 10px; border: 2px dashed #bbb;">
                                                    <?php
                                                    $data['titulo'] = '<h1>Agregar Imagenes</h1>';
                                                    $data['accion'] = 'upload/upimg/' . $table;
                                                    $data['onComplete'] = 'printImg()';
                                                    $data['tablas'] = 'tableImg';
                                                    $data['id'] = 'upImg';
                                                    $data['fileLimit'] = false;
                                                    $this->load->view('shared/dragUpload2014', $data);
                                                    ?>
                                                </div></td>
                                            <td></td>
                                            <td style="text-align: center;"><div id="previewImagen"></div></td>
                                            <td></td>
                                            <td style="text-align: right; vertical-align: bottom;">
                                                <div style="text-align: left;">
                                                     <input id="pPub" value='published' type="checkbox" >Publicado<br>
                              
                                                </div>
                                                <button class="topButton" onclick="cancel();">Cancelar</button>
                                                <button class="topButton principal" onclick="guardarCambios('p');">Guardar</button>
                                            </td>
                                        </tr>
                                    </table>
                                </td>

                            </tr>
                        </table>
                    </div>
                </div>



            </td>
        </tr>
    </table>
</div>

