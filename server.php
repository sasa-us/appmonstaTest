<?php

define('fromData',true);
if(empty($_GET['action'])){
	exit('no action specified');
}

require_once('mysql_connect.php');

$output = [
    'success' => false,
    'error' => [],
    'data' => []
];

switch($_GET['action']) {
    case 'readAll':
		//include the php file 'read.php'
		include 'dataAPI/read.php';
        break;
        
	case 'insert':
		//include the php file insert.php
		include 'dataAPI/insert.php';
        break;

    case 'insertAPI':
        include 'dataAPI/insertAPI.php';
        break;
}

$output_json = json_encode($output);
print($output_json);

?>