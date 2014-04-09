<!DOCTYPE html>
<html lang="es-mx">
<head>
    	<meta charset="utf-8">
        <link rel="shortcut icon" href="<?=web_url('/res/style/favicon.png')?>" type="image/png">
	<title><?=$webname?> - Vaporizer</title>
        <link href='//fonts.googleapis.com/css?family=Roboto:300,400,500|Roboto+Condensed' rel='stylesheet' type='text/css'>
        <?css('vaporizer')?>
        <?js('jquery')?>
        <?js('ui')?>
        <?js('fileupload')?>
        <?js('fileupload-ui')?>
        <script>
            function closeFogForm(){
                $('#formCanvas,#formCanvasE').slideUp('fast',function(){
                    $('#fog').fadeOut();
                });
            }
        </script>
</head>
<body>
    
