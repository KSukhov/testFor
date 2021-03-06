<?php
/**
 * Created by PhpStorm.
 * User: geol
 * Date: 6/14/15
 * Time: 4:02 AM
 */


class DB {
    public $db;
    function __construct($dbName, $user, $pass, $host= 'localhost', $charset = 'utf8'){
        $dsn = "mysql:host=".$host.";dbname=".$dbName.";charset=".$charset;
        $option = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->db = new PDO($dsn, $user, $pass, $option);
    }
}
