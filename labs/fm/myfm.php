<?php
//TODO Make recursive deleting of folders;

//___Globals_and_constants______________________________________________________________________________________________________________________________________

$cur_path = isset($_GET['cur_path']) ? $_GET['cur_path'] : '/';
$cur_path2 = isset($_GET['cur_path2']) ? $_GET['cur_path2'] : '/';
$context=$_SERVER['DOCUMENT_ROOT'];

//___Actions____________________________________________________________________________________________________________________________________________________

function folder_add($name){
	error_reporting(0);
	$path = $_SERVER['DOCUMENT_ROOT'] . $_POST['path'] . ($_POST['path']=='/' ? '' : '/') . $name;
	if(file_exists($path)){
		echo "Folder $name already exist.";
	}
	else{
		if(mkdir($path)===false){
			echo preg_replace('/mkdir\(' . str_replace('/', '\/', $_SERVER['DOCUMENT_ROOT']) . '(.*)\)/', "$1", error_get_last()['message']) . '<br/>';
			return;
		}
		echo "<h2>Директория $name успешно создана.</h2><br/>";
	}
	error_reporting(E_ALL);
}

function file_add($name){
	error_reporting(0);
	$fd = fopen($_SERVER['DOCUMENT_ROOT'] . $_POST['path'] . ($_POST['path']=='/' ? '' : '/') . $name, "w+");
	if($fd===false){
		echo preg_replace('/fopen\(' . str_replace('/', '\/', $_SERVER['DOCUMENT_ROOT']) . '(.*)\)/', "$1", error_get_last()['message']) . '<br/>';
		return;
	}
	fclose($fd);
	echo "<h2>Файл $name успешно создан.</h2><br/>";
	error_reporting(E_ALL);
}

function file_remove($name){
	error_reporting(0);
	if(is_file($_SERVER['DOCUMENT_ROOT'] . $name)){
		if(!unlink($_SERVER['DOCUMENT_ROOT'] . $name)){
			echo preg_replace('/unlink\(' . str_replace('/', '\/', $_SERVER['DOCUMENT_ROOT']) . '(.*)\)/', "$1", error_get_last()['message']) . '<br/>';
		}
		else{
			echo "<h2>$name успешно удалён.</h2><br/>";
		}
	}
	elseif(is_dir($_SERVER['DOCUMENT_ROOT'] . $name)){
		if(!rmdir($_SERVER['DOCUMENT_ROOT'] . $name)){
			echo preg_replace('/rmdir\(' . str_replace('/', '\/', $_SERVER['DOCUMENT_ROOT']) . '(.*)\)/', "$1", error_get_last()['message']) . '<br/>';
		}
		else{
			echo "<h2>$name успешно удалён.</h2><br/>";
		}
	}
	error_reporting(E_ALL);
}

function file_save($name){
	error_reporting(0);
	$fd = fopen($_SERVER['DOCUMENT_ROOT'].$name, "w");
	if($fd===false){
		echo preg_replace('/fopen\(' . str_replace('/', '\/', $_SERVER['DOCUMENT_ROOT']) . '(.*)\)/', "$1", error_get_last()['message']) . '<br/>';
		return;
	}
	fwrite($fd,$_POST['text']);
	fclose($fd);
	echo "<h2>Файл $name успешно сохранён.</h2><br/>";
	error_reporting(E_ALL);
}

function file_move($path, $name){
	error_reporting(0);
	global $cur_path, $cur_path2;
	$fpath = $path . ($path == '/' ? '' : '/') . $name;
	$fpath2 = ($_POST['second'] == '1' ? $cur_path . ($cur_path == '/' ? '' : '/') : $cur_path2 . ($cur_path2 == '/' ? '' : '/')) . $name;	
	if(rename($_SERVER['DOCUMENT_ROOT'] . $fpath, $_SERVER['DOCUMENT_ROOT'] . $fpath2)){
		echo "<h2>$fpath перемещён в $fpath2.</h2><br/>";
	}		
	else{
		echo preg_replace('/rename\(' . str_replace('/', '\/', $_SERVER['DOCUMENT_ROOT']) . '(.*),' . str_replace('/', '\/', $_SERVER['DOCUMENT_ROOT']) . '(.*)\)/', "move($1, $2)", error_get_last()['message']) . '<br/>';
	}
	error_reporting(E_ALL);
}

//___Visualizing________________________________________________________________________________________________________________________________________________

function normalize_path(&$path){
	if($path{0}=='\'') $path = substr($path, 1, strlen($path)-2);// 'lalalal' => lalalal
	if($path{0}=='.') $path = preg_replace("/(\/.*\/).*/", "$1", $_SERVER['PHP_SELF']) . substr($path, 2, strlen($path)-2);// ./lalalal => {script_path}/lalalal
	if($path{0}!='/') $path = '/' . $path;// add first slash
}

function sort_files($path, &$files){
	global $context;
	$i = 0; $j = 0;
	$file_list = array ();
	$dir_list = array ();
	foreach($files as $file){
		if(is_dir($context . $path . ($path == '/' ? '' : '/') . $file)){
			$dir_list[$i++] = $file;
		}
		elseif(is_file($context . $path . ($path == '/' ? '' : '/') . $file)){
			$file_list[$j++] = $file;
		}
	}
	
	$k = 0;
	for(;$k < count($dir_list); $k++){
		$files[$k] = $dir_list[$k];
	}
	$n = 0;
	for(;$k < count($dir_list) + count($file_list); $k++){
		$files[$k] = $file_list[$n++];
	}
}

function print_dir_link($path, $file, $second){
	global $cur_path, $cur_path2;
	echo "<a href=\"myfm.php?cur_path=";
	if(!$second){
		if(($file=='..') && ($path!='/')){
			$tmp = preg_replace("/(\/([^\/]*\/)*).*/", "$1", $path);
			if($tmp{strlen($tmp) - 1} == "/") $tmp = substr($tmp, 0, strlen($tmp) - 1);
			echo $tmp == "" ? '/' : $tmp; 
		}
		else{
			echo $path.($path != "/" ? '/' : '').$file;
		};
	}
	else{
		echo $cur_path;
	}
	echo "&cur_path2=";
	if($second){
		if(($file=='..') && ($path!='/')){
			$tmp = preg_replace("/(\/([^\/]*\/)*).*/", "$1", $path);
			if($tmp{strlen($tmp) - 1} == "/") $tmp = substr($tmp, 0, strlen($tmp) - 1);
			echo $tmp == "" ? '/' : $tmp; 
		}
		else{
			echo $path.($path != "/" ? '/' : '').$file;
		};
	}
	else{
		echo $cur_path2;
	}
	echo "\">[" . ($file == '..' ? 'Назад' : $file) . "]</a><br/>";
}

function print_file_link($path, $file){
	echo "<a href=\"".$path.($path=='/'?'':'/').$file."\">".($file)."</a><br/>"; 
}

function human_filesize($bytes,$decimals = 0){
	$sz = "BKMGTP";
	$factor = floor((strlen($bytes) - 1)/3);
	return sprintf("%.{$decimals}f", $bytes/pow(1024, $factor)) . ($factor!=0?@$sz[$factor]:'');
}

function print_table($path, $second){
	global $context;
	if(is_dir($context . $path)){
		$files = scandir($context.$path);
		
		for($i=1, $j=0; $i<count($files); $i++){
			if(($files[$i]{0} != '.') || (($files[$i] == '..') && ($path != '/')))
				$ret[$j++] = $files[$i];
		}
	}
	sort_files($path, $ret);
	echo '<table style="width:100%;">';
	echo '<tr style="text-align:center;"><th colspan="7"><h1>Index of '.$path.'</h1></th></tr>';
	echo '<tr style="text-align:center;"><td>Name</td><td>Last modify</td><td>Size</td><td>Show</td><td>Edit</td><td>Delete</td><td>Move</td></tr>';
	echo '<tr><th colspan="7"><hr></th></tr>';
	foreach($ret as $file){
		$tpath = $context . $path . ($path == '/' ? '' : '/') . $file;
		if(!is_dir($tpath) && !is_file($tpath)) continue;
		echo '<tr>';
		if(is_dir($tpath)){
			echo '<td><b>';
			print_dir_link($path, $file, $second);
			echo '</b></td>';
			echo '<td class="mod">' . date("d-m-Y H:i", filemtime($tpath)) . '</td>';
			echo '<td class="size">-</td>';
			echo '<td></td>';
			echo '<td></td>';
			echo '<td class="actions">'
					.'<form action="myfm.php?' . $_SERVER['QUERY_STRING'] . '" method="post">'
						.'<input ' . ((($file == '..') || !is_writable($context . $path . ($path == '/' ? '' : '/') . $file)) ? 'class="hide" ' : '') . 'name="del" type="submit" value="+"/>'
						.'<input class="hide" name="name" type="text" value="' . $path . ($path == '/' ? '' : '/') . $file . '"/>'
					.'</form>'
				.'</td>';
			echo '<td class="actions">'
					.'<form action="myfm.php?' . $_SERVER['QUERY_STRING'] . '" method="post">'
						.'<input ' . ((($file == '..') || !is_writable($context . $path . ($path == '/' ? '' : '/') . $file)) ? 'class="hide" ' : '') . 'name="move" type="submit" value="+"/>'
						.'<input class="hide" name="name" type="text" value="' . $file . '"/>'
						.'<input class="hide" name="path" type="text" value="' . $path . '"/>'
						.'<input class="hide" name="second" type="text" value="' . ($second ? '1' : '0') . '"/>'
					.'</form>'
				.'</td>';
		}
		elseif(is_file($tpath)){
				echo '<td>';
				print_file_link($path, $file);
				echo '</td>';
				echo '<td class="mod">' . date("d-m-Y H:i",filemtime($tpath)) . '</td>';
				echo '<td class="size">' . human_filesize(filesize($tpath)) . '</td>';
				echo '<td class="actions">'
						.'<form action="myfm.php?' . $_SERVER['QUERY_STRING'] . '" method="post">'
							.'<input ' . (is_readable($tpath) ? '' : 'class="hide"') . 'name="show" type="submit" value="+"/>'
							.'<input class="hide" name="name" type="text" value="' . $path . ($path == '/' ? '' : '/') . $file . '"/>'
						.'</form>'
					.'</td>';
				echo '<td class="actions">'
						.'<form action="myfm.php?' . $_SERVER['QUERY_STRING'] . '" method="post">'
							.'<input ' . ((is_writable($tpath) && is_readable($tpath)) ? '' : 'class="hide"') . 'name="edit" type="submit" value="+"/>'
							.'<input class="hide" name="name" type="text" value="' . $path . ($path == '/' ? '' : '/') . $file . '"/>'
						.'</form>'
					.'</td>';
				echo '<td class="actions">'
						.'<form action="myfm.php?' . $_SERVER['QUERY_STRING'] . '" method="post">'
							.'<input ' . (is_writable($context.$path) ? '' : 'class="hide"') . 'name="del" type="submit" value="+"/>'
							.'<input class="hide" name="name" type="text" value="' . $path . ($path == '/' ? '' : '/') . $file . '"/>'
						.'</form>'
					.'</td>';
				echo '<td class="actions' . ($file == '..' ? ' hide' : '') . '">'
						.'<form action="myfm.php?' . $_SERVER['QUERY_STRING'] . '" method="post">'
							.'<input ' . (is_writable($context.$path) ? '' : 'class="hide"') . 'name="move" type="submit" value="+"/>'
							.'<input class="hide" name="name" type="text" value="' . $file . '"/>'
							.'<input class="hide" name="path" type="text" value="' . $path . '"/>'
							.'<input class="hide" name="second" type="text" value="' . ($second ? '1' : '0') . '"/>'
						.'</form>'
					.'</td>';
			}
		
		echo '</tr>';
	}
	echo '<tr><th colspan="7"><hr></th></tr>';	
	if(is_writable($context.$path)){
		echo '<tr><th colspan="7">'
			.'<form action="myfm.php?'.$_SERVER['QUERY_STRING'].'" method="post" style="margin-bottom:-5px;">'
				.'<input style="width:80%;" name="name" type="text"/>'
				.'<input style="width:20%;" name="add" type="submit" value="Make file"/>'
				.'<input class="hide" name="path" type="text" value="'.$path.'"/>'
			.'</form>'
			.'</th></tr>';
		echo '<tr><th colspan="7">'
			.'<form action="myfm.php?'.$_SERVER['QUERY_STRING'].'" method="post">'
				.'<input style="width:80%;" name="name" type="text"/>'
				.'<input style="width:20%;" name="add_folder" type="submit" value="Make folder"/>'
				.'<input class="hide" name="path" type="text" value="'.$path.'"/>'
			.'</form>'
			.'</th></tr>';
	}
	if(isset($_SERVER['SERVER_SIGNATURE']))
	echo "<tr><th colspan=\"7\">{$_SERVER['SERVER_SIGNATURE']}</th></tr>";
	echo '</table>';
}

//____General___________________________________________________________________________________________________________________________________________________

function get_files($path, $second = false){
	normalize_path($path);
	print_table($path, $second);
}

//____Start_Point_______________________________________________________________________________________________________________________________________________
// var_dump($_SERVER);
echo "<style>tr{height: 20px;}.area{width:100%;height:98%;resize:none;}.hide{display:none;}.actions{width:5%;text-align:center;padding:0;}.mod{padding:0 10px;}.size{text-align:right;padding:0 10px;}input[type='submit']{}</style>";
echo "<h3>Name: MyCoolFileManager</h3>";
echo "<h4>Author: Rose_Lalonde</h4>";
// var_dump($_POST);

if(isset($_POST['add'])){
	file_add($_POST['name']);
}
elseif(isset($_POST['add_folder'])){
	folder_add($_POST['name']);
}
elseif(isset($_POST['del'])){
	file_remove($_POST['name']);
}
elseif(isset($_POST['save'])){
	file_save($_POST['name']);
}
elseif(isset($_POST['move'])){
	file_move($_POST['path'], $_POST['name']);
}

echo "<table style='height:87%;width:100%;'><tr><td style='display:" . (isset($_POST['edit']) || isset($_POST['show']) ? "none" : "contents") . ";width:50%;vertical-align:top;'>";

get_files($cur_path);

echo "</td><td style='vertical-align:top;'>";
if(isset($_POST['edit']) || isset($_POST['show'])){
	echo "<textarea name='text' form='TextArea' " . (isset($_POST['edit']) ? "" : "readonly") . " class='area'>" . file_get_contents($_SERVER['DOCUMENT_ROOT'] . $_POST['name']) . "</textarea>";
	echo '<form method="post" style="display:initial;" id="TextArea">';
	echo '<input type="submit" name="save" value="Save"/>';
	echo '<input class="hide" type="text" name="name" value="'.$_POST['name'].'"/>';
	echo '<input type="submit" name="cancel" style="float:right;" value="Cancel"/></form>';
}

echo '</td><td style="vertical-align:top;display:' . (isset($_POST['edit']) || isset($_POST['show']) ? "none" : "contents") . ';">';

get_files($cur_path2, true);

echo '</td></tr></table>';