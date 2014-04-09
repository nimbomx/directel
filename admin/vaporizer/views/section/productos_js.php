<script>
    var editItemId;
    var table = '<?= $table ?>';
    var elem = [];

    function openPop() {
        $('#formCanvas').hide();
        $('#fog').fadeIn('normal', function() {
            $('#formCanvas').slideDown('fast');
        });
        $('#previewImagen').html('');
    }
    function populate() {
        $.post('<? vap_action('getItemJSON', $table) ?>', {
            id: editItemId
        }, function(e) {
            var obj = jQuery.parseJSON(e);
            prefix = 'p';
            ($('#' + prefix + 'Id').val(obj.id));
            ($('#' + prefix + 'Nombre').val(obj.nombre));
            ($('#' + prefix + 'Frase').val(obj.frase));
            ($('#pDescripcioncorta').val(obj.descripcioncorta));
            $('#pDescripcion').val(obj.descripcion);
            ($('#pHigh_status').val(obj.high_status));
            ($('#' + prefix + 'Precio').val(obj.precio));
            ($('#' + prefix + 'Cantidad').val(obj.cantidad));
            ($('#' + prefix + 'Ubicacion').val(obj.ubicacion));
            ($('#' + prefix + 'Imagen').val(obj.imagen));
            if (obj.pub_status==='published'){
                $('#pPub').attr('checked', 'checked');
            }else{
                $('#pPub').removeAttr('checked');
            }
            $('.pNuevousado').each(function() {
                if ($(this).val() === obj.nuevousado)
                    $(this).attr('checked', 'checked');
                else
                    $(this).removeAttr('checked');
            });
            openPop();
            showPrevImg(obj.imagen);
        });
    }

    function newItem() {
        $.post('<? vap_action('newItem', $table) ?>', function(e) {
            editItemId = e;
            populate();
        });
    }
    function cancel() {
        closeFogForm();
        $.post('<? vap_action('cancelItemEdit', $table) ?>', {id: editItemId}, function() {
            editItemId = '';
        });
    }

    function guardarCambios(prefix) {
        id = ($('#' + prefix + 'Id').val());
        nombre = ($('#' + prefix + 'Nombre').val());
        frase = ($('#' + prefix + 'Frase').val());
        descripcioncorta= ($('#pDescripcioncorta').val());
        descripcion= ($('#pDescripcion').val());
        precio = ($('#' + prefix + 'Precio').val());
        imagen = ($('#' + prefix + 'Imagen').val());
        cantidad = ($('#' + prefix + 'Cantidad').val());
        ubicacion = ($('#' + prefix + 'Ubicacion').val());
        high_status = ($('#pHigh_status').val());
        pub_status = 'draft';
        if($('#pPub:checked').val())pub_status = $('#pPub:checked').val();
        nuevousado = $('.pNuevousado:checked').val();
        $.post('<? vap_action('saveItemChanges', $table) ?>', {
            id: id,
            nombre: nombre,
            imagen: imagen,
            frase: frase,
            descripcioncorta:descripcioncorta,
            descripcion:descripcion,
            precio: precio,
            nuevousado: nuevousado,
            cantidad: cantidad,
            ubicacion: ubicacion,
            pub_status:pub_status,
            high_status:high_status,
            vap_itemstatus: ''
        }, function(e) {
            location.reload();
        });
    }
    function deltmpimg(prefix) {
        elem = [];
        $('#previewImagen' + prefix).html('');
        $('#pImagen' + prefix).val('');
    }

    function showPrevImg2() {
        if (elem == '') {
            $('#previewImagen').html('');
            return false;
        }
        vc = '<a onclick="editGallery();">Editar galería (' + elem.length + ' imagenes)</a>';
        $('#previewImagen').html('<table><tr><td><img src="<?= web_url('res/') ?>/' + table + '/' + elem[0] + '"></td></tr></table><div class="prev">' + vc + '</div>');
    }
    function showPrevImg(imgs) {
        elem = imgs.split(',');
        showPrevImg2();
    }
    var printImg = function() {
        if (elem == '')
            elem = [];
        $('.uploadedFile').each(function() {
            elem.push($(this).val());
        });
        $('#tableImgD tr').remove();
        elemString=elem.join();
        $.post('<?php vap_action('saveGalleryAddImg', $table) ?>',{
            id:editItemId,
            imagen:elemString
        },function(e){
            $('#pImagen').val(e);
            elem = e.split(',');
        });
        showPrevImg2();
    };
    $(function() {

        $('.archBtn').click(function() {
            if (!confirm('¿Seguro que desea archivar este elemento?'))
                return false;
            id = $(this).attr('data-id');
            $.post('<? vap_action('archiveItem', $table) ?>', {
                id: id
            }, function() {
                location.reload();
            });
        });
        $('.delBtn').click(function() {
            if (!confirm('¿Seguro que desea eliminar este elemento?'))
                return false;
            id = $(this).attr('data-id');
            $.post('<? vap_action('removeItem', $table) ?>', {
                id: id
            }, function() {
                location.reload();
            });
        });
        $('.editBtn').click(function() {
            editItemId = $(this).attr('data-id');
            populate();
        });
    });

    //GALLERY
    function openEditGallery(e) {
        editItemId = ($(e).attr('data-id'));
        buildGalleryCanvas('body');
    }
    function delGalleryItem(e) {
        item=$(e).parent().parent();
        img=(item.attr('data-img'));
        item.hide('fast',function(){
            item.remove();
        });
        $.post('<? vap_action('removeGalleryItem', $table) ?>', {
            id: editItemId,
            img:img
        },function(e){
            elem = e.split(',');
        });
    }
    function editGallery() {
        buildGalleryCanvas('#fog');
    }
    function buildGalleryCanvas(e) {
        imgtools='<div class="imgTools"><button onclick="delGalleryItem(this);">ELIMINAR</button></div>';
        tools = '<div class="title"></div>';
        tools += '<button class="topButton" onclick="closeGallery();">Cerrar</button>';
        $(e).append('<div id="galleryCanvas"><div id="galleryToolsCanvas">' + tools + '</div><div id="galleryItemCanvas"><div class="inner"></div><div id="galleryAddItem"></div></div></div>');
        $('#galleryCanvas').fadeIn(200);

        $.post('<? vap_action('getGalleryInfo', $table) ?>', {
            id: editItemId
        }, function(e) {
            var obj = jQuery.parseJSON(e);
            gallery = obj.imagen;
            elem = gallery.split(',');
            $('#galleryToolsCanvas .title').hide().html('Galería "'+obj.nombre+'"').fadeIn();
            $.post('<? vap_action('getGalleryAddImg', $table) ?>', function(e){
                $('#galleryAddItem').html(e);
            });
            for (var x in elem) {
                $('#galleryItemCanvas .inner').append('<div class="galleryItem" data-img="'+elem[x]+'">'+imgtools+'<table><tr><td><img src="<?= base_url('img/max/250/' . $table) ?>/' + elem[x] + '"></td></tr></table></div>');
            }
            
        });

    }
    function printImgGallery(){
        imgtools='<div class="imgTools"><button onclick="delGalleryItem(this);">ELIMINAR</button></div>';
        if (elem == '')elem = [];
        $('.uploadedFile').each(function() {
            elem.push($(this).val());
        });
        elemString=elem.join();
        $('#tableImgGD tr').remove();
        $('#pImagen').val(elemString);
        $.post('<? vap_action('saveGalleryAddImg', $table) ?>',{
            id:editItemId,
            imagen:elemString
        },function(e){
            elem = e.split(',');
            $('.galleryItem').remove();
            for (var x in elem) {
                $('#galleryItemCanvas .inner').append('<div class="galleryItem" data-img="'+elem[x]+'">'+imgtools+'<table><tr><td><img src="<?= base_url('img/max/250/' . $table) ?>/' + elem[x] + '"></td></tr></table></div>');
            }
        });
        showPrevImg2();
    }
    function closeGallery() {
        $('#galleryCanvas').animate({'zoom': .3, 'opacity': 0}, 200, function() {
            $('#galleryCanvas').remove();
        });
    }
</script>