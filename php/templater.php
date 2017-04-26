<?php
$time = date("D, d M o H:i:s");	
header("Last-Modified: $time GMT");
include_once('DB_FNS.php');
	$templates = array(	
		0=>"/{NAMEPARAM}/",	
		1=>"/{CURRENTYEAR}/",
		2=>"/{([123])}/",
		3=>"/{CONFIG;VALUE='([^\']+)'}/",
		4=>"/{VAR;VALUE='([^\']+)'}/",
		5=>"/{FILE='(.*?)';NUMBER='([0123456789]*?)';TABLE='(.*?)'}/",
		6=>"/{FILE='(.*?)';NUMBER='([0123456789]*?)'}/",
		7=>"/{FILE='(.*?)'}/",
		8=>"/{FILE='(.*?)';RANDOMID}/",
		9=>"/{DATABASE;TABLE='([^\']*?)';FIELD='([^\']*?)';ID='([0123456789]*?)'}/",
		10=>"/{DATABASE;TABLE='([^\']*?)';FIELD='([^\']*?)';ID='([0123456789]*?)';MENID='(.*?)'}/",
		11=>"/{IF\s*'\s*([^\']+)\s*'\s*(<|>|==|!=|<=|>=)\s*'\s*([^\']+)\s*'\s*}([^\{]+)({\s*ELSE\s*}([^\{]+))?{\s*ENDIF\s*}/",
		12=>"/{ERRORS}/",
		13=>"/{ANSWERS;ID='([0123456789]*?)'}/",
		14=>"/{JOIN;TYPE='([^\']*?)';TABLE1='([^\']*?)';TABLE2='([^\']*?)';FIELD1='([^\']*?)';FIELD2='([^\']*?)';FIELD3='([^\']*?)';ID='([0123456789]*?)'}/",
	);

	$replaces = array(	
		0=>function($matches){return Templater::SetName($matches);},	
		1=>function($matches){return Templater::SetYear($matches);},	
		2=>function($matches){return Templater::SetViewPage($matches);},
		3=>function($matches){return Templater::SetConfigField($matches);},
		4=>function($matches){return Templater::SetVarField($matches);},
		5=>function($matches){return Templater::SetFile($matches);},
		6=>function($matches){return Templater::SetFile($matches);},
		7=>function($matches){return Templater::SetFile($matches);},
		8=>function($matches){return Templater::SetFileRandom($matches);},
		9=>function($matches){return Templater::SetDatabaseField($matches);},
		10=>function($matches){return Templater::SetDatabaseField($matches);},
		11=>function($matches){return Templater::SetIfField($matches);},
		12=>function($matches){return Templater::SetErrors();},
		13=>function($matches){return Templater::SetAnswers($matches[1]);},
		14=>function($matches){return Templater::JOIN($matches);}
	);

class Templater{
	static public $db;
	static public $pageName = "";

	function __construct(){
		self::$db = db_connect();
	}

	static public function SetAnswers($id){
		$res = "";
		$id++;
		$data = do_query_get_array(self::$db, "SELECT * FROM `Interview` WHERE `Question_id` = $id");
		parse_str($data[0]['Answers'], $ans);
		foreach ($ans as $key => $v) {
			$res .= str_replace('{ID}',$key,str_replace('{ANSWER}',$v,file_get_contents('tpl/Answer.tpl')));
		}
		return $res;
	}

	static public function SetErrors(){
		$res = "";
		if(isset($GLOBALS['ERRORS']) && (count($GLOBALS['ERRORS']) > 0)) {
			$res = "<div class='border border-down container-fluid' style='text-align: center;'>";
			foreach ($GLOBALS['ERRORS'] as $value) {
				$res = $res."<div class='row'><label style='color:red;'>".$value."</label></div>";
			}
			$res = $res."</div>";
		}
		return $res;
	}

	static public function SetConfigField($matches){
		$config = file_get_contents("config.conf");
		preg_match("/^${matches[1]}=(.*)$/", $config, $arr);
		return $arr[1];
	}

	static public function SetVarField($matches){
		if(isset($GLOBALS['VAR'][$matches[1]]))
			return $GLOBALS['VAR'][$matches[1]];
		else
			return "";
	}

	static public function SetIfField($matches){
		$var1 = $matches[1];
		$var2 = $matches[3];
		switch ($matches[2]) {
			case '<':
				$result = $var1 < $var2;
				break;
			case '>':
				$result = $var1 > $var2;
				break;
			case '==':
				$result = $var1 == $var2;
				break;
			case '!=':
				$result = $var1 != $var2;
				break;
			case '<=':
				$result = $var1 <= $var2;
				break;
			case '>=':
				$result = $var1 >= $var2;
				break;
		}
		return $result ? $matches[4] : (isset($matches[6]) ? $matches[6] : "");
	}

	static public function GetFileContent($path){
		if(isset($_GET['id'])) return str_replace('{GETMYID}', $_GET['id'], file_get_contents($path));
		return file_get_contents($path);
	}

	static public function GetFileContentNTimes($path, $count){
		$text = self::GetFileContent($path);
		$res = "";
		$number = intval($count);
		for ($i=0; $i < $number; $i++) { 
			$res = $res.str_replace('{MYID}', $i, $text);
		}
		return $res;
	}

	static public function GetFileContentNTimesWithDbCheck($path, $count, $table){
		$text = self::GetFileContent($path);
		$res = "";
		$number = intval($count);
		$DbCount = count(do_query_get_array(self::$db,"SELECT * FROM $table"));
		for ($i=0; ($i < $number) && ($i < $DbCount); $i++) { 
			$res = $res.str_replace('{MYID}', $i, $text);
		}
		return $res;
	}

	static public function SetFile($matches){
		if(isset($matches[3])){
			return self::GetFileContentNTimesWithDbCheck($matches[1], $matches[2], $matches[3]);
		}
		if(isset($matches[2])){
			return self::GetFileContentNTimes($matches[1], $matches[2]);
		}
		return self::GetFileContent($matches[1]);
	}

	static public function SetFileRandom($matches){
		$data = do_query_get_array(self::$db, "SELECT * FROM `Interview`");
		return str_replace("{RANDOMID}",mt_rand(0, count($data)-1),self::GetFileContent($matches[1]));
	}

	static public function SetName($matches){
		return self::$pageName;
	}

	static public function SetYear($matches){
		return date('Y');
	}

	static public function SetDatabaseField($matches, $id=1){
		if(isset($matches[3])) $id=intval($matches[3]);
		if(isset($matches[4])) $id=intval($matches[4]);
		$data = do_query_get_array(self::$db, "SELECT * FROM $matches[1]");
		//var_dump($data);
		return $data[$id][$matches[2]];
	}

	static public function JOIN($matches){
		/*SELECT * FROM `users` JOIN `Photographers` ON `users`.`User_id` = `Photographers`.`Photographer_id`*/
		$matches[1] = strtoupper($matches[1]);
		$data = do_query_get_array(self::$db, "SELECT * FROM `${matches[2]}` ${matches[1]} JOIN `${matches[3]}` ON `${matches[2]}`.`${matches[4]}` = `${matches[3]}`.`${matches[5]}`");
		//var_dump($data);
		return $data[intval($matches[7])][$matches[6]];
	}

	static public function SetViewPage($matches){
		switch ($matches[1]) {
			case '1':
				return "Model";
			case '2':
				return "Photographer";
			case '3':
				return "Nobody";
		}
	}

	public function Set($template, $replace, &$target){
		$count = 0;
		//var_dump($template);
		$target = preg_replace_callback($template, $replace, $target, -1, $count);
		if($count>0){
			//print_r($target);
			//var_dump($template);
		}
		return $count;
	}
}