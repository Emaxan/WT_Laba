<?php
//var_dump($_POST);
//var_dump($_FILES);
include_once('DB_FNS.php');

function testPost(){
	$GLOBALS['ERRORS'] = array();
	$firstname = $_POST['firstname']; 
	$firstname = stripslashes($firstname);
	$firstname = htmlspecialchars($firstname);
	$firstname = trim($firstname);
	$lastname = $_POST['lastname']; 
	$lastname = stripslashes($lastname);
	$lastname = htmlspecialchars($lastname);
	$lastname = trim($lastname);
	$login = $_POST['nickname']; 
	$login = stripslashes($login);
	$login = htmlspecialchars($login);
	$login = trim($login);
	$password = $_POST['password'];
	$password = stripslashes($password);
	$password = htmlspecialchars($password);
	$password = trim($password);
	$confirm = $_POST['confirm_password'];
	$confirm = stripslashes($confirm);
	$confirm = htmlspecialchars($confirm);
	$confirm = trim($confirm);
	if ($firstname == '') {
		$GLOBALS['ERRORS'][1] = "First name is wrong";
	}
	if ($lastname == '') {
		$GLOBALS['ERRORS'][2] = "Last name is wrong";
	}
	if ($login == '') {
		$GLOBALS['ERRORS'][3] = "Login is wrong";
	}
	if ($password == '') {
		$GLOBALS['ERRORS'][5] = "Password is wrong";
	}
	if ($confirm == '') {
		$GLOBALS['ERRORS'][6] = "Repeated password is wrong";
	}
	if ($confirm != $password) {
		$GLOBALS['ERRORS'][6] = "Repeated password differ from password";
	}
	if(!checkdate(intval($_POST['bMonth']), intval($_POST['bDay']), intval($_POST['bYear']))){
		$GLOBALS['ERRORS'][7] = "Birthday date is wrong";
	}
	if((!isset($_POST['agree'])) || ($_POST['agree']!='on')){
		$GLOBALS['ERRORS'][8] = "Please accept our policy";
	}
		
	if (!empty($_FILES['ava'])){
			$ava = $_FILES['ava']['name'];
			$ava = trim($ava);
			if($ava == '' or empty($ava)) {unset($ava);}
		}
	if(!isset($ava) or empty($ava) or $ava=='') $path_to_ava = 'img/usr/NO_AVA.jpg';
	else{
		$path_to_ava = 'img/usr/';
		$filename = time();
		$source = $_FILES['ava']['tmp_name'];
		$path_to_ava = $path_to_ava . $filename;
		$ava = $path_to_ava . $filename;
		move_uploaded_file($source, $path_to_ava);
	}
	if(count($GLOBALS['ERRORS']) === 0){
		$DB = db_connect();
		$myrow = do_query_get_array($DB, "SELECT `User_id` FROM `users` WHERE `User_nickname`='".$login."'");
		if (!empty($myrow[0]['User_id'])) $GLOBALS['ERRORS'][3]="This nickname already in use. Enter another nickname";
			
		$count = preg_match('/^[^@]+@([a-zA-Z0-9]*)+\.([a-zA-Z]{2,4})$/', $_POST['email'], $matches);
		if($count>0){
			$data = do_query_get_array($DB, "SELECT * FROM users");
			$InDB = false;
			foreach ($data as $key => $value) {
				if($value['User_email']==$matches[0]){
					$InDB = true;
				}
			}
			
			if(!$InDB){
				$id = count($data);
				
				$data1 = do_query_get_array($DB, "INSERT INTO `users` (`User_id`, `User_profession`, `User_name`, `User_second_name`, `User_nickname`, `User_password`, `User_email`, `User_avatar`, `User_regday`, `User_bday`) VALUES ('".$id."', '".$_POST['YouAre']."', '".$firstname."', '".$lastname."', '".$login."', '".$password."', '".$_POST['email']."', '".$path_to_ava."', '".date("Y-m-d")."', '".$_POST['bYear'].'-'.$_POST['bMonth'].'-'.$_POST['bDay']."')");
				
				$table = $_POST['YouAre']==0?"Nobody":$_POST['YouAre']==1?"Model":"Photographer";
				
				$data2 = do_query_get_array($DB, "INSERT INTO `".$table."s` (`".$table."_id`) VALUES ('".$id."')");

			}
			else $GLOBALS['ERRORS'][4]="This email already in use. Enter another email.";
		}
		else $GLOBALS['ERRORS'][4]="Incorrect email";
	}
}