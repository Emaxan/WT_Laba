<?php
include_once("php/templater.php");
include_once("php/get_page.php");

if (isset($_POST) && (count($_POST) > 0) && (isset($_POST['reg']))) {
	include_once 'php/userReg.php';
	testPost();
	foreach ($_POST as $key => $value) {
		$VAR[$key] = htmlspecialchars($value);
	}	
}

	$VAR['auth']='auth';
	$VAR['style']=(intval(date('H'))>=6)&&(intval(date('H'))<=18)?'light':'black';
	Templater::$pageName = "index";
	$VAR['pageName']=Templater::$pageName;
	$templ = new Templater();

	$page = $templ->GetFileContent("tpl/page.tpl");

if (isset($_POST) && (count($_POST) > 0) && (isset($_POST['inter']))) {
	include_once 'php/interviewCounter.php';
	testAnswer(Templater::$db);
}

	GetPage($templates, $replaces, $page, $templ);

echo $page;