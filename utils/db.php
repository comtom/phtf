<?php
global $con;

$con = new mysqli(
    $config['dbhost'],
    $config['dbuser'],
    $config['dbpassword'],
    $config['dbname'],
    $config['dbport'],
    $config['dbsocket'])
    or die ('Base de datos inaccesible' . mysqli_connect_error());

