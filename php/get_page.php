<?php

function GetPage($templates, $replaces, &$page, $templ){	
	$count = 1;
	while($count!=0) {
		for ($index=0; $index < count($templates); $index++) { 
			$count = $templ->Set($templates[$index], $replaces[$index], $page);
			if($count>0) break;
		}
	}	
	return $page;
}