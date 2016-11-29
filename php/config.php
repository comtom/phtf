<?php

global $config;
$config = array();

// config de Php
setlocale(LC_ALL, 'es_ES');

// global parameters
$config['path'] = '/var/www/php';
$config['media'] = '/var/www';
$config['defaultView'] = 'example';
$config['defaultLoggedView'] = 'example';

// database config
$config['dbhost'] = "127.0.0.1";
$config['dbport'] = 3306;
$config['dbsocket'] = "";
$config['dbuser'] = "USERNAME";
$config['dbpassword'] = "PASSWORD";
$config['dbname'] = "DATABASE_NAME";

// public views
$vistasPublicas = array(
    '/login',
    'login',
    '/signin',
    'signin',
);

// template may vary if user is logged in
if (isset($_SESSION['logueado'])) {
    $_SESSION['template_base'] = 'base';
} else {
    $_SESSION['template_base'] = 'base';
}
