<?php
// var_dump($_POST);
include_once('DB_FNS.php');

function testAnswer($db){
	if(isset($_POST['answer'])){
		$_POST['ID']++;
		parse_str(do_query_get_array($db, "SELECT `COUNTERS` FROM `Interview` WHERE `Question_id` = ${_POST['ID']}")[0]['COUNTERS'], $data);
		$data[$_POST['answer']]++;
		$res = "";
		foreach ($data as $key => $value) {
			$res .= $key . "=" . $value . "&";
		}
		$res = substr($res, 0, strlen($res) - 1);
		do_query_insert($db, "UPDATE `Interview` SET `COUNTERS` = '$res' WHERE `Interview`.`Question_id` = ${_POST['ID']}");
	}
}