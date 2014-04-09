<?if(empty($form))$form='contacto';?>
<div class="title">CONTENIDO</div>
<div class="active">
    <div class="listBtns">
        <div tab="contenido" form="contacto" class="<?if($form==="contacto") echo 'selected';?>">Contacto</div>

        <div tab="contenido" form="banner" class="<?if($form==="banner") echo 'selected';?>">Banner</div>
    </div>
    <div class="separador"></div>
    <div class="content" id="formCanvas">
        <?$this->load->view('forms/'.$form)?>
    </div>
</div>
