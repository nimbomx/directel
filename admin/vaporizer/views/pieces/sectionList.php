<style>
    .hide{
        display: none;
    }
    .seccionesAdded{
        cursor: pointer;
    }
    .seccionesToAdd{
        cursor: pointer;
    }
</style>
<h3>Secciones de "<?=$name?>"</h3>
<?
$webDB = $this->load->database('web', TRUE);
?>
<div id="currentSec">
    
</div>
<?
$secciones=array();
foreach($webDB->order_by('seccion.nombre','ASC')->where('categoria_id',$id)->where('seccion.id = categoria_seccion.seccion_id')->get('categoria_seccion , seccion')->result() as $seccion):
    $secciones[]=$seccion->seccion_id;
    ?>
<div class="seccionesAdded" seccion_id="<?=$seccion->id?>"><?=$seccion->nombre?></div>
<? endforeach; ?>
<hr>
<?
foreach($webDB->order_by('nombre','ASC')->get_where('seccion',array('parent'=>0))->result() as $seccion):
    ?>
<div class="seccionesToAdd <?if(in_array($seccion->id,$secciones)) echo " hide "?>" id="s_<?=$seccion->id?>" seccion_id="<?=$seccion->id?>"><?=$seccion->nombre?></div>
<?  endforeach; ?>
<script>
    $('.seccionesToAdd').die('click').live('click',function(){
        $(this).addClass('hide');
        seccion_id=($(this).attr('seccion_id'));
        seccion_name=$(this).text()
        $.post('<?=  base_url('categorias/addSection')?>',{categoria_id:'<?=$id?>',seccion_id:seccion_id},function(e){
           $('#currentSec').append('<div class="seccionesAdded" seccion_id="'+seccion_id+'">'+seccion_name+'</div>')
       });
    });
    $('.seccionesAdded').die('click').live('click',function(){
        seccion_id=($(this).attr('seccion_id'));
        $(this).remove();
        $.post('<?=  base_url('categorias/delSection')?>',{categoria_id:'<?=$id?>',seccion_id:seccion_id},function(e){
           $('#s_'+seccion_id).removeClass('hide');
       });
        
    });
</script>