<?php
include_once("php/templater.php");
include_once("php/get_page.php");
include_once 'php/searching.php';

	$VAR['auth']='non';
	$VAR['style']=(intval(date('H'))>=6)&&(intval(date('H'))<=18)?'light':'black';
	Templater::$pageName = "search";
	$VAR['pageName']=Templater::$pageName;
	$templ = new Templater();

	if (isset($_POST) && (count($_POST) > 0) && (isset($_POST['search']))) {
		$res = search(Templater::$db);
		$VAR['searchResult'] = $res === false ? "<div class='border border-down container-fluid' style='text-align: center;'>Ничего не найдено</div>" : $res;
	}

	$page = $templ->GetFileContent("tpl/page.tpl");

	GetPage($templates, $replaces, $page, $templ);

echo $page;