<?php
    function mandar_mail($hacia = 'keweb@hotmail.com', $subject = 'Mail de la página', $mensaje = '', $fromaddress = '',$nombre='Página web',$replyaddress='', $sIP = '') {
                  $eol = PHP_EOL;
                  $cleansubject=$subject;
                  $subject="=?UTF-8?B?".base64_encode($subject)."?=";
                  $nombre="=?UTF-8?B?".base64_encode($nombre)."?=";
                  if($mensaje=='')$mensaje='<html><head><title>'.$cleansubject.'</title></head><body>Prueba [á,é,í,ó,ú,ñ]';
                  if ($sIP == '') $sIP = md5($subject.date('dmY'));
                  if ($fromaddress == '') {$fromaddress = '"'.$nombre.'" <noreply@'.$_SERVER['SERVER_NAME'].'>';}
                  else{
                      $fromaddress= '"'.$nombre.'" <'.$fromaddress.'>';
                  }
                  if($replyaddress=='')$replyaddress=$fromaddress;
                  $headers = 'From: '.$fromaddress.$eol; // de ...
                  $headers.= 'Reply-To: '.$replyaddress.$eol; // responder a...
                  /*$headers.= 'Return-Receipt-To: '.$fromaddress.$eol; // responder a...*/
                  $headers.= 'Return-Path: '.$fromaddress.$eol; // responder a...
                  $headers.= 'Message-ID: <'.time().' no-reply@'.$_SERVER['SERVER_NAME'].'>'.$eol; // anti-spam
                  $headers.= 'X-Mailer: MyMailer v0.001'.$eol;  // info
                  $headers.= 'Content-Type: multipart/alternative; boundary="'.$sIP.'"'.$eol.$eol;  // anti-spam
                  // En caso de que no podamos leer html \\
                  $msg  = '--'.$sIP.$eol;
                  $msg .= 'Content-Type: text/plain; charset=iso-8859-1'.$eol;
                  $msg .= 'Content-Transfer-Encoding: 7bit'.$eol.$eol;
                  $msg .= 'Este e-mail requiere que active HTML.'.$eol;
                  $msg .= 'Si usted esta leyendo esto, por favor actualice su cliente de correo.'.$eol;
                  $msg .= 'Acentos y tildes omitidos con intencion.'.$eol;
                  $msg .= '------- Mensaje cortado -------'.$eol.$eol;

                  // Lo "normal", que podamos leer html \\
                  $msg .= '--'.$sIP.$eol;
                  $msg .= 'Content-Type: text/html; charset=utf-8'.$eol;
                  $msg .= 'Content-Transfer-Encoding: 7bit'.$eol.$eol;

                  $msg .= $mensaje.$eol.$eol;

                  ini_set('sendmail_from',$fromaddress); // anti-spam
                  if (mail($hacia, $subject, wordwrap($msg,70,$eol), $headers)) {
                    return TRUE;
                  }
                  else {
                    return FALSE;
                  }
        }
        function createPassword($length) {
            $chars = "234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $i = 0;
            $password = "";
            while ($i <= $length) {
                $password .= $chars{mt_rand (0,strlen ($chars))};
                $i++;
            }
            return $password;
        }
?>
