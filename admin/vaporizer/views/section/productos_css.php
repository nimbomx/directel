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
    #drafts{
        background: #eee;
    }
    #items button, #drafts button{
        font-size: 10px;
        cursor: pointer;
        height: 40px;
    }
    #pager{
        float: left;
    }
    #upBoletinImgE,#upBoletinImg{
        background-size: cover; 
    }
    #previewImagen{
        height: 240px;
        width: 240px;
        position: relative;
        margin: auto;
    }
    #previewImagen table{
        width: 100%;
        height: 100%;
        vertical-align: middle;
        text-align: center;
    }
    #previewImagen .prev{
        position: absolute;
        bottom: 0px;
        right: 0px;
        background: rgba(0,0,0,0);
        color: #ccc;
        padding: 10px;
        border-radius: 5px;
    }
    #previewImagen:hover .prev{
        background: rgba(0,0,0,.8);
        
    }
    #previewImagen .prev a{
        font-size: 12px;
        margin-left: 10px;
        cursor: pointer;
    }
    #previewImagen img,previewImagenE img{
        max-width: 240px;
        max-height: 240px;
        box-shadow: 0 0 5px rgba(0,0,0,.8);
    }
    
    /*GALLERY*/
    #galleryCanvas{
        position: fixed;
        top: 0px;
        right: 0px;
        left: 0px;
        bottom: 0px;
        background: #fafafa;
        display: none;

    }
    #galleryToolsCanvas{
        position: absolute;
        top: 0px;
        right: 0px;
        left: 0px;
        height: 70px;
        text-align: right;
    }
    #galleryToolsCanvas .title{
        padding: 10px 30px;
        position: absolute;
        top: 0px;
        right: 150px;
        left:0px;
        font-size: 30px;
        font-weight: 300;
        white-space: nowrap;
	overflow: hidden;
        text-overflow: ellipsis;
        text-align: left;
    }
    #galleryToolsCanvas button{
        margin: 10px;
    }
    #galleryItemCanvas{
        position: absolute;
        top: 70px;
        right: 0px;
        left: 0px;
        bottom: 0px;
        overflow: auto;
    }

    #galleryAddItem, .galleryItem{
        width: 250px;
        height: 250px;
        float: left;
        margin: 10px;
        position: relative;
    }
    .galleryItem table{
        border-collapse: collapse;
        width: 100%;
        height: 100%;
        text-align: center;
        vertical-align: middle;
    }
    .galleryItem img{
        max-width: 250px;
        max-height: 250px;
        box-shadow: 0 0 5px rgba(0,0,0,.3);
    }
    .galleryItem .imgTools{
        //background: rgba(0,0,0,.8);
        display: none;
        color: #fff;
        position: absolute;
        top:0px;
        left: 0px;
        right: 0px;
        text-align: right;
    }
    .galleryItem .imgTools button{
        background: #fff;
        color: #000;
        border:none;
        margin: 10px;
        padding: 5px 10px;
        border-radius: 30px;
        cursor: pointer;
        box-shadow: 0 0 10px rgba(0,0,0,.8);
    }
    .galleryItem:hover .imgTools{
        display: block;
    }
</style>