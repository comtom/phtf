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
    // vista por defecto
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
