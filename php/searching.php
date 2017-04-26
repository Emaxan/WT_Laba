<?php
include_once 'DB_FNS.php';

function search($db){
	
	$req = explode(' ', $_POST['request']);
	
	if (count($req) == 0) return false;
	
	foreach ($req as $key => $value) {
		$req[$key] = trim($value);
	}
	
	$resp = "<div id='peoples' style='text-align: center;'>";
	foreach ($req as $value) {
		if(strlen($value) != 0){
			$data = do_query_get_array($db, "SELECT * FROM `users` WHERE `User_name` = '" . $value . "'");
			//var_dump($data);
			if(count($data) > 0)
				foreach ($data as $user) {
					$resp .= str_replace("{SearchID}",$user['User_id'],file_get_contents('tpl/searchMen.tpl'));
				}
				

			$data = do_query_get_array($db, "SELECT * FROM `users` WHERE `User_second_name` = '" . $value . "'");
			// var_dump($data);
			if(count($data) > 0)
				foreach ($data as $user) {
					$resp .= str_replace("{SearchID}",$user['User_id'],file_get_contents('tpl/searchMen.tpl'));
				}

			$data = do_query_get_array($db, "SELECT * FROM `users` WHERE `User_nickname` = '" . $value . "'");
			// var_dump($data);
			if(count($data) > 0)
				foreach ($data as $user) {
					$resp .= str_replace("{SearchID}",$user['User_id'],file_get_contents('tpl/searchMen.tpl'));
				}
		}
	}
	$resp .= "</div>";
	return $resp;
}