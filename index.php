<?php 

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: POST");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include "config/autoload.php";
	include "config/main.php";
	include "config/JwtHandler.php";

	include "midlewares/Auth.php";


	$cn = isset($_GET['ctl']) ? $_GET['ctl'] : "home";
	$c = $cn."_controller";
	$controller = new $c;
 ?>