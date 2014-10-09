<?php
if (!isset($config['path'])) exit('You cannot access directly to this url. <a href="/">Reload the application</a>');

global $params;

/* 
 * Query example, modify as you like
 * 
$solicitud_id = trim($params[0]);

if ($solicitud_id!='') {
    $query = "CALL confirmarSolicitud(?, ?);";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('ii', $_SESSION['usrId'], $solicitud_id);
        $stmt->execute();

        if ($stmt->affected_rows!=1) {
            $stmt->close();
            header('location: /500');
        }
        $stmt->close();
    }
}

*
*/

$contenido = get_include_contents(template('example'));

include template($_SESSION['template_base']);
