<?php
if (!isset($config['path'])) exit('Por motivos de seguridad, no podes acceder directamente');
global $con;
// ------------------------------------
// Ruteadores
// ------------------------------------

function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    return false;
}


function template($nombre) {
    global $config;
    return $config['path'].'/templates/'. $nombre .'.php';
}


function javascript($nombre) {
    global $config;
    return $config['path'].'/templates/js/'. $nombre .'.php';
}


function view($nombre) {
    global $config;
    return $config['path'].'/views/'. $nombre .'.php';
}


// ------------------------------------
// fecha y hora
// ------------------------------------

function datetimeDisplay($fecha) {
    global $config;
    //$fecha = DateTime::createFromFormat('Y-m-d H:i:s', $fecha);
    $fecha = new DateTime($fecha);
    return $fecha->format($config['datetime_format']);
}


function datetimeToDB($fecha) {
    global $config;
    //$fecha = DateTime::createFromFormat($config['datetime_format'], $fecha);
    $fecha = new DateTime($fecha);
    return $fecha->format('Y-m-d H:i:s');
}


function datetimeDiff($fecha1, $fecha2){
    $fecha1 = new DateTime($fecha1);
    $fecha2 = new DateTime($fecha2);

    $interval = $fecha1->diff($fecha2);
    return intval($interval->format('%R%a'));
}

function datetimeDiffToday($fecha){
    $fecha1 = new DateTime($fecha);
    $fecha2 = new DateTime();
    
    $interval = $fecha1->diff($fecha2);
    return intval($interval->format('%R%a'));
}

function dateDisplay($fecha) {
    global $config;
    //$fecha = DateTime::createFromFormat('Y-m-d', $fecha);
    $fecha = new DateTime($fecha);
    return @$fecha->format($config['date_format']);
}


function dateToDB($fecha) {
    global $config;
    $fecha = DateTime::createFromFormat($config['date_format'], $fecha);
    
    return $fecha->format('Y-m-d');
}


// ------------------------------------
// misc
// ------------------------------------

function escape_string($data) {
    /*
        limpia datos que se enviaran a consultas SQL
    */

    // valores nullos o vacios
    if ( !isset($data) or empty($data) ) return '';

    // valores numericos
    if ( is_numeric($data) ) return $data;

    // valores booleanos
    if ( $data === True ) {
        return 1;
    } elseif ( $data === False ) {
        return 0;
    }

    // valores string
    $non_displayables = array(
        '/%0[0-8bcef]/',            // url encoded 00-08, 11, 12, 14, 15
        '/%1[0-9a-f]/',             // url encoded 16-31
        '/[\x00-\x08]/',            // 00-08
        '/\x0b/',                   // 11
        '/\x0c/',                   // 12
        '/[\x0e-\x1f]/'             // 14-31
    );
    foreach ( $non_displayables as $regex )
    $data = preg_replace( $regex, '', $data );
    $data = str_replace("'", "&#39;", $data );
    $data = str_replace("ñ", "&ntilde;", $data );
    $data = str_replace("Ñ", "&Ntilde;", $data );

    // reemplazo de sintaxis SQL
    $data = str_replace("/*", "", $data );
    $data = str_replace("*/", "", $data );
    $data = str_replace("--", "", $data );

    $data = str_replace("%", "&#37;", $data );
    $data = str_ireplace (" or ", " ", $data );
    $data = str_ireplace (" and ", " ", $data );
    $data = str_ireplace (" waitfor delay ", " ", $data );
    return $data;
}

function sendEmail($asunto='HELLO', $cuerpo='HELLO', $destinatario_email='123@example.com', $destinatario_nombre='DEFAULT NAME') {
    global $config;
    require_once $config['path'] .'/utils/mandrill/Mandrill.php';
    $mandrill = new Mandrill($config['token_mandrill']);

    $raw_message = 'From: '. $config[''] .'
To:'. $destinatario_email .'
Reply-To: '. $config['email_address'] .'
X-Mailer: PHP'. phpversion() .' 
Subject: '. $asunto .'

'. $cuerpo;

    $from_email = $config['email_address'];
    $from_name = $config['email_name'];
    $to = array(
      "email" => $destinatario_email, 
      "name" => $destinatario_nombre,
      "type" => "to"
      );

    $async = false;
    @$result = $mandrill->messages->sendRaw($raw_message, $from_email, $from_name, $to, $async, null, null, null);

    // verifica si hubo errores al enviar el email
    if (!$result) {
        return False;
    } else {
        return True;
    }
}