<?php
function file_add($name){
	error_reporting(0);
	$fd = fopen($_SERVER['DOCUMENT_ROOT'].$_POST['path'].'/'.$name,"w+");
	if($fd===false){echo preg_replace('/fopen\('.str_replace('/','\/',$_SERVER['DOCUMENT_ROOT']).'(.*)\)/',"$1",error_get_last()['message']).'<br/>';return;}
	fclose($fd);
	echo "Файл $name успешно создан.<br/>";
	error_reporting(E_ALL);
}

function file_remove($name){
	error_reporting(0);
	if(!unlink($_SERVER['DOCUMENT_ROOT'].$name)){
		echo preg_replace('/unlink\('.str_replace('/','\/',$_SERVER['DOCUMENT_ROOT']).'(.*)\)/',"$1",error_get_last()['message']).'<br/>';
	}
	else{
		echo "Выполнено успешно.<br/>";
	}
	error_reporting(E_ALL);
}

if(isset($_POST['add'])){
	file_add($_POST['name']);
}

if(isset($_POST['del'])){
	file_remove($_POST['name']);
}

// var_dump($_POST);
// var_dump($_SERVER);
echo '<a href="'.$_POST['return'].'">Вернуться назад</a>';