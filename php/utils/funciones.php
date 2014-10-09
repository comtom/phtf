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

function fechahoraDisplay($fecha) {
  $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $fecha);
  return 'Publicado el '. $fecha->format('d/m/Y') .' a las '. $fecha->format('H:i');
}


function fechahoraDB($fecha) {
  $fecha = DateTime::createFromFormat('d/m/Y H:i', $fecha);
  return $fecha->format('Y-m-d H:i:s');
}


function fechaDisplay($fecha) {
  $fecha = DateTime::createFromFormat('Y-m-d', $fecha);
  return @$fecha->format('d/m/Y');
}


function fechaDB($fecha) {
  $fecha = DateTime::createFromFormat('d/m/Y', $fecha);
  return $fecha->format('Y-m-d');
}


// ------------------------------------
// misc
// ------------------------------------

function getGenero($id) {
    if ($id==1) {
        return 'Masculino';
    } elseif ($id==2) {
        return 'Femenino';
    } elseif ($id==3) {
        return '';
    } else {
        return False;
    }
}


function getFotoPerfil($id) {
  global $config;
  $imagen = $config['media'] .'/perfil/'. $id .'.jpg';

  if (file_exists($imagen)) {
    return '/perfil/'. $id .'.jpg';
  } else {
    return '/perfil/nopic.png';
  }
}