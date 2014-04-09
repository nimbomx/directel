<? $data['table'] = $table = 'productos'; ?>
<? $this->load->view('section/productos_css', $data) ?>
<? $this->load->view('section/productos_js', $data) ?>

<div id="secTopBar">
    <div class="rute">Productos</div>
    <div class="tools"><button class="topButton principal" onclick="newItem();">+ Nuevo</button></div>
</div>
<div id="listCanvas">
    <?
    $webDB = $this->load->database('web', TRUE);
    $items = $webDB->order_by('id', 'DESC')->get_where('productos', array('vap_itemstatus !=' => 'empty'))->result();
    ?>
    <table id="items" class="tablesorter">
        <thead> 
            <tr class="header">
                <td colspan="2">NOMBRE</td>

                <td>DESCRIPCIÓN</td>
                <td>PRECIO</td>
                <td>CANTIDAD</td>
                <td>ESTADO</td>
                <td>UBICACIÓN</td>
            </tr>
        </thead> 
        <tbody> 
            <?
            foreach ($items as $item):
                ?>
                <tr>
                    <? $images = explode(',', $item->imagen);
                    $image = $images[0];
                    ?>
                    <td>&nbsp;<img title="Editar galería" data-gallery="<?= $item->imagen ?> "data-id="<?= $item->id ?>" onclick="openEditGallery(this);" style="height: 40px; cursor: pointer;" src="<?= base_url('img/maxh/40/productos') ?>/<?= $image ?>"> </td>
                    <td><?= $item->nombre ?> <button class="delBtn" data-id="<?= $item->id ?>">[DEL]</button> <button class="editBtn" data-id="<?= $item->id ?>">[EDIT]</button></td>
                    <td><?= $item->frase ?> </td>
                    <td>$<?= $item->precio ?> MXN </td>
                    <td><?= $item->cantidad ?> </td>
                    <td><?= $item->nuevousado ?> </td>
                    <td><?= $item->ubicacion ?> </td>
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
                                    Descripción:<br>
                                    <textarea id="pFrase"  style="width: 100%;"></textarea>
                                    Precio:<br>
                                    $<input id="pPrecio"  style=""><br>
                                    Ubicación:<br>
                                    <input id="pUbicacion" name="pUbicacion"><br>
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

