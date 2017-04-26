<?php
header("Location: ".$_SERVER['HTTP_REFERER']);
//var_dump($_SERVER);
include_once('DB_FNS.php');
if(isset($_POST['email']) && (strlen($_POST['email'])>0)){
	$count = preg_match('/^[^@]+@([a-zA-Z0-9]*)+\.([a-zA-Z]{2,4})$/', $_POST['email'], $matches);
		if($count>0){
			$db = db_connect();
			$data = do_query_get_array($db, "INSERT INTO `Subscribers` (`Email`) VALUES ('".$_POST['email']."')");
		}
}