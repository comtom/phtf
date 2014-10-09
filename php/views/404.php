<?php
if (!isset($config['path'])) exit('Por motivos de seguridad, no podes acceder directamente');


$contenido = '<div class="ui segment" style="margin:20px auto; text-align:center; max-width:960px; font-family:\'Helvetica\'">
    <h2 style="font-size:3em; margin:0px; color:#888;">Error</h2><h1 style="color:#333; font-size:10em; margin:-40px;">404</h1><br>
    <h2 style="color:#666;">Lo que estabas buscando no est&aacute; aqu&iacute;.</h2>
    <a href="/">Continua buscando en la p&aacute;gina principal</a></div>';

include template($_SESSION['template_base']);