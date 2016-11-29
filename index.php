<?php
session_start();

// load configuration
include 'config.php';

// load exceptions handler
include 'utils/errores.php';

// load database conection
include 'utils/db.php';

// load functions
include 'utils/funciones.php';

// set locales
setlocale(LC_ALL, $config['locale']);

// set max execution time
set_time_limit($config['maxExecTime']);

// system locales
date_default_timezone_set($config['timeZone']);

// cache expiration
$cache_expiration_time = $config['cache_expiration_time'];
$fecha = date('D, d M Y H:i:s', strtotime("+2 hours +$cache_expiration_time seconds"));;
header('Expires: '. $fecha .' GMT');

// template may vary if user is logged in
if (isset($_SESSION['logueado']) and $_SESSION['logueado']) {
    $_SESSION['template_base'] = $config['baseLoggedTemplate'];
} else {
    $_SESSION['template_base'] = $config['baseTemplate'];
}

// parse url, detect view from url and set params array
$query = parse_url($_SERVER['REQUEST_URI']);

if (isset($query['query'])) {
    $view = $query['query'];
} elseif (isset($query['path'])) {
    $q = explode('/', $query['path']);

    if (count($q)==1) {
        $view = $q[2];
    } else {
        $view = $q[1];
    }
} else {
    $view = '';
}

global $params;
$params = array();
$j = 1;

for ($i=2; $i<=5; $i++) {
    if (isset($q[$i])){
        array_push($params, $q[$i]);
    }
}

// show selected view or show default if there is no session 
if (trim($view)=='' or trim($view)=='/') {
    // set default view
    if (isset($_SESSION['logueado'])) {
        $default = $config['defaultLoggedView'];
    } else {
        $default = $config['defaultView'];
    }
    include( view($default) );
} else {
    if (!file_exists( view($view) )) {
        // 404 error, view does not exist
        header('location: /404');
    } else {

        // session control
        if (in_array($view, $vistasPublicas, true) or isset($_SESSION['logueado'])) {
            include( view($view) );
        } else {
            // this view it's not public
            include( view($config['defaultView']) );
        }

    }
}

if (isset($error[1])) {
    echo '<br><br><div class="ui page segment"><h2>Error</h2><br>';
    var_dump($error);
    echo '</div>';
}
?>
