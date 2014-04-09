<?php $table='vnb_usuarios';?>
<style>
    
    #secTopBar{
        border-bottom: 1px solid #eee;
        height: 40px;
        margin-bottom: 10px;
        position: absolute;
        left: 0px;
        right: 0px;
        background: #fff;
        padding: 0px 10px;
    }
    #secTopBar .rute{
        float: left;
    }
    #secTopBar .tools{
        float: right;
    }
    #secTopBar .tools button{
        height: 30px;
    }
    #listCanvas{
        overflow: auto;
        position: absolute;
        top: 60px;
        bottom: 0px;
        left: 0px;
        right: 0px;
    }
    #listCanvas table{
        border-collapse: collapse;
        width: 100%;
        margin: 0px;
        padding: 0px;
    }
    #listCanvas tr td{
        border-bottom: 1px solid #ccc;
        font-size: 12px;
        color: #666;
        position: relative;
    }
    #listCanvas tr:hover td{
        font-size: 12px;
        color: #666;
        position: relative;
        background: #f6f6f6;
    }
    #listCanvas .header td{
        background: #f3f3f3;
        font-size: 12px;
        font-weight: 500;
        color: #000;
    }
    #listCanvas tr .editBtn{
        display: none;
    }
    #listCanvas tr:hover .editBtn{
        display: block;
    }
    .editBtn{
        position: absolute;
        right: 2px;
        top: 0px;
    }
    #listCanvas tr .delBtn{
        display: none;
    }
    #listCanvas tr:hover .delBtn{
        display: block;
    }
    .delBtn{
        position: absolute;
        right: 50px;
        top: 0px;
    }
    #items i{
        color: #999;
    }
    #items button{
        font-size: 10px;
        cursor: pointer;
        height: 40px;
    }
    #items tr{
        min-height: 100px;
    }
    #upBoletinImgE,#upBoletinImg{
        background-size: cover; 
    }
</style>
<script>
function openPop(target){
    $('#formCanvas').hide();
    $('#formCanvasE').hide();
    $('#fog').fadeIn('normal',function(){
        $('#formCanvas').slideDown('fast');
     });
}
function openPopE(target){
    $('#formCanvas').hide();
    $('#formCanvasE').hide();
    $('#fog').fadeIn('normal',function(){
        $('#formCanvasE').slideDown('fast');
     });
}
function guardarProducto(prefix){
    accesos=($('#'+prefix+'Tipo').val());
    nick=($('#'+prefix+'Nombre').val());
    tmpPass=($('#'+prefix+'Descripcion').val());

    $.post('<?php vap_action('uploadAccount',$table)?>',{
        accesos:accesos,
        nick:nick,
        tmpPass:tmpPass
    },function(){
        location.reload();
    });
}
function guardarCambios(prefix){
    id=($('#'+prefix+'IdE').val());
    tipo=($('#'+prefix+'TipoE').val());
    nombre=($('#'+prefix+'NombreE').val());
    descripcion=($('#'+prefix+'DescripcionE').val());
    $.post('<?php vap_action('updateItemAccount',$table)?>',{
        id:id,
        accesos:tipo,
        nick:nombre,
        tmpPass:descripcion
    },function(e){
        location.reload();
    });
}

$(function(){
   $('.delBtn').click(function(){
       if(!confirm('¿Seguro que desea eliminar este elemento?'))return false;
       id=$(this).attr('data-id');
       $.post('<?php vap_action('deleteAccount')?>',{
           id:id
       },function(){
        location.reload();
    });
   });
   $('.editBtn').click(function(){
       id=$(this).attr('data-id');
       $.post('<? vap_action('getItemJSONvap',$table)?>',{
           id:id
       },function(e){
           var obj = jQuery.parseJSON(e);
           prefix='p';
           ($('#'+prefix+'IdE').val(obj.id));
           ($('#'+prefix+'TipoE').val(obj.accesos));
            ($('#'+prefix+'NombreE').val(obj.nick));
            ($('#'+prefix+'DescripcionE').val(obj.tmpPass));
            /*($('#'+prefix+'ImagenE').val(obj.imagen));*/
            if(obj.imagen!==''){
                $('#upBoletinImgE').css({'background-image':'url("<?=web_url('res/'.$table)?>/'+obj.imagen+'")','background-repeat':'no-repeat','background-size':'contain','background-position':'center center'})
               $('#upBoletinImgE .file_upload').addClass('full');
           }
           if(obj.nombreimg!==''){
                $('#upBoletinImg2E').css({'background-image':'url("<?=web_url('res/'.$table)?>/'+obj.nombreimg+'")','background-repeat':'no-repeat','background-size':'contain','background-position':'center center'})
               $('#upBoletinImg2E .file_upload').addClass('full');
           }
           openPopE();
           //alert(e);
        //location.reload();
    });
   });
});
    
    
</script>
<div id="secTopBar">
    <div class="rute">Cuentas</div>
    <div class="tools"><button onclick="openPop('productoNuevo');">Nuevo</button></div>
</div>
<div id="listCanvas">
    <?php

$perfiles=$this->db->order_by('name')->get('vnb_accesos')->result();
   // $items=$webDB->order_by('id','DESC')->get('productos')->result();
$items=$this->db->query('SELECT t1.nick,t1.accesos, t2.*,t3.name AS accesos  FROM '.$table.' AS t1,vnb_perfiles AS t2,vnb_accesos AS t3 WHERE t1.id = t2.id AND t1.accesos = t3.id ORDER BY nick ASC')->result();
?>
<table id="items">
    <tr class="header">
        <td colspan="2" style="padding-left: 10px;">USUARIO</td>
        <td >PERFIL DE ACCESO</td>
    </tr>
    
<?
foreach ($items as $item):
?>
<tr>
    <td>&nbsp;<?php if($item->avatar!=''){?><img style="height: 40px;" src="<?=  web_url('res/perfiles')?>/<?=$item->avatar?>"><?php }?> </td>
    <td style="height: 40px;"><?php if($item->alias!=''){?><?=$item->alias?> <i>(<?=$item->nick?>)</i> <?php }else{?><?=$item->nick?><?php }?> <button class="delBtn" data-id="<?=$item->id?>">[DEL]</button> <button class="editBtn" data-id="<?=$item->id?>">[EDIT]</button></td>
    <td style="width: 50%;"><div style="max-height: 50px; overflow: hidden;"><?=$item->accesos?></div></td>
</tr>
<? endforeach; ?>
</table>
</div>








<div id="fog">
        <table>
            <tr>
                <td>
                    
                    
                    
                    
                    <div id="formCanvas">
                        <div class="topBar"><button style="float: right;" onclick="closeFogForm()">Close</button></div>
                        <div class="content">
                            <table>
                                <tr>
                                    
                                    <td style="text-align: left; vertical-align: top;">
                                        Perfil de acceso:<br>
                                        <select id="pTipo" name="pTipo" style="width: 100%;">
                                            <?php 
                                            
                                            foreach($perfiles as $mi):?>
                                                <option value="<?=$mi->id?>"><?=$mi->name?></option>
                                            <?php 
   
                          
                                            endforeach;?>
                                        </select>
                                        Usuario:<br>
                                        <input id="pNombre" name="pNombre" style="width: 100%;">
                                        Contraseña temporal:<br>
                                        <input id="pDescripcion"  style="width: 100%;">



                                        <button onclick="guardarProducto('p');">Guardar</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    
                    <?/* */?>
                    <div id="formCanvasE">
                             <div class="topBar"><button style="float: right;" onclick="closeFogForm()">Close</button></div>
                        <div class="content">
                            <table>
                                <tr>
                          
                                    <td style="text-align: left; vertical-align: top;">
                                        <input id="pIdE" type="hidden">
                                        Tipo:<br>
                                        <select id="pTipoE" name="pTipo" style="width: 100%;">
                                            <?php 
                                            
                                            foreach($perfiles as $mi):?>
                                                <option value="<?=$mi->id?>"><?=$mi->name?></option>
                                            <?php 
   
                          
                                            endforeach;?>
                                        </select>
                                        Usuario:<br>
                                        <input id="pNombreE" name="pNombre" style="width: 100%;">
Contraseña temporal:<br>
                                        <input id="pDescripcionE"  style="width: 100%;">

                                        
                                        <button onclick="guardarCambios('p');">Guardar</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?/* */?>
                </td>
            </tr>
        </table>
    </div>

