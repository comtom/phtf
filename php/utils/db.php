<?php

if ( $config['dbengine']=='mysql' ) {
    // database connection identifier
    global $con;

    $con = new mysqli(
        $config['dbhost'],
        $config['dbuser'],
        $config['dbpassword'],
        $config['dbname'],
        $config['dbport'],
        $config['dbsocket'])
        or die ('Base de datos inaccesible' . mysqli_connect_error());
} elseif ( $config['dbengine']=='mssql' ) {
    include 'dbFunciones.php';

    // database connection identifier
    global $con;
    global $db;

    $db = new Database();
    $con = $db->connect(
        $config['dbhost'] . $config['dbinstance'],
        $config['dbuser'],
        $config['dbpassword']
        );

    $db->selectDB($config['dbname']);

} else {
    throw new Exception('Please specify a valid DB Engine in config file.');
}
