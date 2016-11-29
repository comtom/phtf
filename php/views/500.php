<?php
if (!isset($config['path'])) exit('Por motivos de seguridad, no podes acceder directamente');


$contenido = '<div class="ui segment" style="margin:20px auto; text-align:center; max-width:960px; font-family:\'Helvetica\'">
    <h2 style="font-size:3em; margin:0px; color:#888;">Error</h2><h1 style="color:#333; font-size:10em; margin:-40px;">500</h1><br>
    <h2 style="color:#666;">Ha ocurrido un error interno en el servidor.<br>
    Intente nuevamente m&aacute;s tarde.</h2></div>';

include template($_SESSION['template_base']);