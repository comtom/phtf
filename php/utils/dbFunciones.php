<?php

//Return an associative array. Used on mssql_fetch_array()'s result_type parameter.
define('MSSQL_ASSOC', '1');
//Return an array with numeric keys. Used on mssql_fetch_array()'s result_type parameter.
define('MSSQL_NUM', '2');
//Return an array with both numeric keys and keys with their field name. This is the default value for mssql_fetch_array()'s result_type parameter.
define('MSSQL_BOTH', '3');
//Indicates the 'TEXT' type in MSSQL, used by mssql_bind()'s type parameter.
define('SQLTEXT', '35');
//Indicates the 'VARCHAR' type in MSSQL, used by mssql_bind()'s type parameter.
define('SQLVARCHAR', '39');
//Indicates the 'CHAR' type in MSSQL, used by mssql_bind()'s type parameter.
define('SQLCHAR', '47');
//Represents one byte, with a range of -128 to 127.
define('SQLINT1', '48');
//Represents two bytes, with a range of -32768 to 32767.
define('SQLINT2', '52');
//Represents four bytes, with a range of -2147483648 to 2147483647.
define('SQLINT4', '56');
//Indicates the 'BIT' type in MSSQL, used by mssql_bind()'s type parameter.
define('SQLBIT', '50');
//Represents an four byte float.
define('SQLFLT4', '59');
//Represents an eight byte float.
define('SQLFLT8', '62');


class MSSQL_PDO extends PDO {
    public function __construct($dsn, $username="", $password="", $driver_options=array()) {
        parent::__construct($dsn,$username,$password, $driver_options);
        if (empty($driver_options[PDO::ATTR_STATEMENT_CLASS])) {
            $this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('MSSQL_PDOStatement', array($this)));
        }
    }
}


class MSSQL_PDOStatement extends PDOStatement {
    public $dbh;
    protected function __construct($dbh) {
        $this->dbh = $dbh;
    }

}

class Database {
    
    function getLastLink($link_identifier = null) {
        /*
            devuelve la referencia a la ultima conexion de la DB
        */
        static $last = null;    
        if ($link_identifier) {
            $last = $link_identifier;
        }
        return $last;
    }

    function connect($servername, $username, $password, $new_link = false) {
        /*
            conecta a la DB
        */
        $pdo = new PDO('sqlsrv:Server='.$servername .';', $username, $password);        
        $pdo->setAttribute(PDO::SQLSRV_ENCODING_SYSTEM, 0);

        // tipo de cursor para que ande mssql_num_rows()
        $pdo->setAttribute(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('MSSQL_PDOStatement', array($pdo)));

        $this->getLastLink($pdo);

        return $pdo;
    }

    function selectDB($database_name, $link_identifier = null) {
        /*
            selecciona una DB (sentencia USE, de SQL)
        */
        // @todo probar try/catch 
        // return false on failure

        if (is_null($link_identifier)) {
            $link_identifier = $this->getLastLink();
        }

        $affected = $link_identifier->exec('USE '.$database_name);
        $link_identifier->lastAffected = $affected;

        return true;
    }

    function query($query, $link_identifier = null, $batch_size = 0) {
        /*
            Ejecuta la consulta especificada en el parametro $query
        */
        if (is_null($link_identifier)) {
            $link_identifier = $this->getLastLink();
        }

        // Opciones del driver
        //PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
        //PDO::SQLSRV_ATTR_CURSOR_SCROLL_TYPE => PDO::SQLSRV_CURSOR_BUFFERED
        //PDO::SQLSRV_ATTR_ENCODING => PDO::SQLSRV_ENCODING_UTF8
        $stmt = $link_identifier->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $return = $stmt->execute();

        if ($return) {
            $rows = $stmt->rowCount();
            $link_identifier->lastAffected = $rows;

            if (is_null($rows)) {
                $return = true;
            } else {
                $return = $stmt;
            }
        }
        return $return;
    }

    function getArray($result, $result_type = MSSQL_BOTH) {
        /*
            Devuelve un array con los resultados de la ultima consulta
        */
        $type = array(
                MSSQL_ASSOC => PDO::FETCH_ASSOC,
                MSSQL_NUM => PDO::FETCH_NUM,
                MSSQL_BOTH => PDO::FETCH_BOTH
        );
        return $result->fetch($type[$result_type]);
    }

    function getAssoc($result) {
        /*
            Devuelve un array con las columnas de cada fila del resultado de la ultima consulta
        */
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    function getObject($result) {
        /*
            Devuelve un objeto con los resultados de la ultima consulta
        */
        if ( $result->dbh->lastAffected>0 ) {
            return $result->fetch(PDO::FETCH_OBJ);
        } else {
            return False;
        }
    }

    function getObjectList($result) {
        /*
            Devuelve un array de objetos con los resultados de la ultima consulta
        */
        $list = array();

        while ( $row = $result->fetch(PDO::FETCH_OBJ) ) {
            $list[] = $row;
        }

        return $list;
    }

    function getNumRows($result) {
        /*
            Devuelve el numero de filas que tiene el resultado de la ultima consulta
        */
        return $result->rowCount();
    }

    function getRowsAffected($link_identifier = null) {
        /*
            Devuelve el numero de registros afectados por la ultima consulta
        */
        if (is_null($link_identifier)) {
        }
        return  $link_identifier->lastAffected;
            $link_identifier = $this->getLastLink();
    }
}