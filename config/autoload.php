<?php
function __autoload($classname) {
	if(strpos($classname, 'controller'))
		$filename = "controllers/". $classname .".php";
	if(strpos($classname, 'model'))
		$filename = "models/". $classname .".php";
	if(strpos($classname, 'helpers'))
		$filename = "views/helpers/". $classname .".php";
	if(strpos($classname, '_Component')) {
		$comFolder = str_split($classname, strrpos($classname, '_'))[0];
		$filename = "components/".$comFolder.'/'. $classname .".php";
	}
	if($classname == "ConnectDB")	$filename = "config/". $classname .".php";

    include_once($filename);
}
