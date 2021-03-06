<? if(empty($id))$id="file_upload"?>
<? if(empty($tablas))$tablas="files"?>
<? if(empty($allow))$allow="img"?>
<style> 
    .updateMsj{
        color: #bbb;
    } 
    .updateMsj h1{
        font-size: 20px;
        color: #bbb !important;
    } 
    
.file_upload {
    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    
    margin: 0px;
    position: relative;
    overflow: hidden;
    direction: ltr;
    padding: 20px;
     height: 240px;
        width: 240px;
        text-align: center;
padding: 0;
             background: rgba(250,250,250,0);
             color: #666;
}
.file_upload:hover {

           background: rgba(0,0,0,.1);
           color: #333;

}

.file_upload div{
        color: #666;
        font-size: 12px;
        padding:0px;
        margin-top: 15px;
        margin-bottom: 20px;
    }
.file_upload.full div{
        display: none;
    }
    .file_upload.full:hover div{
        display: block;
    }
.file_upload_small {

}
.file_upload_large div{
   /* display: none;*/
}
.file_upload_large {

            background: #ccc;;
            padding: 0px;
            color: #292929;
} 

.file_upload_highlight {
           background: #ddd;
}

.file_upload input {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  border: 300px solid transparent;
  opacity: 0;
  -ms-filter: 'alpha(opacity=0)';
  filter: alpha(opacity=0);
  -o-transform: translate(-300px, -300px) scale(10);
  -moz-transform: translate(-800px, 0) scale(10);
  cursor: pointer;
}

.file_upload iframe, .file_upload button {
  background: #eee;
        border: 1px solid #bbb;
        border-radius: 3px;
        color: #666;
        font-size: 12px;
        margin: 0px 10px;
}
.file_upload iframe:hover, .file_upload button:hover {
  background: #eee;
        border: 1px solid #999;
        color: #222;
  
}
.file_upload.full button{
        display: none;
    }
    .file_upload.full:hover button{
        display: block;
    }
.file_upload_preview img {
  width: 80px;
}

.updateTableUI{
        height: auto;
        border-collapse: collapse;
        padding: 0px;
        margin: 0px;
        width: 100%;
    }
.file_upload_progress{
    width: 200px;
}
.file_upload_progress .ui-progressbar-value {
  background: #ccc;width: 100%;
  height: 15px;
}


.file_upload_cancel {
  
}
.file_upload_cancel button {
  cursor: pointer;
  max-width: 100%;
  background: rgba(0,0,0,.5);
  color: #ccc;
  border:none;
  border-radius: 10px;
  outline: none;
  cursor: pointer;
  max-height: 20px;
  padding: 0 5px;
  font-size: 11px;
}

button.ui-state-default{
    height: 25px;
    
}
.ui_filename{
    font-size: 12px;
}
.ui-icon-cancel{
    font-size: 12px;
}


#tablasProg{
    position: fixed;
    bottom: 0px;
    right: 0px;
    background: rgba(0,0,0,.5);
    border-radius: 5px;
    max-height: 200px;
    width: 200px;
    color: #fff;
    font-size: 12px;
    
}
</style>
<? if(isset($error))echo $error;?>
<form method="post" enctype="multipart/form-data"  id="<?=$id?>" action="<?=base_url($accion)?>" class="">
            <input type="file" name="userfile" multiple />
            <div class="updateMsj"><?=$titulo?>
                <img src="<?=  style_png('drag-img')?>"></div>
            
            
</form>
<div id="tablasProg">
    <table class="updateTableUI" id="<?=$tablas?>"></table>
        <table class="updateTableUI" id="<?=$tablas?>D"></table>
</div>
        

<script>
        
$('#<?=$id?>').fileUploadUI({
        uploadTable: $('#<?=$tablas?>'),
        downloadTable: $('#<?=$tablas?>D'),
        beforeSend: function (event, files, index, xhr, handler, callBack) {
            
       <? if($allow=="img"){echo " var regexp = /\.(png)|(jpg)|(gif)$/i;";
        } elseif($allow=="pdf"){  echo "var regexp = /\.(pdf)$/i;";
        } elseif($allow=="mp4"){  echo "var regexp = /\.(mp4)$/i;";
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
                }elseif($allow=="pdf"){ echo "alert('Solo se permiten archivos PDF');";
                }elseif($allow=="mp4"){ echo "alert('Solo se permiten videos MP4');";}?>
                $('#<?=$tablas?> tr').remove();
                
                return;
            }else{
                //dontleave();
            }
            callBack();
        },
        buildUploadRow: function (files, index) {
                return $('<tr><td><div  class="ui_filename" >' + files[index].name + '<\/div>' +
                    '<table><tr><td class="file_upload_progress"><div><\/div><\/td>' +
                    '<td class="file_upload_cancel">' +
                    '<button class="ui-state-default ui-corner-all" title="Cancel">' +
                    '<span class="ui-icon ui-icon-cancel">Cancelar<\/span>' +
                    '<\/button><\/td><\/tr><\/table><\/td><\/tr>');
        },
        buildDownloadRow: function (file) {        
            return $('<tr><td class="ui_filename"><input class="uploadedFile" type="hidden" value="' + file.name + '"><\/td><\/tr>');
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