<?if(empty($form))$form='perfil';?>
<div class="title">CONFIGURACIÓN</div>
<div class="active">
    <div class="listBtns">
        <div tab="configuracion" form="perfil" class="<?if($form==="perfil") echo 'selected';?>">Perfil</div>
        <div tab="configuracion" form="cuentas" class="<?if($form==="cuentas") echo 'selected';?>">Cuentas</div>
        
    </div>
    <div class="separador"></div>
    <div class="content" id="formCanvas">
        <?$this->load->view('forms/'.$form)?>
    </div>
</div>
