<? if(empty($id))$id="file_upload"?>
<? if(empty($tablas))$tablas="files"?>
<? if(empty($allow))$allow="img"?>
<? $this->load->view('compartidos/fileupload_css')?>

<? if(isset($error))echo $error;?>
<form method="post" enctype="multipart/form-data"  id="<?=$id?>" action="<?=base_url($accion)?>" class="">
            <input type="file" name="userfile" multiple />
            <button>Subir</button>
            <div><?=$titulo?></div>
</form>
        <table class="updateTableUI" id="<?=$tablas?>"></table>
        <table class="updateTableUI" id="<?=$tablas?>D"></table>

<script>
        
$('#<?=$id?>').fileUploadUI({
        uploadTable: $('#<?=$tablas?>'),
        downloadTable: $('#<?=$tablas?>D'),
        beforeSend: function (event, files, index, xhr, handler, callBack) {
            
       <? if($allow=="img"){echo " var regexp = /\.(png)|(jpg)|(gif)$/i;";
        } elseif($allow=="pdf"){  echo "var regexp = /\.(pdf)$/i;";
        }?>
            
           <?if($fileLimit):?>
            if(files.length>1){
                if(index===0)alert('Solo se permite un archivo');
                $('#<?=$tablas?> tr').remove();
                return;
            }
            <?endif;?>
            //
            if (!regexp.test(files[index].name)) {   
                <? if($allow=="img"){echo " alert('Solo se permiten imagenes');";
                }elseif($allow=="pdf"){ echo "alert('Solo se permiten archivos PDF');";}?>
                $('#<?=$tablas?> tr').remove();
                
                return;
            }else{
                //dontleave();
            }
            callBack();
        },
        buildUploadRow: function (files, index) {
                return $('<tr><td>' + files[index].name + '<\/td>' +
                    '<td class="file_upload_progress"><div><\/div><\/td>' +
                    '<td class="file_upload_cancel">' +
                    '<button class="ui-state-default ui-corner-all" title="Cancel">' +
                    '<span class="ui-icon ui-icon-cancel">Cancel<\/span>' +
                    '<\/button><\/td><\/tr>');
        },
        buildDownloadRow: function (file) {        
            return $('<tr><td>' + file.name + '<\/td><\/tr>');
        },
        onComplete: function (event, files, index, xhr, handler) {
            handler.onCompleteAll(files);
        },
        onAbort: function (event, files, index, xhr, handler) {
            //handler.removeNode(handler.uploadRow);
            handler.onCompleteAll(files);
        },
        onCompleteAll: function (files) {
            if (!files.uploadCounter) {
                files.uploadCounter = 1;  
            } else {
                files.uploadCounter = files.uploadCounter + 1;
            }
            if (files.uploadCounter === files.length) {
                <?=$onComplete?>
                /* your code after all uplaods have completed */
            }
        }
    });

    </script>