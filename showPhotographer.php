<?php
include_once("php/templater.php");
include_once("php/get_page.php");
	
	$VAR['auth']='non';
	$VAR['style']=(intval(date('H'))>=6)&&(intval(date('H'))<=18)?'light':'black';
	Templater::$pageName = "showPhotorgapher";
	$VAR['pageName']=Templater::$pageName;
	$templ = new Templater();

	$page = $templ->GetFileContent("tpl/page.tpl");

	GetPage($templates, $replaces, $page, $templ);

echo $page;