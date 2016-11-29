<?php

global $config;
$config = array();

// environment auto-detection
switch ($_SERVER['SERVER_NAME']) {
    case 'dev.example.org':
        $config['environment'] = 'DEV';
        $config['path'] = '/var/www/php';
        $config['media'] = '/var/www/static';
        $config['uri'] = 'http://dev.example.org';
        break;

    default:
        $config['environment'] = 'PROD';
        $config['path'] = '/var/www/php';
        $config['media'] = '/var/www/static';
        $config['uri'] = 'http://example.org';
    	break;
}

// locales
$config['locale'] = 'es_ES';
$config['date_format'] = "d/m/Y";
$config['time_format'] = "H:i";
$config['datetime_format'] = $config['date_format'] .' '. $config['time_format'];
$config['timeZone'] = 'America/Argentina/Buenos_Aires';

// performance
$config['maxExecTime'] = 60;                // en segundos
$config['cache_expiration_time'] = 30;      // en segundos


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
/*
$config['token_mandrill'] = 'MANDRILL-TOKEN';
$config['email_address'] = 'no-reply@example.com';
$config['email_name'] = 'System notification';
 */
$config['email_host'] = 'smtp.sparkpostmail.com';
$config['email_port'] = '587';
$config['email_user'] = 'SMTP_Injection';
$config['email_key'] = '752d2ee69f68c294d90431a39fc6c0113ad200fd';
$config['email_encr'] = 'tls';


// recaptcha
$config['recaptchaSiteKey'] = '6LcNcyETAAAAAAMBMM29Og3I8ih33uf-sf3Is2Pp';
$config['recaptchaSecret'] = '6LcNcyETAAAAAJeJdgi-tqcQjm3pmlK_6AghPui-';
$config['recaptchaLang'] = 'es-419';


// public views
$vistasPublicas = array(
    'example',
);
