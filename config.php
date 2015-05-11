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
$config['date_format'] = "d/m/Y";
$config['time_format'] = "H:i";
$config['datetime_format'] = $config['date_format'] .' '. $config['time_format'];

// database config
$config['dbengine'] = 'mssql'  // mssql, mysql
$config['dbhost'] = "127.0.0.1";
$config['dbport'] = 3306;
$config['dbsocket'] = "";
$config['dbuser'] = "USERNAME";
$config['dbpassword'] = "PASSWORD";
$config['dbname'] = "DATABASE_NAME";

// email config
$config['token_mandrill'] = 'MANDRILL-TOKEN';
$config['email_address'] = 'no-reply@example.com';
$config['email_name'] = 'System notification';

// public views
$vistasPublicas = array(
    '/example',
    'example',
);

// template may vary if user is logged in
if (isset($_SESSION['logueado'])) {
    $_SESSION['template_base'] = 'base';
} else {
    $_SESSION['template_base'] = 'base';
}
