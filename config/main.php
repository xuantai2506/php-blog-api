<?php
// Config global constant variable
define('RootURL', 'http://'.$_SERVER["SERVER_NAME"].dirname($_SERVER['REQUEST_URI']).'/');
define('RootURI', dirname($_SERVER['SCRIPT_FILENAME']));

// Config for database
define('DB_HOST','localhost');
define('DB_USER','xuantai');
define('DB_PASSWORD','Xuantai!@2506');
define('DB_NAME','blog');

// Global variables
$app = [];
$mediaFiles = [
	'css'	=>	[],
	'js'	=>	[]
];

$obMediaFiles = $mediaFiles;
//define('OB',true);

$enableOB = false;

?>
