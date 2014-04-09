<style>
    #vap_leftBar{
        position: fixed;
        top: 0px;
        left: 30px;
        width: 170px;
        bottom: 0px;
        background: #aaa;
        color: #eee;
    }
    #vap_leftExtBar{
        position: fixed;
        top: 0px;
        left: 0px;
        bottom: 0px;
        width: 30px;
        background: #222 url('<?=  style_png('leftName')?>') center bottom no-repeat;
    }
    .webname{
        padding: 15px 5px;
        text-align: center;

    }
    .rightFix{
        
    }
    .rightFloat{
        float: right;
    }
    .leftButton{
        height: 40px;
        margin: 1px 0px;
        width: 100%;
        background: #464646;
        border: none;
        color: #fff;
        cursor: pointer;
        
    }
    .leftButton:hover, .leftButton:focus{
        background: #565656;
    }
</style>
<div id="vap_leftExtBar">
    
</div>
<div id="vap_leftBar">
    <div class="webname"><img style=" vertical-align: middle; margin-right: 10px;" src="<?=  web_url('res/style/favicon.png')?>"><?=$webname?></div>
    <a href="<?=base_url()?>"><button class="leftButton">Inicio</button></a>
    <a href="<?=base_url('borradores')?>"><button class="leftButton">Borradores</button></a>
    <a href="<?=base_url('productos')?>"><button class="leftButton">Productos (publicados)</button></a>
    <a href="<?=base_url('archivados')?>"><button class="leftButton">Productos (archivados)</button></a>
    <a href="<?=base_url('pedidos')?>"><button class="leftButton">Pedidos</button></a>
    <a href="<?=base_url('clientes')?>"><button class="leftButton">Clientes</button></a>
    <a href="<?=base_url('productosold')?>"><button class="leftButton">Productos</button></a>
    <a href="<?=base_url('cuentas')?>"><button class="leftButton">Cuentas</button></a>
    <div class="rightFloat">
        <a href="<?=base_url('acciones/logout')?>"><button class="topButton">Cerrar sesión</button></a>
    </div>
</div>
