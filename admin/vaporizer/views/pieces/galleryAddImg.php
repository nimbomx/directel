<div id="upGalleryImg" style=" position:  relative; width: 240px; height: 240px; border-radius: 10px; border: 2px dashed #bbb;">
    <?
    $data['titulo'] = '<h1>Agregar Imagenes</h1>';
    $data['accion'] = 'upload/upimg/' . $table;
    $data['onComplete'] = 'printImgGallery()';
    $data['tablas'] = 'tableImgG';
    $data['id'] = 'upImgG';
    $data['fileLimit'] = false;
    $this->load->view('shared/dragUpload2014', $data);
    ?>
</div>
