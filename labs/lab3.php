<?php
echo 	"<h3>Вариант 7: <br/>написать функцию, определяющую процентное отношение объёма графических файлов в произвольном каталоге (включая подкаталоги) к ",
		"общему объёму данных в этом каталоге. Имя каталога получать через веб-форму.</h3>";
echo "<form action='lab3.php' method='post' enctype='multipart/form-data' style='text-align:center;'>";
//echo '<input name="dir" type="file" placeholder="directory" style="width:100%;margin-bottom:20px;" webkitdirectory directory multiple/>';
echo '<input name="dir" placeholder="directory" style="width:100%;margin-bottom:20px;"/>';
echo '<input type="submit"/>';
echo '</form>';

if(isset($_POST['dir'])){		
	function countImg($path,&$gSize,&$iSize){
		if(!file_exists($path)) return 1;
		$files=scandir($path);
		for($i=2;$i<count($files);$i++){
			if(is_dir($path.$files[$i])) countImg($path.$files[$i].'/',$gSize,$iSize);
			if(is_file($path.$files[$i])) {
				if(exif_imagetype($path.$files[$i])!=false) $iSize+=filesize($path.$files[$i]);
				$gSize+=filesize($path.$files[$i]);
			}
		}
		return 0;
	}
	error_reporting( 0 );
	$foldername=$_POST['dir'];
	if($foldername{0}=='.')	$foldername = preg_replace("/(\/.*\/).*/","$1",$_SERVER['PHP_SELF']) . substr($foldername,2,strlen($foldername)-2);
	if($foldername{0}!='/') $foldername = '/' . $foldername;
	//var_dump($GLOBALS);
	echo "'$foldername'";
	$g=0; $i=0;
	switch(countImg($_SERVER['DOCUMENT_ROOT'].$foldername,$g,$i)){ 
		case 0: echo "<br>".($i/$g*100)."%"; break;
		case 1:	echo " not exist."; break;
		default: return;
	}
}