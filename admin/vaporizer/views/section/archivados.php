<? $data['table'] = $table = 'productos'; ?>
<? $this->load->view('section/productos_css', $data) ?>
<? $this->load->view('section/productos_js', $data) ?>

<div id="secTopBar">
    <div class="rute">Productos (archivados)</div>
    <div class="tools"></div>
</div>

<div id="listCanvas">
    <?
    $webDB = $this->load->database('web', TRUE);
    //$items = $webDB->order_by('id', 'DESC')->get_where('productos', array('vap_itemstatus !=' => 'empty','pub_status'=>'draft'))->result();
    $items = $webDB->order_by('id', 'DESC')->where("pub_status = 'archived' AND vap_itemstatus != 'empty'")->get('productos',30,0)->result();
    ?>


            <table id="items" class="tablesorter">
        <tbody> 
            <?
            foreach ($items as $item):
                ?>
                <tr>
                    <? $images = explode(',', $item->imagen);
                    $image = $images[0];
                    ?>
                    <td style="vertical-align: middle"><img title="Editar galería" data-gallery="<?= $item->imagen ?> "data-id="<?= $item->id ?>" onclick="openEditGallery(this);" style="max-height: 60px; cursor: pointer;" src="<?= base_url('img/max/60/productos') ?>/<?= $image ?>"> </td>
                    <td style="padding: 0px 10px;"><?= $item->nombre ?> <button class="delBtn" data-id="<?= $item->id ?>">ELIMINAR</button> <button class="editBtn" data-id="<?= $item->id ?>">EDITAR</button></td>
                    <td><?= $item->descripcioncorta ?> </td>
                    <td>$<?= $item->precio ?> MXN </td>
                    <td><?= $item->cantidad ?> </td>
                    <td><?= $item->nuevousado ?> </td>
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
                      
                                            <td style="text-align: center;"><div id="previewImagen"></div></td>
                                            <td></td>
                                            <td style="text-align: right; vertical-align: bottom;">
                                                <div style="text-align: left;">
                                                <input name="sveand" type="radio" checked=""> Guardar cambios sin restablecer<br>
                                                <input name="sveand" type="radio"> Restablecer como borrador<br>
                                                <input name="sveand" type="radio"> Restablecer y publicar
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

