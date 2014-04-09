<style> 
    
    .updateTableUI{
        height: auto;
    }
.file_upload {
    font-family: 'Roboto Condensed', sans-serif;
    font-size: 16px;
    color: #ddd;
    margin: 0px;
    position: relative;
    overflow: hidden;
    direction: ltr;
    padding: 10px 20px;
        width: 270px;
        text-align: center;
             border: dashed 1px #aaa;
}
.file_upload:hover {
border: solid 1px #666;
           background: rgba(250,250,250,.3);

}

.file_upload_small {

}

.file_upload_large {
 border: dashed 1px #fff;
            background: rgba(250,250,250,.1);
            padding: 40px 20px;
} 

.file_upload_highlight {
   border: dashed 1px #fff;
            background: rgba(250,250,250,.3);
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
  background: url('<?=base_url('content/style/pbar-ani.gif')?>');
}

.file_upload_progress div {
  width: 150px;
  height: 15px;
}

.file_upload_cancel button {
  cursor: pointer;
}
</style>