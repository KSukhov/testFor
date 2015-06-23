<?php
/**
 * Created by PhpStorm.
 * User: geol
 * Date: 6/14/15
 * Time: 4:11 AM
 */
error_reporting(E_ALL);
ini_set('display_errors', true);
require_once("classes/db.php");
require_once("classes/clients.php");

$connect = new DB('clode','root','');
$db = $connect->db;
$clients = new Clients($db);
if($_GET['action'] == 'list'){
    $filter = array(
    	'name' => filter_input(INPUT_GET, 'name', FILTER_SANITIZE_MAGIC_QUOTES),
    	'ballance' => filter_input(INPUT_GET, 'name', FILTER_SANITIZE_NUMBER_FLOAT),
    	'hasPhone' => filter_input(INPUT_GET, 'hasPhone', FILTER_VALIDATE_BOOLEAN),
    	'begin' => filter_input(INPUT_GET, 'begin', FILTER_SANITIZE_MAGIC_QUOTES),
    	'end' => filter_input(INPUT_GET, 'end', FILTER_SANITIZE_MAGIC_QUOTES),
    	'from' => filter_input(INPUT_GET, 'from',  FILTER_SANITIZE_NUMBER_FLOAT),
    	'to' => filter_input(INPUT_GET, 'to',  FILTER_SANITIZE_NUMBER_FLOAT),
 	);

    $json = json_encode($clients->getClientList($filter));
    print $json;
}
if($_GET['action'] == 'requestPhone'){
    return $clients->requestPhone(filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL));
}
