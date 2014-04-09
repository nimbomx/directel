<!DOCTYPE html>
<html lang="es-mx">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width" /><? /**/ ?>
        <title><?= $title ?></title>

        <link rel="icon" type="image/jpeg" href="<?= style_png('favicon') ?>?2"> <!-- For good browsers. -->
        <link rel="SHORTCUT ICON" href="<?= base_url('res/style/favicon.ico') ?>"/> <!-- For Internet Explorer-->

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="<?= base_url('css/desktop') ?>" />
        <? /* <link rel="stylesheet" type="text/css" href="<?= base_url('css/device') ?>" media="only screen and (max-width: 660px)" />
        <link rel="stylesheet" type="text/css" href="<?= base_url('css/desktop') ?>" media="screen and (min-width: 661px)" />
        <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?= base_url('css/explorer') ?>" media="all" />
        <![endif]-->
        */ ?>

        <script src="<?= base_url('res/js/jquery.js') ?>"></script>    
        <style>
            body{
                background: url('<?= style_png('backgroundCont') ?>') top right no-repeat; 
                background-size: cover;
            }
            #selectCity::-ms-expand {
                display: none;
            }
            #selectCity{
                outline: none;
                -moz-appearance: none;
                -webkit-appearance: none;
                /* -moz-appearance: window; */
                -moz-appearance: none;
                text-indent: 0.01px;
                text-overflow: '';
                border: 0px;
                background: url('<?= style_png('triangulo') ?>') no-repeat right;
                padding: 0px 15px 0px 0px;
                font-size: 18px;
                font-family: 'Open Sans', sans-serif;
                font-weight: 300;
                color: rgb( 124, 124, 124 );
                line-height: 1.667;
                text-align: right;
                direction: rtl;
                margin-right: 10px;

            }
            #selectCity option{
                text-align: center;
                direction: ltr;
            }
            #header{
                width: 100%;
                height: auto;
                background-image: -moz-linear-gradient( 90deg, rgb(239,239,239) 0%, rgb(255,255,255) 100%);
                background-image: -webkit-linear-gradient( 90deg, rgb(239,239,239) 0%, rgb(255,255,255) 100%);
                background-image: -ms-linear-gradient( 90deg, rgb(239,239,239) 0%, rgb(255,255,255) 100%);
                box-shadow: 0.5px 0.866px 5px 0px rgb( 1, 1, 1 );
                padding-top: 15px;
                padding-bottom: 15px;
                display: table;
                /* z-index: 137; */
            }
            #header .inner{
                vertical-align: middle;
                text-align: left;
                width: 980px;
                height: 50px;
                margin: auto;
            }
            #search{
                outline: none;
                width: 316px;
                height: 30px;
                border-radius: 10px;
                background: url('<?= style_png('lupitagris') ?>') no-repeat right;
                font-size: 16px;
                font-family: 'Open Sans', sans-serif;
                font-weight: 300;
                color: rgb( 86, 86, 86 );
                padding: 0px 10px;
            }
            .footer{
                clear: left;
                width: 100%;
                height: auto;
                z-index: 8;
                background-image: -moz-linear-gradient( 90deg, rgb(0,158,226) 0%, rgb(0,178,255) 100%);
                background-image: -webkit-linear-gradient( 90deg, rgb(0,158,226) 0%, rgb(0,178,255) 100%);
                background-image: -ms-linear-gradient( 90deg, rgb(0,158,226) 0%, rgb(0,178,255) 100%);
                box-shadow: 0.5px 0.866px 5px 0px rgb( 1, 1, 1 );
                position: fixed;
                bottom: 0px;
            }
            .footer div h1 {
                display: block;
                font-size: 14px;
                font-family: "Century Gothic";
                color: rgb( 255, 255, 255 );
                text-align: center;
                font-weight: normal;
               
            }
            .develop {
                position: relative;
                bottom: 15px;
                text-align: center;
                font-size: 11px;
                color: white;
                margin-top: 15px;
                text-decoration: line-through;
            }
        </style>
        <script>
            $(function() {
                $('#selectCity').on('change', function() {
                    $('#selectCity').blur();
                    //alert(this.value); // or $(this).val()
                });
            })

        </script>
    </head>
    <body>
        <div id="header">
            <div class="inner">
                <img src="<?= style_png('logo') ?>">
                <div style="float: right; padding-top: 10px;">
                    <select id="selectCity">
                        <?php foreach ($this->db->get('ciudad')->result() as $ciudad): ?>
                            <option value="<?= $ciudad->clave ?>"><?= $ciudad->nombre ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input id="search" placeholder="¿Qué estás buscando?">
                </div>
            </div>
        </div>
        <div style="width: 980px; margin: auto;">
            <table style="width: 100%;">
                <tr>
                    <td>
                        <h1>Categorías</h1>
                        <?php foreach ($this->db->get('ciudad')->result() as $ciudad): ?>
                        <div></div>
                        <?php endforeach; ?>
                    </td>
                    <td style="width: 300px;">
                        <h1>Promociones</h1>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style=" padding: 20px; background: rgba(0,0,0,.5)">{banner inferior}</div>
                    </td>
                </tr>
            </table>
            
        </div>
        <div class="footer">
            <div><h1>direcTel® Todos los derechos reservados // San Luis Potosí, México 2013</h1><div class="develop">developed by Proyectos Voronoi S.C.</div></div>
        </div>
    </body>
</html>