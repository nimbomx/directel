<style> 
    
    .updateTableUI{
        height: auto;
        border-collapse: collapse;
        padding: 0px;
        margin: 0px;
    }
.file_upload {
    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    color: #ddd;
    margin: 0px;
    position: relative;
    overflow: hidden;
    direction: ltr;
    padding: 10px 20px;
        width: 272px;
        text-align: center;
             border: dashed 1px transparent;
             background: #464646;
}
.file_upload:hover {
border: dashed 1px transparent;
           background: #292929;
           color: #fff;

}

.file_upload_small {

}

.file_upload_large {
 border: dashed 1px #292929;
            background: #ccc;;
            padding: 40px 20px;
            color: #292929;
} 

.file_upload_highlight {
   border: dashed 1px #333;
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
  display: none;
}

.file_upload_preview img {
  width: 80px;
}

.file_upload_progress .ui-progressbar-value {
 /* background: url('<?=base_url('content/style/pbar-ani.gif')?>');*/
  background: #838ebb;
}

.file_upload_progress div {
  width: 225px;
  height: 25px;
}

.file_upload_cancel button {
  cursor: pointer;
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
</style>