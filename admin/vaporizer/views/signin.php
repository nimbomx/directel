<!DOCTYPE html>
<html lang="es-mx">
<head>
	<meta charset="utf-8">
        <link rel="shortcut icon" href="<?=web_url('/res/style/favicon.png')?>" type="image/png">
	<title><?=$webname?> - Vaporizer</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
    <?css('signin')?>
    <?js('jquery')?>
<script>

var image = '<?=base_url('res/rain-wallpaper.jpg')?>',
 img = $('<img />');

img.bind('load', function() {
     $('#firstfog').fadeTo(600,.6);
});



$(function(){
    $('#formCanvas, #firma').fadeIn(function(){
        $('#signinNick').focus();
        img.attr('src', image);
        $('body').css({'background-image': 'url("'+ image +'")'}).load(function(){
        });
    });
});

</script>
</head>
<body>
    <div id="firstfog"></div>
    <div id="formContainer">
        <div id="formCanvas">
            <div class="title"> <img src="<?=  style_png('lock')?>">Inicia sesión en <?=$webname?> - Vaporizer</div>
                  <form action="<?=base_url('acciones/login')?>" method="POST">
                      <input id="signinNick" name="nick" autofocus="autofocus" placeholder="Correo electrónico"><br>
                      <input name="clave" type="password" placeholder="Contraseña"><br>
                      <table>
                          <tr>
                              <td class="stayLogged"><input type="checkbox" name="recordar" value="true"> </td>
                              <td class="stayLogged">
                                  Mantener sesión<br><small>Mantener sesión abierta en este equipo.</small>
                              </td>
                              <td class="right"><a href="#">Olvide mi contraseña</a>
                              </td>
                          </tr>
                          <tr>
                              <td class="rightBottom" colspan="3"><button class="animateAll">Iniciar sesión</button></td>
                              
                          </tr>
                      </table>
                      
                      
                    </form>

        </div>
        
    </div>
    <div id="firma">
        <img style="vertical-align: -6px;;" src="<?=style_png('firmaNimbo')?>">
    </div>

</body>
</html>