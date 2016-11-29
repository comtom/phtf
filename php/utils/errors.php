<?php
/*
function _exception_handler($nroError, $descripcion, $archivo, $linea) {
    if (!isset($error)) {
        global $error;
        $error = array();
    }
    array_push($error, $descripcion);
}

// control de excepciones
set_error_handler('_exception_handler');
*/

// verifica la version de Php
if (explode('-', phpversion())[0]<'5.6') {
    @set_magic_quotes_runtime(0); // Kill magic quotes
}
